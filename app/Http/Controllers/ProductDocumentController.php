<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductDocumentController extends Controller
{
    public function index()
    {
        $products = Product::paginate(25);
        return view('dashboard.inventory.index', compact('products'));
    }
    public function create()
    {
        return view('dashboard.inventory.create');
    }
    public function store()
    {
        // dd(request()->all());
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string|max:255',
            'price' => 'required|string|min:0',
            'compare_price' => 'nullable|string|min:0',
            'pages' => 'required|integer|min:1',
        ]);
        
        if (!$validated) {
            return response()->json(['error' => 'Validation failed', 'data' => $validated], 422);
        }
        $validated['featured'] = request()->has('featured');
        $validated['is_active'] = request()->has('is_active');
        $filename = time(). '.pdf';
        $validated['pdf_path'] = request()->file('doc')->storeAs('documents', $filename);
        if(request()->hasAny('cover_image')) {
            $filename = time(). '.jpg';
            $validated['cover_image'] = request()->file('cover_image')->storeAs('covers', $filename,'public');
        }
        $validated['slug'] = Str::slug($validated['name'], '-');
        Product::create($validated);
        return back()->with('success', 'The private PDF was uploaded securely.');
    }
}
