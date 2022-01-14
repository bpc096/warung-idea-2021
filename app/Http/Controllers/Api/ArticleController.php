<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

use function GuzzleHttp\Promise\all;

class ArticleController extends Controller
{
    /**
     * index
     * 
     * @param mixed $request
     * @return void
     */
    public function index()
    {
        //get data articles
        $articles = Article::all();

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Article',
            'data'    => $articles,
        ], 200);
    }
}
