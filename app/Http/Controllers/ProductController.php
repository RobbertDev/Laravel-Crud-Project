<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('product.overview')->with('products', product::all()->where('user_id', Auth::id()));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        if($request->method() === 'GET') {
            return view('product.create');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if(!$id = Auth::id()) {
            throw new \Exception('Unable to fetch user ID');
        }

        $product = new product();
        $product->user_id = $id;
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->save();

        return redirect()->route('product-detail', ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('product.detail')->with('product', product::where('user_id', Auth::id())->where('id', request('id'))->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $product = product::where('user_id', Auth::id())->where('id', request('id'))->firstOrFail();
        $product->delete();
        return redirect()->route('product-overview');
    }
}
