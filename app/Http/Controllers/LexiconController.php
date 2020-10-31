<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use SentimentIntensityAnalyzer;

class LexiconController extends Controller
{
    //
    public function index(Request $request){
        try{
            $textToTest = "Today only kinda sux! But I'll get by, lol";

            $sentimenter = new SentimentIntensityAnalyzer();
            $result = $sentimenter->getSentiment($textToTest);
            // print_r($result);

            return response()->json([
                'text' => $textToTest,
                'result' => $result
            ]);
        }catch(Exception $e){

        }
    }
}
