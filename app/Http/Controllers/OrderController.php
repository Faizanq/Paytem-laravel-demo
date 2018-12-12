<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use CustomFunction;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $order = new Order;
        $order->price=$request->price;
        $order->status='Pending';
        $order->save();
        // return $order;
        $data_for_request = $this->handlePaytmRequest($order->id,$order->price);

        $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
 
    return view( 'paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
    }


        public function handlePaytmRequest($order_id,$amount) {
                // Load all functions of encdec_paytm.php and config-paytm.php
            CustomFunction::getAllEncdecFunc();
            CustomFunction::getConfigPaytmSettings();
 
            $checkSum = "";
            $paramList = array();
 
                // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = 'Websit57239737375544';
            $paramList["ORDER_ID"] = $order_id;
            $paramList["CUST_ID"] = $order_id;
            $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
            $paramList["CHANNEL_ID"] = 'WEB';
            $paramList["TXN_AMOUNT"] = $amount;
            $paramList["WEBSITE"] = 'WEBSTAGING';
            $paramList["CALLBACK_URL"] = url( '/paytm-callback' );
            $paytm_merchant_key = '31Q9BhP7U9JVip77';
 
            //Here checksum string will return by getChecksumFromArray() function.
            $checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );
 
            return array(
                'checkSum' => $checkSum,
                'paramList' => $paramList
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function paytmCallback( Request $request ) {

        return $request;

        $order_id = $request['ORDERID'];
 
        $user_id = auth()->id();
        $user = User::find( $user_id );
 
        if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
                $transaction_id = $request['TXNID'];
                $order = Order::where( 'order_id', $order_id )->first();
                $order->status = 'complete';
                $order->payment_received = 'yes';
                $order->payment_id = $transaction_id;
                $order->save();
                return view( 'order-complete', compact( 'order', 'status' ) );
 
        } else if( 'TXN_FAILURE' === $request['STATUS'] ){
                return view( 'payment-failed' );
        }
}
}
