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

    public function insertBlock($pbOptionId)
    {
        $block = Block::create([
            'profile_id' => $this->profile->id,
        ]);
        BlockOption::create([
            'block_id'   => $block->id,
            'blockTitle' => $this->title,
        ]);
//        $block->pbOption()->sync([$block->id, $pbOptionId]);
        BlockPbOption::create([
            'block_id'    => $block->id,
            'pbOption_id' => $pbOptionId,
        ]);
//        dd($block->pbOption());
        $this->mount($this->link);
    }

    public function blockOptions(Block $block)
    {
        $this->title=$block->blockOption->blockTitle;
//        dd($block->with('blockOption')->first());
}
    public function getOptions($options)
    {
        $this->options = [];
        $this->option  = null;
        $this->option  = $options;
        $this->options = pbOption::query()->where('for', $options)->get();

        $this->title = $options;

        if ($this->title == 'messenger')
            $this->title = 'پیام رسان ها';
        if ($this->title == 'social')
            $this->title = 'شبکه های اجتماعی';
        if ($this->title == 'call')
            $this->title = 'تماس و راه های ارتباطی';
    }

    public function render()
    {
        return view('livewire.front.pagebuilder.pagebuilder')->layout('components.layouts.pageBuilder.app');
    }
}
