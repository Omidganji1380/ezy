<?php

namespace App\Http\Controllers\api\v1\PageBuilder;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Auth;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function getProfiles(Request $request)
    {
        $profileImgs      = [];
        $profileTitles    = [];
        $profileSubtitles = [];
        $profileLinks     = [];
        $profiles         = Profile::query()->where('user_id', $request->userId)->orderByDesc('created_at')->get();
        foreach ($profiles as $profile) {
            array_push($profileImgs, asset('/storage/pb/profiles/profile-' . $profile->id . '/' . $profile->img));
            array_push($profileTitles, $profile->title);
            array_push($profileSubtitles, $profile->subtitle);
            array_push($profileLinks, $profile->link);
        }
        $data = [
            'profiles'         => $profiles,
            'profileImgs'      => $profileImgs,
            'profileTitles'    => $profileTitles,
            'profileSubtitles' => $profileSubtitles,
            'profileLinks'     => $profileLinks,
        ];
        return response()->json($data);
    }

//    public function getProfileImg(Request $request)
//    {
////        dd($request->profile);
//        $profileImg = Profile::query()->find(2);
//        $profileImg = asset('/storage/pb/profiles/profile-' . $profileImg->id . '/' . $profileImg->img);
////        dd($profileImg);
//        return response()->json($profileImg);
//    }
}
