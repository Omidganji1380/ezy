<?php

namespace App\Http\Controllers\pageBuilder;

use App\Models\Block;
use App\Models\BlockOption;
use App\Models\BlockText;

trait textBlock
{
    public $blockText;
    public $blockTextText;
    public $blockTextSize;
    public $blockTextAlign;
    public $blockTextColor;

//    public $blockTextItem;

    public function submitTextOption()
    {
//        dd($this->blockTextText);
//        dd($this->blockText,$this->blockTextText,$this->blockTextSize,$this->blockTextAlign,$this->blockTextColor);
        $this->blockText->update([
            'text'      => "\n".$this->blockTextText,
            'textSize'  => $this->blockTextSize,
            'textAlign' => $this->blockTextAlign,
            'textColor' => $this->blockTextColor,
        ]);
        $this->clearInputs();
        $this->mount($this->link);
    }

    public function blockTextOptionsTrait(Block $block/*,$newBlock*/)
    {
        $this->clearInputsTrait();
        $this->block = $block;
        $this->title = $block->blockOption->option5;

        $this->blockText      = BlockText::query()->where(['block_id' => $this->block->id])->first();
        $this->blockTextText  = $this->blockText->text;
        $this->blockTextSize  = $this->blockText->textSize;
        $this->blockTextAlign = $this->blockText->textAlign;
        $this->blockTextColor = $this->blockText->textColor;
        $this->getBlockMoreOptions($block);

//        dd($this->blockText);
    }

    public function getOptionsTextTrait($option, $newBlock)
    {
        if ($newBlock) {
            $this->newBlock = true;
        }
        else {
            $this->newBlock = false;
        }

        $this->options = [];
        $this->option  = null;
        $this->option  = $option;

        if ($option == 'متن یا توضیح' || $option == 'text') {
            $this->title  = 'متن یا توضیح';
            $this->option = 'text';
        }
        $this->insertTextTrait();

        $this->options = BlockText::query()->where('block_id', $this->block->id)->get();
    }

    public function insertTextTrait()
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
            BlockText::create([
                'block_id' => $block->id,
            ]);
            $this->blockTextOptionsTrait($block);
        }
        else {
            BlockOption::create([
                'block_id'   => $this->block->id,
                'blockTitle' => $this->title,
                'option5'    => $this->title,
            ]);
            BlockText::create([
                'block_id' => $this->block->id,
            ]);
            $this->blockTextOptionsTrait($this->block);
        }
        $this->refreshPage();
    }

}
