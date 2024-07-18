<?php

namespace App\Http\Controllers\api\v1\PageBuilder;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\BlockOption;
use App\Models\BlockPbOption;
use App\Models\pbOption;
use App\Models\Profile;
use App\traits\api\v1\PageBuilder\pageBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Storage;

class Edit extends Controller
{
    use pageBuilder;

    public Request $request;
    public         $profile;
    public         $blocks;
    public Block   $block;
    public         $pbOptions;

    public function addPbBlock() {
        $request = $this->request->all();
        foreach ($request['items'] as $item) {
            $pbOption = pbOption::query()
                                ->find($item['id']);
            dd($item, $pbOption);
        }
        dd($this->request->all());
        $pbOption = pbOption::query()
                            ->where(['for' => $this->request['for']]);
    }

    public function getPbOptions() {
        $pbOptions = pbOption::query()
                             ->get()
                             ->groupBy('for');
        return $pbOptions;
    }

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function updateHeaderProfile() {
        $profile = Profile::query()
                          ->where('user_id', $this->request->user_id)
                          ->find($this->request->profile_id);
        $img     = $this->request->file('img');
        $bg_img  = $this->request->file('bg_img');
        if ($img) {
            Storage::disk('public')
                   ->delete('pb/profiles/profile-' . $profile->id . '/' . $profile->img);
            $imgName = "profile-{$profile->id}-cover-" . time();
            $img->storeAs('pb/profiles/profile-' . $profile->id, $imgName, 'public');
            $profile->update([
                                 'img' => $imgName,
                             ]);
        }
        if ($bg_img) {
            Storage::disk('public')
                   ->delete('pb/profiles/profile-' . $profile->id . '/' . $profile->bg_img);
            $imgName = "profile-{$profile->id}-backcover-" . time();
            $bg_img->storeAs('pb/profiles/profile-' . $profile->id, $imgName, 'public');
            $profile->update([
                                 'bg_img' => $imgName,
                             ]);
        }
        $profile->update([
                             'title'      => $this->request->title,
                             'subtitle'   => $this->request->subtitle,
                             'img_border' => $this->request->img_border,
                             'bg_border'  => $this->request->bg_border,
                             'textColor'  => $this->request->textColor,
                         ]);
        return $profile;
    }

    public function sorting() {
        $block_id = $this->request->block_id;
        for ($i = 0; $i < count($block_id); $i++) {
            Block::query()
                 ->find($block_id[$i])
                 ->update([
                              'sort' => $i,
                          ]);
        }
        $blocks = Block::query()
                       ->whereIn('id', $this->request->block_id)
                       ->get();
        return $blocks;
    }

    public function __destruct() {
        $this->blocks = $this->blocks->fresh();
    }

    public function getProfileBlock() {
        $this->profile = Profile::query()
                                ->where('user_id', $this->request->user_id)
                                ->find($this->request->profile_id);
        $this->profile->update([
                                   'updated_at' => now(),
                               ]);

        $this->blocks    = $this->profile->block()
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
        $this->pbOptions = pbOption::query()
                                   ->when($this->request['for'], function (Builder $query) {
                                       $query->where('for', $this->request['for']);
                                   })
                                   ->get();
    }

