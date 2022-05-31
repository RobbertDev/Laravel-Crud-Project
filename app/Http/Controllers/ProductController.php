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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('product.overview')->with('products', product::all()->where('user_id', Auth::id()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        if ($request->getMethod() === 'GET') return view('product.create');

        $valid = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if($valid) {
            $product = new product();
            $product->user_id = Auth::id();
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->save();
            return redirect()->route('product-detail', ['id' => $product->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('product.detail')->with('product', product::where('user_id', Auth::id())->where('id', $id)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $product = product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('product.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $product = product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $product->name = $request->get('name');
        $product->description = $request->get('name');
        $product->save();

        return redirect()->route('product-detail', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $product->delete();
        return redirect()->route('product-overview');
    }
}
