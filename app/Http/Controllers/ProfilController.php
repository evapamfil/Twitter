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
        //$followersId = $followers->user->id;
        $followings = $user->followings;

        //dd($followers->toArray());

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

    public function edit(User $user){
        return view('edit_profil', compact('user'));
    }

    public function updateProfil(Request $request, $id)
    {
        if($request->hasFile('avatar')){
            // Get filename with the extension
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public/avatar', $fileNameToStore);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
       if($request->hasFile('avatar')){
            $user->avatar = $fileNameToStore;
        }
        $user->save();
        return redirect()->route('profil', [$user->username]);

    }

}
