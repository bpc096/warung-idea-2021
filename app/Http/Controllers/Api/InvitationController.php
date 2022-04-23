<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CampaignDetail;
use App\Campaign;


class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($users_id)
    {
        $campaign_detail = CampaignDetail::with('campaigns')->with('users')
            ->where('users_id', $users_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'List Campaign Detail by campaign id and users id',
            'data'    => $campaign_detail
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * GET
     */
    // public function accept($users_id, $campaign_id)
    // {
    //     $accept = CampaignDetail::where('campaign_id', $campaign_id)
    //                 ->where('users_id', $users_id)->first();

    //     $accept->update([
    //         'status' => 'accept'
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Invitation Accepted!',
    //         'data'    => $accept
    //     ], 200);

    // }

    // public function reject($users_id, $campaign_id)
    // {
    //     $reject = CampaignDetail::where('campaign_id', $campaign_id)
    //                 ->where('users_id', $users_id)->first();

    //     $reject->update([
    //         'status' => "reject"
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'List Campaign Detail by campaign id and users id',
    //         'data'    => $reject
    //     ], 200);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request)
    {
        $accept = CampaignDetail::where('campaign_id', $request->campaign_id)
                    ->where('users_id', $request->users_id)->first();

        $accept->update([
            'status' => 'accept'
        ]);

        $acc = Campaign::where('id', $request->campaign_id)->first();

        $asd = array();
        $asd[0] = $request->users_id;

        $flag = false;
        
        foreach ($acc->collaborators as $collab) {
            if($collab == $asd[0])
            {
                $flag = true;
                break;
            }
        }

        if($flag == false)
        {
            array_merge($acc->collaborators, $asd);
        }

        $acc->save();

        return response()->json([
            'success' => true,
            'message' => 'Invitation Accepted!',
            'data'    => $accept
        ], 200);
    }

    public function reject(Request $request)
    {
        $reject = CampaignDetail::where('campaign_id', $request->campaign_id)
                    ->where('users_id', $request->users_id)->first();

        $reject->update([
            'status' => 'reject'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Invitation Rejected!',
            'data'    => $reject
        ], 200);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
