<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Campaign;
use App\Collaboration;

class CampaignCollaboratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function addCollaborator(Request $request, $id, Collaboration $collaboration)
    {
        $this->validate($request, [
            'collaborator'     => 'required|min:5',
        ]);

        $collaborator_name                = ($request->input('collaborator'));
        $collaboration->campaign_id       = $id;
        if( is_null($this->getId($collaborator_name)))
        {
            return response()->json([
                'success' => false,
                'message' => 'Kreator ini tidak ada',
            ], 404);
        }

        $collaborationStatus = $this->isCollaborator($id, $this->getId($collaborator_name));
        if(! is_null($collaborationStatus))
        {
            return response()->json([
                'success' => false,
                'message' => 'Kreator ini sudah menjadi kolaborator dalam campaign ini',
            ], 404);
        }

        $collaboration->collaborator_id  = $this->getId($collaborator_name);

        session(['title' => $this->getCampaignTitle($id),
                'creator_email' => $this->getEmail($collaborator_name)
        ]);

        $collaboration->save();

        return response()->json([
            'success' => true,
            'message' => $collaborator_name. ' telah berhasil ditambahkan ke campaign Anda',
        ], 404);
    }

     /**
     * Delete One Collaborator on a Project
     * @param  int $campaignId
     * @param  int $collaboratorId
     * @return route
     */
    public function deleteOneCollaborator($campaignId, $collaboratorId)
    {
        Collaboration::where('campaign_id', $campaignId)
                    ->where('collaborator_id', $collaboratorId)
                    ->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * Get id of the user
     * @param  string $username
     * @return mixed  null | integer
     */
    private function getId($name)
    {
        $result = User::where('name', $name)->first();

        return (is_null($result)) ? null : $result->id;
    }

    /**
     * Get the email of a user for use in sending emails
     * @param  string $username
     * @return string
     */
    private function getEmail($name)
    {
        return User::where('name', $name)->first()->email;
    }

    /**
     * Get the Project Name for use in sending email for Collaboration
     * @param  int $id
     * @return string
     */
    private function getCampaignTitle($id)
    {
        return Campaign::where('id', $id)->first()->title;
    }

    /**
     * Check if the user about to be added as a collaborator is already on on the project
     * @param  int  $projectId
     * @param  int  $collaboratorId
     * @return boolean
     */
    private function isCollaborator($campaignId, $collaboratorId)
    {
        return Collaboration::where('campaign_id', $campaignId)
                            ->where('collaborator_id', $collaboratorId)
                            ->first();
    }
}
