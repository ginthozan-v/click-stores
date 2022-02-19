<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\checkout;
use App\checkout_product;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function getResentOrders()
    {
        $checkouts = checkout::orderBydesc('id')->where(['viewed' => '0'])->get();
        $deliveries = checkout::orderBydesc('id')->where(['delivered' => '0'])->get();

        return view('admin.dashboard')->with(compact('checkouts', 'deliveries'));
    }

    public function checkoutdetails(Request $request, $id = null)
    {
        checkout::where(['id' => $id])->update([
            'viewed' => '1',
        ]);

        $checkoutdetail = checkout::with('products')->where(['id' => $id])->first();
        return view('admin.checkoutdetail')->with(compact('checkoutdetail'));
    }

    public function checkoutall()
    {
        $checkouts = checkout::orderBydesc('id')->get();

        return view('admin.allOrders')->with(compact('checkouts'));
    }

    public function delivered($id)
    {
        checkout::where(['id' => $id])->update([
            'delivered' => '1',
        ]);

        return redirect()->back()->with('flash_message_success', 'Delivered Successfully!');
    }

    //// Delete Product
    ////////////////////////////////////////////////////////////////
    public function checkoutdelete($id = null)
    {
        if (!empty($id)) {
            $checkout = checkout::find($id);
            $checkout->delete();
            return redirect()->back()->with('flash_message_success', 'Checkout deleted Successfully!');
        }
    }
}
