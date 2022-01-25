<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data categories
        $categories = Category::latest()->paginate(8);

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Categories',
            'data'    => $categories,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function most_funding()
    // {
    //     //get detail data category with most-funding campaign
    //     $category_most_funding = Category::latest()->paginate(8);

    //     if($category_most_funding) {

    //         //return with response JSON
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'List Data Most Funding Campaign Berdasarkan Category',
    //             'data'    => $category_most_funding,
    //         ], 200);
    //     }

    //     //return with response JSON
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Data Category Tidak Ditemukan!',
    //     ], 404);
    // }

    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($id)
    {
        //get detail data category with campaign
        $category = Category::with('campaigns.user', 'campaigns.sumPayment')->where('id', $id)->first();

        if($category) {

            //return with response JSON
            return response()->json([
                'success' => true,
                'message' => 'List Data Campaign Berdasarkan Category : '. $category->category_name,
                'data'    => $category,
            ], 200);
        }

        //return with response JSON
        return response()->json([
            'success' => false,
            'message' => 'Data Category Tidak Ditemukan!',
        ], 404);
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
