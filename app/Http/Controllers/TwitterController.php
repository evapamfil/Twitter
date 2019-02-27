<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{

    public function post_tweet(Tweet $tweet, Request $request)

    {
        $tweet->user()->associate($request->user());
        $tweet->content = $request->tweet;
        $tweet->save();

        return redirect('/');
    }

    public function get(Tweet $tweet, User $user) {
        $tweets = $tweet->all()->reverse();

        $user = Auth::user();

        $followers = $user->followers;
        $followings = $user->followings;

        $tweets = $tweet->whereIn(
            'user_id', $followings->pluck('id')->push($user->id)
        )->with('user');

        $followTweets = $tweets->get();

        return view ('home', compact('tweets', 'followers', 'followings', 'followTweets'));
    }

}
