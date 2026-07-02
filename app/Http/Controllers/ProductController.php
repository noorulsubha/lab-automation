<?php
// ============================================
// PRODUCT CONTROLLER
// Location: app/Http/Controllers/ProductController.php
// Purpose: Handles Product CRUD Operations
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // ============================================
    // Display All Products
    // ============================================
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return view('products.index', compact('products'));
    }

    // ============================================
    // Show Create Product Form
    // ============================================
    public function create()
    {
        return view('products.create');
    }

    // ============================================
    // Store New Product
    // ============================================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'revision' => 'nullable|max:100',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Generate Product ID
        $productId = 'PRD' . str_pad(Product::count() + 1, 7, '0', STR_PAD_LEFT);

        // Upload Image
        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('images/products'),
                $imageName
            );
        }

        // Save Product
        Product::create([
            'product_id' => $productId,
            'name' => $request->name,
            'type' => $request->type,
            'revision' => $request->revision,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product added successfully.');
    }

    // ============================================
    // Edit Product
    // ============================================
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    // ============================================
    // Update Product
    // ============================================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'revision' => 'nullable|max:100',
            'description' => 'nullable'
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('images/products'),
                $imageName
            );
        }

        $product->update([
            'name' => $request->name,
            'type' => $request->type,
            'revision' => $request->revision,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    // ============================================
    // Delete Product
    // ============================================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}