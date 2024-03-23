<?php

namespace App\Http\Controllers\api\v1\PageBuilder;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\UrlRedirector;
use Auth;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public $profile;
    public $blocks;

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

    public function getView(Request $request)
    {
        $link = $request->link;

        $this->profile = Profile::query()->where('link', $link)->first();
        $url           = UrlRedirector::query()->where('url', $link)->first();
        if ($url) {
            return redirect(route('redirectTo', $link));
        }
        if (!$this->profile) {
            return response()->json('404');
        }
        $this->blocks = $this->profile->block()->get()->sortBy('sort');
//        dd($this->profile);
        $data = [
            'blocks'  => $this->blocks,
            'profile' => [
                'profile'         => $this->profile,
                'profileBgImg'    => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->bg_img),
                'profileImg'      => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->img),
                'profileTitle'    => $this->profile->title,
                'profileSubtitle' => $this->profile->subtitle,
            ]
        ];
        return response()->json($data);
    }
}
