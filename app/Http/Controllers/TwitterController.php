<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\User;
use Illuminate\Http\Request;

class TwitterController extends Controller
{

    public function post_tweet(Tweet $tweet, Request $request)

    {
        $tweet->user()->associate($request->user());
        $tweet->content = $request->tweet;
        $tweet->save();

        return redirect('/');
    }

    public function get(Tweet $tweet) {
        $tweets = $tweet->all()->reverse();

        return view ('home', compact('tweets'));
    }

}
