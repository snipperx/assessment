<?php

namespace App\Http\Controllers;

use App\User;
use App\cart;
use App\transactions;
use App\products;
use App\product_discount;
use App\user_balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $transaction = DB::table('transactions')
            ->select('transactions.*', 'persons.*')
            ->leftJoin('persons', 'transactions.user_id', '=', 'persons.user_id')
            ->where('transactions.user_id', Auth::user()->id)
            ->orderBy('transactions.id', 'asc')
            ->get();

        $data['transaction'] = $transaction;
        return view('transaction')->with($data);
    }

    public function viewProducts()
    {
        $cart = cart::count();
        $products = products::get();
        $countproducts = cart::where('user_id', Auth::user()->id)->count();
//return $products;
        $data['cart'] = $cart;
        $data['products'] = $products;
        $data['countproducts'] = $countproducts;

        return view('view_products')->with($data);
    }

    public function addtocart(products $product)
    {

        $userID = Auth::user()->id;
        $shoppingCart = new cart();
        $shoppingCart->user_id = $userID;
        $shoppingCart->product_id = $product->id;
        $shoppingCart->save();

        $transaction = new transactions();
        $transaction->user_id = Auth::user()->id;
        $transaction->transaction_details = $product->name . ' ' . 'Added to cart';
        $transaction->amount = $product->price;
        $transaction->date = strtotime(date('Y-m-d'));
        $transaction->save();
        return redirect('/view/products')->with('success_add', "Added to your busket.");
    }

    public function viewcart()
    {
        $count = cart::count();
        if ($count == 0) {
            $totalDiscount = 0;
            $productID = 0;
            $shoppingCart = products::take(0)->get();
            $data['shoppingCart'] = $shoppingCart;
            $data['productID'] = $productID;
            $data['totalDiscount'] = $totalDiscount;
            return view('basket')->with($data);
        } else
            $Cart = cart::where('user_id', Auth::user()->id)->first();

        $product = products::where('id', $Cart->product_id)->first();
        $shoppingCart = products::where('id', $Cart->product_id)->get();
        $discItem = product_discount::all();
        $totalDiscount = 0;
        foreach ($discItem as $disc) {
            if ($product->price >= $disc->min_price && $product->price <= $disc->max_price) {
                $totalDiscount = $disc->discount * $product->price;
            }
        }

        $balance = user_balance::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
        $data['balance'] = $balance;
        $productID = $product->id;
        $totalDiscount = $product->price - $totalDiscount;
        $data['totalDiscount'] = $totalDiscount;
        $data['productID'] = $productID;
        $data['shoppingCart'] = $shoppingCart;
        return view('basket')->with($data);
    }

    public function checkout(Request $request)
    {
        $productID = $request->productId;
        $totalDisc = $request->totaldisc;
        $product = products::where('id', $productID)->first();
        //check if user has enough credit
        $userBalance = user_balance::where('user_id', Auth::user()->id)->get();

        if ($userBalance->max()->balance >= $totalDisc) {
            $balance = $userBalance->max()->balance - $totalDisc;
            $userbalances = new user_balance();
            $userbalances->balance = $balance;
            $userbalances->user_id = Auth::user()->id;
            $userbalances->date = strtotime(date('Y-m-d'));
            $userbalances->save();

            $transaction = new transactions();
            $transaction->user_id = Auth::user()->id;
            $transaction->transaction_details = $balance . ' ' . 'purchased';
            $transaction->amount = $balance;
            $transaction->date = strtotime(date('Y-m-d'));
            $transaction->save();

            //update quantity in product table
            $quantity = products::where('id', $productID)->first();
            $quantity->quantity = $product->quantity - 1;
            $quantity->update();

            $cart = cart::where('product_id', $productID)->first();
            $cart->delete();

            return back();
        } elseif ($userBalance->max()->balance <= $totalDisc) {

            $transaction = new transactions();
            $transaction->user_id = Auth::user()->id;
            $transaction->transaction_details = 'insufficient balance';
            $transaction->amount = $userBalance->max()->balance;
            $transaction->date = strtotime(date('Y-m-d'));
            $transaction->save();
            return back()->with('success_edit', "The user's details have been successfully updated.");
           // return redirect()->back()->with('alert', 'Insuffient Funds , please laod credit');
        }
    }

    public function deletecheckout(cart $cart)
    {
        return $cart;
        $cart->delete();
        return redirect('/view/basket');
    }
}