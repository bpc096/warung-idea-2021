<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Midtrans\Snap;
use App\Payment;
use App\Campaign;
use App\Reward;

class PaymentController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // Set midtrans configuration
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get data donations
         $payments = Payment::with('campaign')->where('users_id', auth()->guard('api')->user()->id)->latest()->paginate(100);

         //return with response JSON
         return response()->json([
             'success' => true,
             'message' => 'List Data Payments : '. auth()->guard('api')->user()->name,
             'data'    => $payments,
         ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use ($request) {

            /**
             * algorithm create no invoice
             */
            $length = 10;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $no_invoice = 'TRX-'.Str::upper($random);

            // if ($reward_id) {
            //     # get data reward
            //     $reward = Reward::where('id', $request->rewardId)->first();
            //     $amount = $request->amount;
            //     $campaign = Campaign::find($reward->campaign_id)->where('slug', $request->campaignSlug)->first();

            //     $donation = Payment::create([
            //         'invoice'       => $no_invoice,
            //         'campaign_id'   => $campaign->id,
            //         'donatur_id'    => auth()->guard('api')->user()->id,
            //         'amount'        => $amount,
            //         'pray'          => $request->pray,
            //         'status'        => 'pending',
            //     ]);
            // } else {
                # get data campaign
            $campaign = Campaign::where('id', $request->campaignId)->first();

            $donation = Payment::create([
                'invoice'       => $no_invoice,
                'campaign_id'   => $campaign->id,
                'users_id'      => auth()->guard('api')->user()->id,
                'amount'        => $request->amount,
                'status'        => 'pending',
            ]);
            // }
            
            // // get data campaign
            // $campaign = Campaign::where('slug', $request->campaignSlug)->first();

            // $donation = Payment::create([
            //     'invoice'       => $no_invoice,
            //     'campaign_id'   => $campaign->id,
            //     'users_id'      => auth()->guard('api')->user()->id,
            //     'amount'        => $request->amount,
            //     'status'        => 'pending',
            // ]);

            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $donation->invoice,
                    'gross_amount'  => $donation->amount,
                ],
                'customer_details' => [
                    'first_name'       => auth()->guard('api')->user()->name,
                    'email'            => auth()->guard('api')->user()->email,
                ]
            ];

            //create snap token
            $snapToken = Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();

            $this->response['snap_token'] = $snapToken;


        });

        return response()->json([
            'success' => true,
            'message' => 'Donasi Berhasil Dibuat!',  
            $this->response
        ]);
    }
    
    /**
     * notificationHandler
     *
     * @param  mixed $request
     * @return void
     */
    public function notificationHandler(Request $request)
    {
        $payload      = $request->getContent();
        $notification = json_decode($payload);
    
        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.serverKey'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transaction  = $notification->transaction_status;
        $type         = $notification->payment_type;
        $orderId      = $notification->order_id;
        $fraud        = $notification->fraud_status;

        //data donation
        $data_donation = Payment::where('invoice', $orderId)->first();

        if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

              if($fraud == 'challenge') {
                
                /**
                *   update invoice to pending
                */
                $data_donation->update([
                    'status' => 'pending'
                ]);

              } else {
                
                /**
                *   update invoice to success
                */
                $data_donation->update([
                    'status' => 'success'
                ]);

              }

            }

        } elseif ($transaction == 'settlement') {

            /**
            *   update invoice to success
            */
            $data_donation->update([
                'status' => 'success'
            ]);


        } elseif($transaction == 'pending'){

            
            /**
            *   update invoice to pending
            */
            $data_donation->update([
                'status' => 'pending'
            ]);


        } elseif ($transaction == 'deny') {

            
            /**
            *   update invoice to failed
            */
            $data_donation->update([
                'status' => 'failed'
            ]);


        } elseif ($transaction == 'expire') {

            
            /**
            *   update invoice to expired
            */
            $data_donation->update([
                'status' => 'expired'
            ]);


        } elseif ($transaction == 'cancel') {

            /**
            *   update invoice to failed
            */
            $data_donation->update([
                'status' => 'failed'
            ]);

        }

    }

    // ** Get Payment By Campaign
    public function GetPaymentByCampaign($id_campaign) {
        $get = Payment::select('payments.*', 'campaigns.title', 'users.name')
        ->leftJoin('campaigns', 'campaigns.id', '=', 'payments.campaign_id')
        ->leftJoin('users', 'users.id', '=', 'payments.users_id')
        ->where('payments.campaign_id', $id_campaign)
        ->paginate(10);
        return response()->json([
            "data" => $get
        ], 200);
    }
}
