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
    public         $pbOptions;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function updateHeaderProfile() {
//        return $this->request->all();
        $profile = Profile::query()
                          ->where('user_id', $this->request->user_id)
                          ->find($this->request->profile_id);
        //        return $profile;
        //        return $this->request->file('img');
        $img    = $this->request->file('img');
        $bg_img = $this->request->file('bg_img');
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
        //        if ($this->request->img) {
        //            Storage::disk('public')
        //                   ->delete('pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->img);
        //            $filename     = time() . '_' . $this->request->img->getFilename();
        //            $originalName = time() . '_' . $this->request->img->getClientOriginalName();
        //            $this->request->img->storeAs('pb/profiles/profile-' . $this->profile->id, $originalName, 'public');
        //            Storage::disk('local')
        //                   ->delete('livewire-tmp/' . $filename);
        //            $this->request->img = null;
        //            $this->profile->update([
        //                                       'img' => $originalName,
        //                                   ]);
        //        }
        //        if ($this->request->bg_img) {
        //            Storage::disk('public')
        //                   ->delete('pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->bg_img);
        //            $filename     = time() . '_' . $this->request->bg_img->getFilename();
        //            $originalName = time() . '_' . $this->request->bg_img->getClientOriginalName();
        //            $this->request->bg_img->storeAs('pb/profiles/profile-' . $this->profile->id, $originalName, 'public');
        //            Storage::disk('local')
        //                   ->delete('livewire-tmp/' . $filename);
        //            $this->request->bg_img = null;
        //            $this->profile->update([
        //                                       'bg_img' => $originalName,
        //                                   ]);
        //        }
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

    private function getProfileBlock() {
        $this->profile = Profile::query()
                                ->where('user_id', $this->request->user_id)
                                ->findOrFail($this->request->profile_id);
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

    private function insertBlock() {
        $this->getProfileBlock();
        if ($this->request['new_block']) {
            $this->blocks = Block::query()
                                 ->create([
                                              'sort'       => $this->blocks->count() + 1,
                                              'profile_id' => $this->profile->id,
                                          ]);
            BlockOption::query()
                       ->create([
                                    'block_id'             => $this->blocks->id,
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
        else
            $this->blocks = Block::query()
                                 ->find($this->request['block_id']);
    }

    public function addPbOption() {
        $this->insertBlock();
        for ($i = 0; $i < count($this->request->pbOption); $i++) {
            $this->blocks = $this->blocks->fresh();
            $sort         = $this->blocks->pbOption()
                                         ->get()
                                         ->count();
            BlockPbOption::query()
                         ->create([
                                      'block_id'      => $this->blocks->id,
                                      'pbOption_id'   => $this->request->pbOption[$i]['pbOption_id'],
                                      'sort'          => $sort + 1,
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
                                              'profile_id' => $this->request['profile_id'],
                                          ])
                                  ->find($this->request['item_id']);
    }
}
