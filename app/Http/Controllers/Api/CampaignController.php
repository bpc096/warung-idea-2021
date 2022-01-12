<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Campaign;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::latest()->when(request()->q, function($campaigns) {
            $campaigns = $campaigns->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List Data Campaign!',
            'data'    => $campaigns
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'image'             => 'required|image|mimes:png,jpg,jpeg',
            'title'             => 'required',
            'category_id'       => 'required',
            'target_donation'   => 'required|numeric',
            'max_date'          => 'required',
            'description'       => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/campaigns', $image->hashName());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $campaign = Campaign::create([
            'title'             => $request->title,
            'slug'              => Str::slug($request->title, '-'),
            'category_id'       => $request->category_id,
            'target_donation'   => $request->target_donation,
            'max_date'          => $request->max_date,
            'description'       => $request->description,
            'users_id'           => auth()->guard('api')->user()->id,
            'image'             => $image->hashName()
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'title'             => 'required',
            'category_id'       => 'required',
            'target_donation'   => 'required|numeric',
            'max_date'          => 'required',
            'description'       => 'required'
        ]);

         //check jika image kosong
        if($request->file('image') == '') {
            
            //update data tanpa image
            $campaign = Campaign::findOrFail($campaign->id);
            $campaign->update([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title, '-'),
                'category_id'       => $request->category_id,
                'target_donation'   => $request->target_donation,
                'max_date'          => $request->max_date,
                'description'       => $request->description,
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
                'target_donation'   => $request->target_donation,
                'max_date'          => $request->max_date,
                'description'       => $request->description,
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
