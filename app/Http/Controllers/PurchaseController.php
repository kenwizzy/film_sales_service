<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /* Method for checking out*/
    public function buy(Request $request){
        $cart = session()->get('cart');
        $name = [];
        $total = 0;
        if (isset($cart)) {
            foreach($cart as $data){
                array_unshift($name,$data['title']);
                $total += $data['price'];
            }

         /*Get the user balance and substract the total*/
        $user = User::where('id', Auth::id())->first();
        $user->account->update(['balance'=> $user->account->balance - $total]);

   /* Insert the record in the purchase table*/
            Purchase::create([
                'user_id' => Auth::id(),
                'item' => $name,
                'purchase_reference' => Str::random(20),
                'amount' => $total,
                'status' => 'Successful'
            ]);

            session()->forget('cart');
        }

        return redirect('/')->withSuccess('Successful. Thank you for patronising us');
    }

    public function purchases(){
        $results = Auth::user()->purchases;
        return view('purchases', compact('results'));
    }

}
