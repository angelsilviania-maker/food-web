<?php

namespace App\Http\Controllers;

use App\Models\foods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = foods::all();
        // Disesuaikan agar mengarah ke folder admin -> folder foods -> file index (index.blade.php)
        return view('admin.foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Proses upload gambar jika ada file yang dipilih
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foods', 'public');
            $data['image'] = $imagePath;
        }

        foods::create($data);

        return redirect()->route('admin.foods')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(foods $foods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(foods $foods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, foods $foods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $food = foods::findOrFail($id);

        // Hapus file gambar dari storage jika ada
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }

        $food->delete();

        return redirect()->route('admin.foods')->with('success', 'Menu berhasil dihapus!');
    }
}