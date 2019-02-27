<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function profil(User $user, Tweet $tweet, $username)
    {
        $user = $user->where('username', $username)->first();
        $id = $user->id;

        $tweets = $tweet->where('user_id', $id)->get();

        $followers = $user->followers;
        $followings = $user->followings;



        return view('profil', compact('user', 'tweets', 'followers', 'followings'));
    }

    public function followUser(int $profileId)
    {
        $user = User::find($profileId);

        if (!$user) {

            return redirect()->back()->with('error', 'User does not exist.');
        }

        $user->followers()->attach(auth()->user()->id);
        return redirect()->back()->with('success', 'Successfully followed the user.');


    }

    public function unFollowUser(int $profileId)
    {
        $user = User::find($profileId);
        if (!$user) {
            return redirect()->back()->with('error', 'User does not exist.');
        }

        $user->followers()->detach(auth()->user()->id);

        return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }

    public function edit(User $user)
    {
        return view('edit_profil', compact('user'));
    }

    public function updateProfil(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',

        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;


        $avatarName = $user->id . 'avatar' . time() . '.' .request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars', $avatarName);

        $user->avatar = $avatarName;

        $user->save();
        return redirect()->route('profil', [$user->username]);

    }

}
