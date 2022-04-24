<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $campaign_id = $id;
        $faqs = Faq::whereCampaignId($id)->get();

        return response()->json([
            'success' => true,
            'message' => 'List all faqs based on campaign id and users id!',
            'data'    => $faqs
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

        $create = Faq::create($data);

        //return JSON
        return response()->json([
            'success' => true,
            'message' => 'Faq Berhasil Dibuat!',
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
            'title'                => 'required',
            'description'          => 'required',
        ];
        $this->validate($request, $rules);

        $data = array_merge(array_except($request->input(), '_token'));

        $faq = Faq::where('id', $request->faq_id);
        $faq->update($data);

        //return JSON

        return response()->json([
            'success' => true,
            'message' => 'Faq Berhasil Diperbarui!',
            'data'    => $data
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
        $faq = Faq::findOrFail($id);
        $faq->delete();

        if($faq){
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
