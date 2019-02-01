<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\user_balance;
use App\transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopUpController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $balance = user_balance::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
        $data['balance'] = $balance;
        return view('topUp')->with($data);
    }

    public function update(Request $request, user_balance $userbalance)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $Data = $request->all();
        unset($Data['_token']);

        $today = strtotime(date('Y-m-d'));
        $amount = $request->amount;
        $user = Auth::user()->id;
        $balance = user_balance::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->first();
        $yesterday = date('Y-m-d', strtotime('yesterday'));

        if (!empty($balance)) {
            $amount += $balance['balance'];
            user_balance::where('user_id', Auth::user()->id)->update(['balance' => $amount]);

        } else {
            $balances = user_balance::where('user_id', Auth::user()->id)->where('date', strtotime($yesterday))->orderBy('id', 'asc')->first();
            $amounts = 0;
            if (!empty($balances)) {
                $amounts = $balances['balance'];
            }
            $userbalance->balance = $amounts + $amount;
            $userbalance->user_id = $user;
            $userbalance->date = $today;
            $userbalance->save();
        }
        $newTtran = new transactions();
        $newTtran->user_id = $user;
        $newTtran->transaction_details = 'Money In+';
        $newTtran->amount = $amount;
        $newTtran->date = $today;
        $newTtran->save();

        return back();
    }
}
