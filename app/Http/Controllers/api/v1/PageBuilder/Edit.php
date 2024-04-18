<?php

namespace App\Http\Controllers\api\v1\PageBuilder;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\traits\api\v1\PageBuilder\pageBuilder;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use pageBuilder;

    public function pageBuilderEdit(Request $request)
    {
        $profile = Profile::query()
            ->where('user_id', $request->user_id)
            ->findOrFail($request->profile_id);
        $profile->update([
            'updated_at' => now(),
        ]);
        $blockTitles = [];
        $blockLinks  = [];
        $blockWidth  = [];

        $blocks = $profile->block()->orderBy('sort')
            ->with(['pbOption', 'blockOption'])
            ->get();

        $data = [
            'profile' => [
                'profile'         => $profile,
                'profileBgImg'    => asset('/storage/pb/profiles/profile-' . $profile->id . '/' . $profile->bg_img),
                'profileImg'      => asset('/storage/pb/profiles/profile-' . $profile->id . '/' . $profile->img),
                'profileTitle'    => $profile->title,
                'profileSubtitle' => $profile->subtitle,
            ],
        ];

        foreach ($blocks as $index => $block) {
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
            'blocks'      => $blocks,
            'blockTitles' => $blockTitles,
            'blockLinks'  => $blockLinks,
            'blockWidth'  => $blockWidth,
        ];
        return response()->json($data);
    }

}
