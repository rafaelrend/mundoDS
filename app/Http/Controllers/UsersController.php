<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FollowResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\SuggestionResource;
use App\Show;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(8);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user = User::where('id', $user->id)
            ->first();
        return view('users.show', compact('user'));
    }

    public function myFavorites()
    {
        $myFavorites = Auth::user()->favorites()->paginate(5);

        return view('users.my_favorites', compact('myFavorites'));
    }

    public function dashFavorites($id)
    {
        $myFavorites = User::find($id)->favorites;

        return $myFavorites;
    }

    public function myWatched()
    {
        $myWatched = Auth::user()->watches()->paginate(5);
        return view('users.my_watched', compact('myWatched'));
    }

    public function myProfile()
    {
        $myProfile = Auth::user();

        return view('users.my_profile', compact('myProfile'));
    }

    public function chat()
    {
        return view('users.chat');
    }

    public function following()
    {
        $following = UserResource::collection(Auth::user()->follows);

        return view('users.following', compact('following'));
    }

    public function followUser(User $user)
    {
        Auth::user()->follows()->attach($user->id);

        return back();
    }

    public function unfollowUser(User $user)
    {
        Auth::user()->follows()->detach($user->id);

        return back();
    }

    public function friends($id) {
        $following = Follow::select('user_id')
                            ->where('following_id', $id)
                            ->get();

        $friends = Follow::where('user_id', $id)
                            ->whereIn('following_id', $following)
                            ->get();

        return FollowResource::collection($friends);
    }

    public function suggestions($user) {
        $suggestions = DB::table('favorites')
            ->select('suggestions.suggestion')
            ->distinct()
            ->join('suggestions', 'suggestions.show_id', '=', 'favorites.show_id')
            ->where('favorites.user_id', $user)
            ->whereNotIn('suggestions.suggestion', function($q) use ($user){
                $q->select('show_id')
                  ->from('favorites')
                  ->where('user_id', $user);
            })
            ->inRandomOrder()
            ->take(6)
            ->get();

        return SuggestionResource::collection($suggestions);
    }
}