    public function pageBuilderEdit() {
        $this->getProfileBlock();

        $data = [
            'profile' => [
                'profile'         => $this->profile,
                'profileBgImg'    => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' .
                                           $this->profile->bg_img),
                'profileImg'      => asset('/storage/pb/profiles/profile-' . $this->profile->id . '/' .
                                           $this->profile->img),
                'profileTitle'    => $this->profile->title,
                'profileSubtitle' => $this->profile->subtitle,
            ],
        ];
        $this->blocks->each(function (Block $block) {
            $block->pbOption->each(function (pbOption $pbOption, $key) use ($block) {
                $i             = 0;
                $pbOptionCount = count($block->pbOption()
                                             ->get());
                $a             = [
                    $pbOption['title'] = $this->getBlockTitle($pbOption->pivot),
                    $pbOption['link'] = $pbOption->link . $this->getBlockLink($pbOption->pivot),
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

    public function insertBlock() {
        $this->getProfileBlock();
        if ($this->request['new_block']) {
            $this->block = Block::query()
                                ->create([
                                             'sort'       => $this->blocks->count() + 1,
                                             'profile_id' => $this->profile->id,
                                         ]);
            BlockOption::query()
                       ->create([
                                    'block_id'             => $this->block->id,
                                    'blockVisibility'      => $this->request->blockVisibility,
                                    'blockTitle'           => $this->request->blockTitle,
                                    'blockWidth'           => $this->request->blockWidth,
                                    'blockBorder'          => $this->request->blockBorder,
                                    'blockItemColor'       => $this->request->blockItemColor,
                                    'bgBlockItemColor'     => $this->request->bgBlockItemColor,
                                    'borderBlockItemColor' => $this->request->borderBlockItemColor,
                                    'textBlockItemColor'   => $this->request->textBlockItemColor,
                                    'option1'              => $this->request->option1,
                                    'option2'              => $this->request->option2,
                                    'option3'              => $this->request->option3,
                                    'option4'              => $this->request->option4,
                                    'option5'              => $this->request->option5,
                                ]);
        }
        else {
            $this->block = Block::query()
                                ->find($this->request['block_id']);
            $this->block->blockOption()
                        ->update([
                                     "blockVisibility"      => $this->request["blockVisibility"],
                                     "blockTitle"           => $this->request["blockTitle"],
                                     "blockWidth"           => $this->request["blockWidth"],
                                     "blockBorder"          => $this->request["blockBorder"],
                                     "blockItemColor"       => $this->request["blockItemColor"],
                                     "bgBlockItemColor"     => $this->request["bgBlockItemColor"],
                                     "borderBlockItemColor" => $this->request["borderBlockItemColor"],
                                     "textBlockItemColor"   => $this->request["textBlockItemColor"],
                                     "option1"              => $this->request["option1"],
                                     "option2"              => $this->request["option2"],
                                     "option3"              => $this->request["option3"],
                                     "option4"              => $this->request["option4"],
                                     "option5"              => $this->request["option5"],
                                 ]);
        }
    }

    public function addPbOption() {
        $this->insertBlock();
        for ($i = 0; $i < count($this->request->pbOption); $i++) {
            $block = $this->block->fresh();
            $sort = $block->pbOption()
                          ->get()
                          ->count();
            if (isset($this->request->pbOption[$i]['id']))
                BlockPbOption::query()
                             ->find($this->request->pbOption[$i]['id'])
                             ->update([
                                          'sort'          => $i,
                                          'title'         => $this->request->pbOption[$i]['title'],
                                          'connectionWay' => $this->request->pbOption[$i]['connectionWay'],
                                          'extraText'     => $this->request->pbOption[$i]['extraText'],
                                      ]);
            else
                BlockPbOption::query()
                             ->create([
                                          'block_id'      => $block->id,
                                          'pbOption_id'   => $this->request->pbOption[$i]['pbOption_id'],
                                          'sort'          => $i,
                                          'title'         => $this->request->pbOption[$i]['title'],
                                          'connectionWay' => $this->request->pbOption[$i]['connectionWay'],
                                          'extraText'     => $this->request->pbOption[$i]['extraText'],
                                      ]);
        }
        return $this->blocks->fresh();
    }

    public function deleteBlock() {
        $block = Block::query()
                      ->where(['profile_id' => $this->request['profile_id']])
                      ->find($this->request['block_id']);
        if ($block) {
            if ($block->blockOption)
                $block->blockOption()
                      ->first()
                      ->delete();
            $block->delete();
            return response()->json('Block deleted');
        }
        else {
            return response()->json('Block not found!', 404);
        }
    }

    public function deleteBlockItem() {
        $blockItem = BlockPbOption::query()
                                  ->where([
                                              'block_id'   => $this->request['block_id'],
//                                              'profile_id' => $this->request['profile_id'],
                                          ])
                                  ->find($this->request['item_id']);
//        dd($blockItem);
        return $blockItem->delete();
    }
}
