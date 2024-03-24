<?php

namespace App\Http\Controllers\api\v1\PageBuilder;

use App\Http\Controllers\Controller;
use App\Http\Controllers\pageBuilder\PageBuilderTrait;
use App\Http\Controllers\pageBuilder\profileGlobalOptions;
use App\Models\Block;
use App\Models\BlockPbOption;
use App\Models\Profile;
use App\Models\UrlRedirector;
use Auth;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    use PageBuilderTrait;
    use profileGlobalOptions;

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
            ->get()
//            ->sortBy('sort')
        ;
//        dd($this->blocks);
        $data = [
            'profile' => [
                'profile'         => $this->profile,
                'profileBgImg'    => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->bg_img),
                'profileImg'      => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->img),
                'profileTitle'    => $this->profile->title,
                'profileSubtitle' => $this->profile->subtitle,
            ]
        ];

        foreach ($this->blocks as $index => $block) {
            $i             = 0;
            $pbOptionCount = count($block->pbOption()->get());
            foreach ($block->pbOption()->get() as $key => $option) {
                $blockTitles[$index][$key] = $this->getBlockTitleTrait($option->pivot);
                $blockLinks[$key]          = $option->link . $this->getBlockLink($option->pivot);
                $blockWidth[$index][$key]  = [
                    'lastHalf'      => $this->setBlockWidthHalf($block->blockOption->blockWidth, $i == $pbOptionCount - 1??$i, $key),
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

//                dd($data['blocks']['blockLinks']);
        return response()->json($data);
    }

    public function getBlockLink($link)
    {
//        dd($link);
        $link = BlockPbOption::query()->where(['pbOption_id' => $link['pbOption_id'], 'block_id' => $link['block_id'], 'id' => $link['id']])->first();
//        dd($link);
        return $link->connectionWay;
    }

    public function setBlockWidthHalf($width, $loopLast, $loopIndex)
    {
        if ($width == 'half' && $loopLast % 2 != 0 && $loopIndex % 2 == 0) {
            return 'col-12';
        }
    }

    public function setBlockWidth($width)
    {
        if ($width == 'full') {
            return 'col-12';
        }
        elseif ($width == 'half') {
            return 'col-6 w-half-block';
        }
        elseif ($width == 'compress') {
            return 'col-auto';
        }
    }
}
