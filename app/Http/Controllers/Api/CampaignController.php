<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Campaign;
use App\Payment;
use App\CampaignDetail;
use App\Notifications;

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
        $campaigns = Campaign::with('user')
        ->where("is_approved", '1') // ** Show campaign only approved campaign
        ->where("deleted_at", null) // ** And Not Deleted
        ->with('sumPayment')
        ->with('likeCounter')
        ->when(request()->q, function($campaigns) {
            $campaigns = $campaigns->where('title', 'like', '%'. request()->q . '%');
        })
        ->latest()
        ->paginate(100);

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
        $campaign = Campaign::with('user')
        ->with('sumPayment')
        ->withCount('updates')
        ->withCount('faqs')
        ->where('users_id', $users_id)->get();

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
            'collaborators.*.id'       => 'nullable|numeric'
        ]);


        //upload image
        $image = $request->file('image');
        if(!empty($image)) {
            $image->storeAs('public/campaigns', $image->hashName());
        }


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

        if(!empty($request->collaborators[0])) {
            foreach ($request->collaborators as $collaborator) {
                CampaignDetail::create([
                    'campaign_id' => $campaign->id,
                    'users_id'    => $collaborator,
                    'status'      => 'pending'
                ]);

                // ** Create notification for each collaborators
                $notif = new Notifications;
                $notif->title   = "Invitation from ".auth()->guard('api')->user()->name;
                $notif->from    = auth()->guard('api')->user()->id;
                $notif->to      = $collaborator;
                $notif->content = "You have been invited to join in ".$request->title." campaign.";
                $notif->is_read = '0';
                $notif->save();
            }
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
        $campaign = Campaign::with('user')
        ->with('sumPayment')
        ->with('likeCounter')
        ->where('id', $id)->first();

        $collaborators = CampaignDetail::with('users')->where("campaign_id", $id)->get();

        //get data donation by campaign
        $payments = Payment::with('user')->where('campaign_id', $campaign->id)->where('status', 'success')->latest()->get();

        if($campaign) {
            //return with response JSON
            return response()->json([
                'success'       => true,
                'message'       => 'Detail Data Campaign : '. $campaign->title,
                'data'          => $campaign,
                'collaborators' => $collaborators,
                'payments'      => $payments
            ], 200);
        }

        //return with response JSON
        return response()->json([
            'success' => false,
            'message' => 'Data Campaign Tidak Ditemukan!',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign, CampaignDetail $campaignDetail)
    {
        $validator = Validator::make($request->all(), [
            'title'                    => 'required|string',
            'category_id'              => 'required|string',
            'short_description'        => 'required|string',
            'target_donation'          => 'required|numeric',
            'max_date'                 => 'required|string',
            'description'              => 'required|string',
            'project_plan'             => 'required|string',
            'collaborators'            => 'nullable|array',
            'collaborators.*.id'       => 'nullable|numeric'
        ]);

         //check jika image kosong
        if(empty($request->file('image'))) {
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

            // ** Jika collaborator dihapus
            $getCurrentCollab = CampaignDetail::where("campaign_id", $campaign->id)->get();
            foreach($getCurrentCollab as $data) {
                if(!in_array($data->users_id, json_decode($request->collaborators))) {
                    CampaignDetail::where("users_id", $data->users_id)->delete();
                }
            }

            // ** Update collaborator
            foreach(json_decode($request->collaborators) as $collab) {
                $checkCollaboratorExist = CampaignDetail::where("campaign_id", $campaign->id)
                ->where("users_id", $collab)
                ->first();
                
                
                // **  Jika ada collaborator baru, insert new
                if(empty($checkCollaboratorExist)) {
                    $newCollaborator = new CampaignDetail;
                    $newCollaborator->campaign_id = $campaign->id;
                    $newCollaborator->users_id = $collab;
                    $newCollaborator->status = "pending";
                    $newCollaborator->save();
                }                
            }
        }
        else {
            //hapus image lama
            Storage::disk('local')->delete('public/campaigns/'.basename($campaign->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/campaigns', $image->hashName());

            //update dengan image baru
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
                'image'              => $image->hashName()
            ]);

            // ** Jika collaborator dihapus
            $getCurrentCollab = CampaignDetail::where("campaign_id", $campaign->id)->get();
            foreach($getCurrentCollab as $data) {
                if(!in_array($data->users_id, json_decode($request->collaborators))) {
                    CampaignDetail::where("users_id", $data->users_id)->delete();
                }
            }

            // ** Update collaborator
            foreach(json_decode($request->collaborators) as $collab) {
                $checkCollaboratorExist = CampaignDetail::where("campaign_id", $campaign->id)
                ->where("users_id", $collab)
                ->first();
                
                
                // **  Jika ada collaborator baru, insert new
                if(empty($checkCollaboratorExist)) {
                    $newCollaborator = new CampaignDetail;
                    $newCollaborator->campaign_id = $campaign->id;
                    $newCollaborator->users_id = $collab;
                    $newCollaborator->status = "pending";
                    $newCollaborator->save();
                }                
            }
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
        // ** Approval Delete
        $campaign = Campaign::where('id', $id)->update([
            "is_delete_approved" => '0' // ** Set to pending
        ]);
        // Storage::disk('local')->delete('public/campaigns/'.basename($campaign->image));
        // $campaign->delete();

        if($campaign){
            return response()->json([
                'status' => 'success',
                'message' => 'Your delete request has been sent to admin. Please wait for admin confirmation.'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to request delete.'
            ], 400);
        }
    }

    // ** Approve Campaign
    public function approve_campaign($id) {
        $update = Campaign::where('id', $id)->update([
            "is_approved" => '1'
        ]);

        if($update) {
            return response()->json([
                "success" => true,
                "message" => "Campaign has been approved"
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message" => "Failed to approve"
        ], 500);
    }

    // ** Reject Campaign
    public function reject_campaign($id) {
        $update = Campaign::where('id', $id)->update([
            "is_approved" => '2'
        ]);

        if($update) {
            return response()->json([
                "success" => true,
                "message" => "Campaign has been rejected"
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message" => "Failed to reject"
        ], 500);
    }

    // ** Approve Delete Campaign
    public function approve_delete_campaign($id) {
        $update = Campaign::where('id', $id)->update([
            "is_delete_approved" => '1'
        ]);

        if($update) {
            // If has been approved, then do delete
            $campaign = Campaign::findOrFail($id);
            $campaign->delete();

            return response()->json([
                "success" => true,
                "message" => "Campaign has been approved to deleted"
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message" => "Failed to approve delete campaign"
        ], 500);
    }

    // ** Reject Delete Campaign
    public function reject_delete_campaign($id) {
        $update = Campaign::where('id', $id)->update([
            "is_delete_approved" => '2'
        ]);

        if($update) {
            return response()->json([
                "success" => true,
                "message" => "Delete Campaign has been rejected"
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message" => "Failed to reject delete campaign"
        ], 500);
    }

    // ** Get List Collaboration
    public function get_list_collaboration($id_user) {
        $campaigns = Campaign::select('campaigns.*',
            'campaign_details.users_id',
            'campaign_details.status',
            'payments.amount',
            'payments.snap_token',
            'payments.status as payment_status',
        )
        ->leftJoin('campaign_details', 'campaign_details.campaign_id', '=', 'campaigns.id')
        ->leftJoin('payments', 'payments.campaign_id', '=', 'campaigns.id')
        ->where("campaign_details.users_id", $id_user)
        ->get();

        // ** Extract Data
        $result = [];
        foreach($campaigns as $campaign) {
            $data = [];
            $data["id"] = $campaign->id;
            $data["users_id"] = $campaign->users_id;
            $data["category_id"] = $campaign->category_id;
            $data["title"] = $campaign->title;
            $data["slug"] = $campaign->slug;
            $data["short_description"] = $campaign->short_description;
            $data["target_donation"] = $campaign->target_donation;
            $data["max_date"] = $campaign->max_date;
            $data["image"] = $campaign->image;
            $data["description"] = $campaign->description;
            $data["project_plan"] = $campaign->project_plan;
            $data["created_at"] = $campaign->created_at;
            $data["updated_at"] = $campaign->updated_at;
            $data["is_approved"] = $campaign->is_approved;
            $data["deleted_at"] = $campaign->deleted_at;
            $data["is_delete_approved"] = $campaign->is_delete_approved;
            $data["status"] = $campaign->status;
            $data["donation"] = [
                "amount" => $campaign->amount,
                "snap_token" => $campaign->snap_token,
                "payment_status" => $campaign->payment_status
            ];
            $result[] = $data;
        }

        return response()->json([
            "success" => true,
            "collaborations" => $result
        ], 200);
    }

    // ** Get All Campaigns(For Admin)
    public function GetAllCampaigns() {
        $get = Campaign::select('campaigns.*', 'categories.category_name', 'users.name as created_by')
        ->leftJoin('categories', 'categories.id',  '=', 'campaigns.category_id')
        ->leftJoin('users', 'users.id',  '=', 'campaigns.users_id')
        ->where("campaigns.deleted_at", null)
        ->paginate(10);
        return response()->json([
            "all_campaigns" => $get
        ], 200);
    }

    public function GetCollaborator($id_campaign) {
        $get = CampaignDetail::select('campaign_details.*', 'users.name')
        ->join('users', 'users.id', '=', 'campaign_details.users_id')
        ->where('campaign_details.campaign_id', $id_campaign)
        ->paginate(10);
        return response()->json([
            'success' => true,
            'collaborators' => $get
        ], 200);
    }

    // ** Like Campaign
    public function likeCampaign($id) {
      $campaign = Campaign::find($id);
      $campaign->like();
      $campaign->save();
      return response()->json([
        'success' => true,
        'message' => 'Campaign Like Succesfully!'
      ], 200);
    }

    // ** Unlike Campaign
    public function unlikeCampaign($id) {
      $campaign = Campaign::find($id);
      $campaign->unlike();
      $campaign->save();
      return response()->json([
        'success' => true,
        'message' => 'Campaign Unlike Succesfully!'
      ], 200);
    }
}
