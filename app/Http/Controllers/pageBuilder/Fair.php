<?php

namespace App\Http\Controllers\pageBuilder;

use App\Models\Block;
use App\Models\BlockOption;
use App\Models\FairBlock;
use Storage;

trait Fair
{
    public function getOptionsFair($option, $newBlock)
    {
        if ($newBlock) {
            $this->newBlock = true;
        }
        else {
            $this->newBlock = false;
        }

        $this->options = [];
        $this->option  = $option;

        if ($option == 'نمایشگاه' || $option == 'fair') {
            $this->title  = 'نمایشگاه';
            $this->option = 'fair';
        }
        $this->insertFair();

        $this->options = FairBlock::query()->where('block_id', $this->block->id)->get();
    }

    public function insertFair()
    {
        if ($this->newBlock) {
            $lastSort = $this->blocks->last() ? $this->blocks->last()->sort + 1 : 0;
            $block    = Block::create([
                'profile_id' => $this->profile->id,
                'sort'       => $lastSort
            ]);
            BlockOption::create([
                'block_id'   => $block->id,
                'blockTitle' => $this->title,
                'option5'    => $this->title,
            ]);
            FairBlock::create([
                'block_id' => $block->id,
            ]);
            $this->blockFailOptions($block);
        }
        else {
            BlockOption::create([
                'block_id'   => $this->block->id,
                'blockTitle' => $this->title,
                'option5'    => $this->title,
            ]);
            FairBlock::create([
                'block_id' => $this->block->id,
            ]);
            $this->blockFailOptions($this->block);
        }
        $this->refreshPage();
    }

    public $blockFairItems  = [];
    public $fairTitle       = [];
    public $fairDescription = [];
    public $fairNumber      = [];
    public $fairImg         = [];
    public $fairLink        = [];
    public $fairImageUpload = [];

    public function blockFailOptions(Block $block/*,$newBlock*/)
    {
        $this->clearInputsTrait();
        $this->blockFairItems  = [];
        $this->fairTitle       = [];
        $this->fairDescription = [];
        $this->fairNumber      = [];
        $this->fairImg         = [];
        $this->fairLink        = [];

        $this->block = $block;
        $this->title = $block->blockOption->option5;

        $this->blockFairItems = FairBlock::query()->where(['block_id' => $this->block->id])->get();

        foreach ($this->blockFairItems as $item) {

            $this->fairTitle[$item->id]       = $item->title;
            $this->fairDescription[$item->id] = $item->description;
            $this->fairNumber[$item->id]      = $item->number;
            $this->fairImg[$item->id]         = $item->img;
            $this->fairLink[$item->id]        = $item->link;
        }


        $this->getBlockMoreOptions($block);

    }

    public function deleteBlockFairItem(FairBlock $fairBlock)
    {
        Storage::disk('public')->deleteDirectory('pb/profiles/profile-' . $this->profile->id . '/fairs/fair-' . $fairBlock->id);
        if (count($fairBlock->block->fair) == 1) {
            $fairBlock->block->delete();
            $this->refreshPage();
        }
        $fairBlock->delete();
        $this->mount($this->link);
        if (count($fairBlock->block->fair) != 1) {
            $this->blockFailOptions($this->block);
        }
    }

    public function removeFairImg(FairBlock $fairBlock)
    {
        Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/fairs/fair-' . $fairBlock->id . '/' . $fairBlock->img);
        $fairBlock->update([
            'img' => null
        ]);
        $this->blockFailOptions($this->block);
    }

    public function submitFair()
    {
        foreach ($this->blockFairItems as $item) {
            $item->update([
                'title'       => $this->fairTitle[$item->id],
                'description' => $this->fairDescription[$item->id],
                'link'        => $this->fairLink[$item->id],
            ]);

            if (isset($this->fairImageUpload[$item->id])) {
                Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/fairs/fair-' . $item->id . '/' . $item->img);
                $filename     = $this->fairImageUpload[$item->id]->getFilename();
                $originalName = time() . '_' . $this->fairImageUpload[$item->id]->getClientOriginalName();
                $this->fairImageUpload[$item->id]->storeAs('pb/profiles/profile-' . $this->profile->id . '/fairs/fair-' . $item->id, $originalName, 'public');
                Storage::disk('local')->delete('livewire-tmp/' . $filename);
                $this->fairImageUpload[$item->id] = null;
                $item->update([
                    'img' => $originalName,
                ]);
            }
        }


        $this->block->blockOption->update([
            'blockTitle'           => $this->blockTitle,
            'blockWidth'           => $this->blockItemsWidth,
            'blockBorder'          => $this->blockItemsBorder,
            'blockVisibility'      => $this->blockVisibility,
            'blockItemColor'       => $this->blockItemColor,
            'bgBlockItemColor'     => $this->bgBlockItemColor,
            'textBlockItemColor'   => $this->textBlockItemColor,
            'borderBlockItemColor' => $this->borderBlockItemColor,
        ]);
        $this->clearVariables();
        $this->clearInputs();
        $this->blockFairItems  = [];
        $this->fairTitle       = [];
        $this->fairDescription = [];
        $this->fairNumber      = [];
        $this->fairImg         = [];
        $this->fairLink        = [];
        $this->refreshPage();
    }
}
