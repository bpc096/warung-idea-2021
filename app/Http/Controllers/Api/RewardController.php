<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reward;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $campaign_id = $id;
        $rewards = Reward::whereCampaignId($id)->get();

        return response()->json([
            'success' => true,
            'message' => 'List all rewards based on campaign id and users id!',
            'data'    => $rewards
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
            'amount'                => 'required',
            'title'                 => 'required',
            'description'           => 'required',
        ];
        $this->validate($request, $rules);

        $user_id = auth()->guard('api')->user()->id;

        $data = array_merge(array_except($request->input(), '_token'), [
            'users_id'       => $user_id,
            'campaign_id'    => $id,
        ]);

        $create = Reward::create($data);

        //return JSON
        return response()->json([
            'success' => true,
            'message' => 'Reward Berhasil Dibuat!',
            'data'    => $data
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'amount'                => 'required',
            'title'                 => 'required',
            'description'           => 'required',
        ];
        $this->validate($request, $rules);

        $data = array_merge(array_except($request->input(), '_token'));

        $reward = Reward::where('id', $request->reward_id)->first();
        $reward->update($data);

        //return JSON
        if($reward){
            return response()->json([
                'success' => true,
                'message' => 'Reward Berhasil Diperbarui!',
                'data'    => $data
            ], 201);
        }else{
            return response()->json([
                'status' => 'error'
            ], 400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();

        if($reward){
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
