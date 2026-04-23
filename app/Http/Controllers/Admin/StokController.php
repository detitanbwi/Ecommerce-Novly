<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class StokController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.stok.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.stok.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = $request->only(['title', 'category_id', 'price', 'description', 'external_links']);
        $data['slug'] = Str::slug($request->title) . '-' . time();
        $data['is_active'] = $request->boolean('is_active');
        
        $imagePaths = [];
        for ($i = 0; $i < 3; $i++) {
            if ($request->hasFile("images.$i")) {
                $file = $request->file("images.$i");
                $imagePaths[] = $this->optimizeAndStoreImage($file);
            }
        }
        
        if (!empty($imagePaths)) {
            $data['images'] = $imagePaths;
        }

        Product::create($data);

        return redirect()->route('admin.stok')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.stok.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);
        
        $data = $request->only(['title', 'category_id', 'price', 'description', 'external_links']);
        $data['is_active'] = $request->boolean('is_active');

        $finalImages = [];
        $existing = $request->input('existing_images', []);
        $newFiles = $request->file('images', []);

        for ($i = 0; $i < 3; $i++) {
            // Priority 1: New file uploaded for this slot
            if (isset($newFiles[$i]) && $newFiles[$i]->isValid()) {
                $finalImages[] = $this->optimizeAndStoreImage($newFiles[$i]);
            } 
            // Priority 2: Keep existing image if no new file and it wasn't removed (value exists)
            elseif (!empty($existing[$i])) {
                $finalImages[] = $existing[$i];
            }
        }

        // Optional: Delete physical files that are no longer in finalImages
        if ($product->images) {
            foreach ($product->images as $oldImage) {
                if (!in_array($oldImage, $finalImages)) {
                    $cleanPath = str_replace('storage/', '', $oldImage);
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($cleanPath);
                }
            }
        }

        $data['images'] = $finalImages;
        $product->update($data);

        return redirect()->route('admin.stok')->with('success', 'Produk berhasil diperbarui!');
    }

    private function optimizeAndStoreImage($file)
    {
        $filename = time() . '_' . Str::random(10) . '.webp';
        $path = 'products/' . $filename;
        
        // Use GD to optimize/convert to WebP
        $imageInfo = \getimagesize($file);
        $mime = $imageInfo['mime'];
        
        switch ($mime) {
            case 'image/jpeg': $img = \imagecreatefromjpeg($file); break;
            case 'image/png':  $img = \imagecreatefrompng($file); break;
            case 'image/webp': $img = \imagecreatefromwebp($file); break;
            default: return $file->store('products', 'public');
        }

        // Resize if too large (max width 1200)
        $width = \imagesx($img);
        $height = \imagesy($img);
        $maxSize = 1200;
        
        if ($width > $maxSize) {
            $newWidth = $maxSize;
            $newHeight = ($height / $width) * $maxSize;
            $tmp = \imagecreatetruecolor($newWidth, $newHeight);
            
            \imagealphablending($tmp, false);
            \imagesavealpha($tmp, true);
            
            \imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            \imagedestroy($img);
            $img = $tmp;
        }

        // Buffer the output
        \ob_start();
        \imagewebp($img, null, 75); // 75 quality is very lightweight but still clear
        $content = \ob_get_clean();
        \imagedestroy($img);

        \Illuminate\Support\Facades\Storage::disk('public')->put($path, $content);
        
        return 'storage/' . $path;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.stok')->with('success', 'Product deleted successfully.');
    }
}
