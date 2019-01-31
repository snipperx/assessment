<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product_discount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiscountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $discounts = product_discount::orderBy('id', 'asc')->get();
        $data['discounts'] = $discounts;
        return view('productDiscounts')->with($data);
    }

    //
    public function discountIndex()
    {
        return view('Admin.add_dicountIndex');
    }

    public function addDiscount(Request $request)
    {
        $this->validate($request, [
            'discount' => 'required',
        ]);

        $discData = $request->all();
        unset($discData['_token']);

        $productdiscount = new product_discount($discData);
        $productdiscount->save();
        return redirect('manage/discounts');
    }

    public function discountedit(product_discount $discount)
    {
        $data['discount'] = $discount;
        return view('Admin.edit_discount')->with($data);
    }

    public function discountupdate(Request $request, product_discount $discount)
    {
        $discount->update($request->all());
        return redirect('manage/discounts');
    }

}
