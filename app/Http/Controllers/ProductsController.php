<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = products::orderBy('id', 'asc')->get();
        $data['products'] = $products;
        return view('Admin.products')->with($data);
    }

    public function products()
    {
        return view('Admin.add_products');
    }

    public function addnewProducts(Request $request, products $product)
    {
        $this->validate($request, [
            'name' => 'required|unique:products,name',
            'description' => 'bail|required|min:2',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->date = strtotime(date('Y-m-d'));
        $product->quantity = $request->quantity;
        $product->status = 1;
        $product->save();
        //
        if ($request->hasFile('product_image')) {
            $fileExt = $request->file('product_image')->extension();
            if (in_array($fileExt, ['jpg', 'jpeg', 'png']) && $request->file('product_image')->isValid()) {
                $fileName = $product->id . "_product_image_." . $fileExt;
                $request->file('product_image')->storeAs('public/product_image', $fileName);
                $product->product_image = $fileName;
                $product->update();
            }
        }

        $products = products::orderBy('id', 'asc')->get();
        $data['products'] = $products;
        return view('Admin.products')->with($data);
    }

    public function editproducts(products $products)
    {
        $products = products::where('id', $products->id)->orderBy('id', 'asc')->first();
        $data['products'] = $products;
       return view('Admin.edit_product')->with($data);
        //return $products;
    }

    public function productupdate(products $product ,Request $request){

        $product->update($request->all());

        if ($request->hasFile('product_image')) {
            $fileExt = $request->file('product_image')->extension();
            if (in_array($fileExt, ['jpg', 'jpeg', 'png']) && $request->file('product_image')->isValid()) {
                $fileName = $product->id . "_product_image_." . $fileExt;
                $request->file('product_image')->storeAs('product_image', $fileName);
                $product->product_image = $fileName;
                $product->update();
            }
        }
        return redirect('manage/products');

    }
}
