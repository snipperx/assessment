<?php

namespace App\Http\Controllers;

use App\persons;
use App\user_balance;
use App\cart;
use App\product_discount;
use App\products;
use App\transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function register()
    {
        $user = persons::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
        if (!empty($user))
            $user = $user->load('user');

        //return $user;
        $user = persons::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->first();
        $data['user'] = $user;
        return view('user_registration')->with($data);

    }

    public function registerUser(persons $user, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required', 'string', 'max:255',
            'surname' => 'required', 'string', 'max:255',
            'cell_number' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'res_address' => 'required',
            'res_postal_code' => 'required',
            'city' => 'required', 'string', 'max:255',
            'id_number' => 'required', 'string', 'max:13',
        ]);

        $data = $request->all();
        unset($data['_token']);

        $user->first_name = $request->first_name;
        $user->surname = $request->surname;
        $user->first_name = $request->amount;
        $user->gender = $request->gender;
        $user->cell_number = $request->cell_number;
        $user->email = $request->email;
        $user->res_address = $request->res_address;
        $user->city = $request->city;
        $user->id_number = bcrypt($request->id_number);
        $user->update();

        return redirect('home');
    }

    public function index()
    {

        $balance = user_balance::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
        $transactions = transactions::where('user_id', Auth::user()->id)->count();
        $data['breadcrumb'] = [
            ['title' => 'Dashboard', 'path' => '/', 'icon' => 'fa fa-dashboard', 'active' => 1, 'is_module' => 1]
        ];
        $countproduct = products::count();
        $countcart = cart::where('user_id', Auth::user()->id)->count();

        $data['countcart'] = $countcart;
        $data['countproduct'] = $countproduct;
        $data['active_mod'] = 'dashboard';
        $data['balance'] = $balance;
        $data['transactions'] = $transactions;

        $Admin = Auth::user()->isAdmin;
        if ($Admin === 1) {
            return view('home')->with($data);
        } else

            $products = products::orderBy('id', 'asc')->take(8)->get();
        $countproduct = products::count();

        $discount = product_discount::count();


        $data['countproduct'] = $countproduct;
        $data['discount'] = $discount;

        $data['products'] = $products;
        return view('AdminUser')->with($data);
    }

}
