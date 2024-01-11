<?php

namespace App\Livewire\Front\Pagebuilder;

use App\Models\Block;
use App\Models\BlockOption;
use App\Models\BlockPbOption;
use App\Models\pbOption;
use App\Models\Profile;
use Livewire\Component;

class Pagebuilder extends Component
{
    public $options = [];
    public $option;

    public $title;
    public $profile;
    public $link;
    public $blocks;
    public $blockItems = [];
    public $block;
    public $blockItemTitle;
    public $blockItemConnectionWay;
    public $blockItemExtraText;
    public $newBlock   = true;

//    public $blockItems=[];

    public function mount($link)
    {
        $this->link    = $link;
        $this->profile = Profile::query()->with('block')->where('link', $link)->first();
        if (!$this->profile) {
            abort(404);
        }
//        dd($this->profile->block[0]->blockOption->blockTitle);
        $this->blocks = $this->profile->block;
    }

    public function insertBlock(pbOption $pbOption)
    {
//        dd($pbOption->block);
        if ($this->newBlock) {
            $block = Block::create([
                'profile_id' => $this->profile->id,
            ]);
            BlockOption::create([
                'block_id'   => $block->id,
                'blockTitle' => $this->title,
            ]);
            BlockPbOption::create([
                'block_id'    => $block->id,
                'pbOption_id' => $pbOption->id,
                'title'       => $pbOption->title,
            ]);
            $this->mount($this->link);
        }
        else {
            BlockOption::create([
                'block_id'   => $this->block->id,
                'blockTitle' => $this->title,
            ]);
            BlockPbOption::create([
                'block_id'    => $this->block->id,
                'pbOption_id' => $pbOption->id,
                'title'       => $pbOption->title,
            ]);
        }
    }

    public function blockOptions(Block $block)
    {
//        dd($block->pbOption);
        $this->blockItemTitle         = null;
        $this->blockItemConnectionWay = null;
        $this->blockItemExtraText     = null;
        $this->title                  = null;
        $this->blockItems             = [];
        $this->title                  = $block->blockOption->blockTitle;
        $this->blockItems             = $block->pbOption;
//        dd($block->blockOption);
        $this->block                  = $block;
        $a                            = BlockPbOption::query()->where([/*'pbOption_id' => $pbOption->id,*/ 'block_id' => $this->block->id])->get();
//        dd($a,$this->blockItems);
        $this->blockItemTitle         = [];
        $this->blockItemConnectionWay = [];
        $this->blockItemExtraText     = [];
        foreach ($a as $item) {
            $this->blockItemTitle[$item->pbOption_id] = $item->title;
            $this->blockItemConnectionWay[$item->pbOption_id] = $item->connectionWay;
        }
//        dd($this->blockItemTitle,$this->blockItemConnectionWay);
    }

    public function getOptions($option, $newBlock)
    {
//        dd($this->block);
        if ($newBlock) {
            $this->newBlock = true;
        }
        else {
            $this->newBlock = false;
//            $this->block
        }

//        dd($options);
        $this->options = [];
        $this->option  = null;
        $this->option  = $option;

        if ($option == 'پیام رسان ها')
            $option = 'messenger';
        if ($option == 'شبکه های اجتماعی')
            $option = 'social';
        if ($option == 'تماس و راه های ارتباطی')
            $option = 'call';

        $this->options = pbOption::query()->where('for', $option)->get();

        $this->title = $option;

        if ($this->title == 'messenger')
            $this->title = 'پیام رسان ها';
        if ($this->title == 'social')
            $this->title = 'شبکه های اجتماعی';
        if ($this->title == 'call')
            $this->title = 'تماس و راه های ارتباطی';
    }

    public function getBlockTitle($blockPbOption)
    {
        $a = BlockPbOption::query()->where(['pbOption_id' => $blockPbOption->pbOption_id, 'block_id' => $blockPbOption->block_id])->first();
        return $a->title;
    }

    /*
        public function addNewItem()
        {

        }*/

    public function cancelPbOption()
    {

    }

    public function submitPbOption()
    {
        $a = BlockPbOption::query()->where([/*'pbOption_id' => $pbOption->id,*/ 'block_id' => $this->block->id])->get();

//        dd($this->blockItemTitle);
        foreach ($a as $item) {
            $key = key($this->blockItemTitle);
            $aa  = $item->where('pbOption_id', $key)->first();

            if ($aa) {
                $aa->update([
                    'title'         => $this->blockItemTitle[$key],
                    'connectionWay' => $this->blockItemConnectionWay[$key],
                ]);
                unset($this->blockItemTitle[$key], $this->blockItemConnectionWay[$key]);
            }
        }

        $this->blockOptions($this->block);
    }


    public function render()
    {
        return view('livewire.front.pagebuilder.pagebuilder')->layout('components.layouts.pageBuilder.app');
    }
}
