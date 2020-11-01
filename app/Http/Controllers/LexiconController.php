<?php

namespace App\Http\Controllers;
use Exception;
use Facebook\Facebook;
use Illuminate\Http\Request;
use SentimentIntensityAnalyzer;
use Illuminate\Support\Facades\Log;
use Thujohn\Twitter\Facades\Twitter;

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

    public function twitter(Request $request){
        try {
            if($request->has('username')){
                $response = Twitter::getUserTimeline(['screen_name' => $request->username, 'count' => 100, 'format' => 'object']);
                $sentimenter = new SentimentIntensityAnalyzer();
                foreach($response as $res){
                    Log::error($res->text.' error twitter');
                    $result = $sentimenter->getSentiment($res->text);
                    
                    if(!empty($result)){
                        $res->pos = $result['pos'];
                        $res->neu = $result['neu'];
                        $res->neg = $result['neg'];
                    }else{
                        $res->pos = 0;
                        $res->neu = 0;
                        $res->neg = 0;
                    }
                    
                    // 
                    // 
                }
                $data['response'] = $response;
            }else{
                $data['response'] = NULL;
            }
            // Returns a `Facebook\FacebookResponse` object
            return view('twitter', $data);
        }catch(Exception $e){
            Log::error($e->getMessage() .' error twitter');
        }    
    }
}
