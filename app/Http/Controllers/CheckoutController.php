<?php

namespace App\Http\Controllers;

use App\Product;
use App\checkout;
use App\checkout_product;
use Cartalyst\Stripe\Api\PaymentIntents;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        Stripe::setApiKey('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');

        try {
            $validated = $request->validate([
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'city' => 'required',
                'Phonenumber' => 'required|numeric|digits:10',
                'email' => 'required|email',
                'add1' => 'required',
            ]);

            $order = checkout::create([
                'firstName' => $request->firstname,
                'lastName' => $request->lastname,
                'companyName' => $request->company,
                'city' => $request->city,
                'phone' => $request->Phonenumber,
                'email' => $request->email,
                'addressLine1' => $request->add1,
                'addressLine2' => $request->add2,
                'zip' => $request->zip,
                'orderNotes' => $request->message,
            ]);

            foreach (Cart::content() as $item) {
                // echo "<pre>"; print_r($item); die;
                checkout_product::create([
                    'checkout_id' => $order->id,
                    'product_id' => $item->model->id,
                    'qty' => $item->qty,
                    'price' => $item->price,
                ]);
            }

            $charge = Stripe::charges()->create([
                'amount' => Cart::total() / 100,
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    // 'contents' => $charge,
                    // 'quantity' => Cart::instance('default')->count(),
                ]
            ]);

            return redirect()->route('confirmation', ['id' => $order->id]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function confirmation($id)
    {
        $checkout = checkout::where(['id' => $id])->first();
        $checkout_product = checkout_product::where(['checkout_id' => $id])->get();
        // echo "<pre>"; print_r($checkout); die;
        // echo "<pre>"; print_r($checkout_product); die;
        return view('confirmation')->with(compact('checkout', 'checkout_product'));;
    }
}
