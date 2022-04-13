<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Update;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $campaign_id = $id;
        $updates = Update::whereCampaignId($id)->get();

        return response()->json([
            'success' => true,
            'message' => 'List all updates based on user id!',
            'data'    => $updates
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules = [
            'title'                => 'required',
            'description'          => 'required',
        ];
        $this->validate($request, $rules);

        $user_id = auth()->guard('api')->user()->id;

        $data = array_merge(array_except($request->input(), '_token'), [
            'users_id'       => $user_id,
            'campaign_id'    => $id,
        ]);

        $create = Update::create($data);

        //return JSON
        return response()->json([
            'success' => true,
            'message' => 'Update Berhasil Dibuat!',
            'data'    => $data
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $update_id)
    {
        $rules = [
            'title'                => 'required',
            'description'          => 'required',
        ];
        $this->validate($request, $rules);

        $data = array_merge(array_except($request->input(), '_token'));

        $update = Update::whereId($update_id);
        $update->update($data);

        //return JSON

        return response()->json([
            'success' => true,
            'message' => 'Update Berhasil Diperbarui!',
            'data'    => $data
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @param  \App\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $update = Update::findOrFail($id);
        $update->delete();

        if($update){
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
