<?php

namespace App\Http\Controllers\api\v1\PageBuilder;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\UrlRedirector;
use App\traits\api\v1\getAllReservedLinks;
use App\traits\api\v1\PageBuilder\pageBuilder;
use Illuminate\Http\Request;
use Route;

class Dashboard extends Controller
{
    use pageBuilder,getAllReservedLinks;

    public $profile;
    public $blocks;

    public function getProfiles(Request $request)
    {
        $profileImgs      = [];
        $profileTitles    = [];
        $profileSubtitles = [];
        $profileLinks     = [];
        $profiles         = Profile::query()->where('user_id', $request->userId)->orderByDesc('updated_at')->get();
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
        $blockTitles = [];
        $blockLinks  = [];
        $blockWidth  = [];
        $link        = $request->link;

        $this->profile = Profile::query()->where('link', $link)->first();
        $url           = UrlRedirector::query()->where('url', $link)->first();
        if ($url) {
            return redirect(route('redirectTo', $link));
        }
        if (!$this->profile) {
            return response()->json('404');
        }
        $this->blocks = $this->profile->block()->orderBy('sort')
            ->with(['pbOption', 'blockOption'])
            ->get();
        $data         = [
            'profile' => [
                'profile'         => $this->profile,
                'profileBgImg'    => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->bg_img),
                'profileImg'      => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->img),
                'profileTitle'    => $this->profile->title,
                'profileSubtitle' => $this->profile->subtitle,
            ],
        ];

        foreach ($this->blocks as $index => $block) {
            $i             = 0;
            $pbOptionCount = count($block->pbOption()->get());
            foreach ($block->pbOption()->get() as $key => $option) {
                $blockTitles[$index][$key] = $this->getBlockTitle($option->pivot);
                $blockLinks[$key]          = $option->link . $this->getBlockLink($option->pivot);
                $blockWidth[$index][$key]  = [
                    'lastHalf'      => $this->setBlockWidthHalf($block->blockOption->blockWidth, $i == $pbOptionCount - 1 ?? $i, $key),
                    'setBlockWidth' => $this->setBlockWidth($block->blockOption->blockWidth),
                ];
                $i++;
            }
        }
        $data['blocks'] = [
            'blocks'      => $this->blocks,
            'blockTitles' => $blockTitles,
            'blockLinks'  => $blockLinks,
            'blockWidth'  => $blockWidth,
        ];
        return response()->json($data);
    }

    public function submitNewProfile(Request $request)
    {
        $this->profileUrl = $request->usernameInput;
        $this->getAllReservedLinks();
        $coverImage   = $request->file('coverImage');
        $profileImage = $request->file('profileImage');
        $title        = $request->title;
        $subtitle     = $request->subtitle;
        $user_id      = $request->user_id;

        if (!Profile::query()->where('link', $this->profileUrl)->exists() && !$this->reservedLink) {
            $profile = Profile::query()->create([
                'link'     => $this->profileUrl,
                'title'    => $title,
                'subtitle' => $subtitle,
                'user_id'  => $user_id,
            ]);
            if ($coverImage) {
                $coverImage->storeAs('pb/profiles/profile-' . $profile->id, $request->coverImageName, 'public');
                $imgName = $request->coverImageName;
                $profile->update([
                    'bg_img' => $imgName,
                ]);
            }
            if ($profileImage) {
                $profileImage->storeAs('pb/profiles/profile-' . $profile->id, $request->profileImageName, 'public');
                $imgName = $request->profileImageName;
                $profile->update([
                    'img' => $imgName,
                ]);
            }
            return response()->json('profile created', 201);
        }
    }
}
