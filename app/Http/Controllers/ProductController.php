<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Product',
            'active' => 'product',
            'is_auth' => false,
            'products' => Product::orderBy('created_at', 'desc')->get(),
        ];
        return view('pages.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Add Product',
            'active' => 'product',
            'is_auth' => false,
        ];
        return view('pages.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'image' => ['required', 'mimes:png,jpg,jpeg','max:2000'],
            'stock' => ['required'],
            'price' => ['required'],
            'status' => ['required'],
        ]);
        $validatedData['image'] = AppHelper::upload_file($request->image, 'images');
        Product::create($validatedData);
        toastr()->success('Data has been saved successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $user = Auth::user();
        if ($user) {
            if ($user->role == User::ADMIN) {
                $layout = 'layouts.template';
            }else{
                $layout = 'layouts.home';
            }
        }else{
            $layout = 'layouts.home';
        }
        $data = [
            'title' => 'Detail Product',
            'active' => 'product',
            'is_auth' => false,
            'product' => $product,
            'layout' => $layout,
        ];
        return view('pages.product.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = [
            'title' => 'Edit Product',
            'active' => 'product',
            'is_auth' => false,
            'product' => $product,
        ];
        return view('pages.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'image' => [Rule::requiredIf(function() use($request){
                if (empty($request->image)) {
                    return false;
                }
                return true;
            }), 'mimes:png,jpg,jpeg','max:2000'],
            'stock' => ['required'],
            'price' => ['required'],
            'status' => ['required'],
        ]);
        if ($request->image) {
            AppHelper::delete_file($product->image);
            $validatedData['image'] = AppHelper::upload_file($request->image, 'images');
        }
        $product->update($validatedData);
        toastr()->success('Data has been saved successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        AppHelper::delete_file($product->image);
        $product->delete();
        toastr()->success('Data has been deleted successfully!');
        return back();
    }
}
