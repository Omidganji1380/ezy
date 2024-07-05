<?php

namespace App\Http\Controllers\api\v1\PageBuilder;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\pbOption;
use App\Models\Profile;
use App\Models\UrlRedirector;
use App\Models\User;
use App\Responses\Errors;
use App\traits\api\JsonResponse;
use App\traits\api\v1\getAllReservedLinks;
use App\traits\api\v1\PageBuilder\pageBuilder;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    use pageBuilder, getAllReservedLinks, JsonResponse;

    public $profile;
    public $blocks;
    public $user;
    public $request;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->user    = User::query()
                             ->whereUuid($this->request->user_uuid)
                             ->first();
    }

    public function getProfiles() {
        $profiles = Profile::query()
                           ->where('user_id', $this->user->id)
                           ->orderByDesc('updated_at')
                           ->get();
        foreach ($profiles as $profile) {
            $profile['img'] = asset('/storage/pb/profiles/profile-' . $profile->id . '/' . $profile->img);
        }
        $data = [
            'profiles' => $profiles,
        ];
        return response()->json($data);
    }

    public function getView() {
        $link = $this->request->link;

        $this->profile = Profile::query()
                                ->where('link', $link)
                                ->first();
        $url           = UrlRedirector::query()
                                      ->where('url', $link)
                                      ->first();
        if ($url) {
            return redirect(route('redirectTo', $link));
        }
        if (!$this->profile) {
            return response()->json('Profile not found');
        }
        $this->blocks            = $this->profile->block()
                                                 ->orderBy('sort')
                                                 ->with([
                                                            'pbOption',
                                                            'blockOption',
                                                            'text',
                                                            'fair',
                                                            'banner',
                                                            'menu',
                                                            'video',
                                                        ])
                                                 ->get();
        $this->profile['img']    = asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' .
                                         $this->profile->img);
        $this->profile['bg_img'] = asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' .
                                         $this->profile->bg_img);

        $data = [
            'profile' => $this->profile,
        ];

        $this->blocks->each(function (Block $block) {
            $block->pbOption->each(function (pbOption $pbOption, $key) use ($block) {
                $i             = 0;
                $pbOptionCount = count($block->pbOption()
                                             ->get());
                $a             = [
//                    $pbOption['title'] = $this->getBlockTitle($pbOption->pivot),
//                    $pbOption['link'] = $pbOption->link . $this->getBlockLink($pbOption->pivot),
                    $pbOption['block_width'] = [
                        'lastHalf'      => $this->setBlockWidthHalf($block->blockOption->blockWidth, $i ==
                                                                                                     $pbOptionCount - 1
                                                                                                     ?? $i, $key),
                        'setBlockWidth' => $this->setBlockWidth($block->blockOption->blockWidth),
                    ],
                ];
                return $a;
            });

        });
        $data['blocks'] = $this->blocks;

        return response()->json($data);
    }

    public function submitNewProfile(Request $request) {
        if (!$this->user) {
            return $this->throwError(Errors::$_USER_NOT_FOUND);
        }
        $this->profileUrl = $this->request->usernameInput;
        $this->getAllReservedLinks();
        $coverImage   = $this->request->file('coverImage');
        $profileImage = $this->request->file('profileImage');
        $title        = $this->request->title;
        $subtitle     = $this->request->subtitle;
        $user_id      = $this->user->id;
        if ($this->reservedLink > 0) {
            return $this->throwError(Errors::$_RESERVED_URLS);
        }
        if (!Profile::query()
                    ->where('link', $this->profileUrl)
                    ->exists() && !$this->reservedLink) {
            $profile = Profile::query()
                              ->create([
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
