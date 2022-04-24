<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Campaign;
use App\Payment;
use App\Collaboration;
use App\CampaignDetail;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data campaigns
        $campaigns = Campaign::with('user')->with('sumPayment')->when(request()->q, function($campaigns) {
            $campaigns = $campaigns->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(100);

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Campaigns',
            'data'    => $campaigns
        ], 200);

    }

    public function index_user($users_id)
    {
        //get detail data campaign
        $campaign = Campaign::with('user')->with('sumPayment')->where('users_id', $users_id)->get();

        if($campaign) {

            //return with response JSON
            return response()->json([
                'success'   => true,
                'message'   => 'List Data Campaign By User Id',
                'data'      => $campaign
            ], 200);
        }
        else{
            //return with response JSON
            return response()->json([
                'success' => false,
                'message' => 'Data Campaign Tidak Ditemukan!',
            ], 404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'image'                    => 'required|image|mimes:png,jpg,jpeg',
          'title'                    => 'required|string',
          'category_id'              => 'required|string',
          'short_description'        => 'required|string',
          'target_donation'          => 'required|numeric',
          'max_date'                 => 'required|string',
          'description'              => 'required|string',
          'project_plan'             => 'required|string',
          'collaborators'            => 'nullable|array',
          'collaborators.*.name'     => 'nullable|string|distinct|min:3',
          // 'collaborators.*.id'       => 'nullable|numeric'
        ]);


        //upload image
        $image = $request->file('image');
        $image->storeAs('public/campaigns', $image->hashName());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $campaign = Campaign::create([
            'title'              => $request->title,
            'slug'               => Str::slug($request->title, '-'),
            'category_id'        => $request->category_id,
            'short_description'  => $request->short_description,
            'target_donation'    => $request->target_donation,
            'max_date'           => $request->max_date,
            'description'        => $request->description,
            'project_plan'       => $request->project_plan,
            'collaborators'      => $request->collaborators,
            'users_id'           => auth()->guard('api')->user()->id,
            'image'              => $image->hashName()
        ]);

        foreach ($request->collaborators as $collaborator) {
            CampaignDetail::create([
                'campaign_id' => $campaign->id,
                'users_id'    => $collaborator,
                'status'      => 'pending'
            ]);
        }

        //return JSON
        return response()->json([
            'success' => true,
            'message' => 'Campaign Berhasil Dibuat!',
            'data'    => $campaign
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get detail data campaign
        $campaign = Campaign::with('user')->with('sumPayment')->where('id', $id)->first();

        $collaborators = CampaignDetail::with('users')->get();

        //get data donation by campaign
        $payments = Payment::with('user')->where('campaign_id', $campaign->id)->where('status', 'success')->latest()->get();

        if($campaign) {

            //return with response JSON
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Data Campaign : '. $campaign->title,
                'data'      => $campaign,
                'collaborator' => $collaborators,
                'payments'  => $payments
            ], 200);
        }

        //return with response JSON
        return response()->json([
            'success' => false,
            'message' => 'Data Campaign Tidak Ditemukan!',
        ], 404);
    }

    public function getCollaborators($id)
    {
        $collaborators = Collaboration::project($id)->get();
        return $collaborators;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $validator = Validator::make($request->all(), [
            'title'                   => 'required|string',
            'category_id'             => 'required|string',
            'short_description'       => 'required|string',
            'target_donation'         => 'required|numeric',
            'max_date'                => 'required|string',
            'description'             => 'required|string',
            'project_plan'            => 'required|string',
            'collaborators'           => 'nullable|array',
            'collaborators.*name'     => 'nullable|string|distinct|min:3',
            'collaborators.*id'       => 'nullable|numeric'
        ]);

         //check jika image kosong
        if($request->file('image') == '') {

            //update data tanpa image
            $campaign = Campaign::findOrFail($campaign->id);
            $campaign->update([
                'title'              => $request->title,
                'slug'               => Str::slug($request->title, '-'),
                'category_id'        => $request->category_id,
                'short_description'  => $request->short_description,
                'target_donation'    => $request->target_donation,
                'max_date'           => $request->max_date,
                'description'        => $request->description,
                'project_plan'       => $request->project_plan,
                'collaborators'      => $request->collaborators,
                'users_id'           => auth()->guard('api')->user()->id,
            ]);

        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/campaigns/'.basename($campaign->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/campaigns', $image->hashName());

            //update dengan image baru
            $campaign = Campaign::findOrFail($campaign->id);
            $campaign->update([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title, '-'),
                'category_id'       => $request->category_id,
                'short_description' => $request->short_description,
                'target_donation'   => $request->target_donation,
                'max_date'          => $request->max_date,
                'description'       => $request->description,
                'project_plan'       => $request->project_plan,
                'collaborators'      => $request->collaborators,
                'users_id'           => auth()->guard('api')->user()->id,
                'image'             => $image->hashName()
            ]);
        }

        //return JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Campaign Berhasil Diupdate!',
            'data'    => $campaign
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        Storage::disk('local')->delete('public/campaigns/'.basename($campaign->image));
        $campaign->delete();

        if($campaign){
            return response()->json([
                'status' => 'success'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error'
            ], 400);
        }
    }
}
