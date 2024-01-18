<?php

namespace App\Livewire\Front\Pagebuilder;

use App\Models\Block;
use App\Models\BlockPbOption;
use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public $profile;
    public $blocks;
    public function mount($link)
    {
        $this->profile=Profile::query()->where('link',$link)->first();
        if (!$this->profile){
            abort(404);
        }
        $this->blocks = $this->profile->block;
//        dd($this->profile);
    }
    public function getBlockItemsBorder(Block $block)
    {
        $border = $block->blockOption->blockBorder;
        if ($border == 0) {
            $border = '0 !important';
        }
        elseif ($border == 1) {
            $border = '0.25rem !important';
        }
        elseif ($border == 2) {
            $border = '10px !important';
        }
        elseif ($border == 3) {
            $border = '100px !important';
        }
        return $border;
    }
    public function getIconPaths()
    {
        for ($ii = 1; $ii <= 50; $ii++) {
            echo '<span class="path' . $ii . '"></span >';
        }
    }
    public function getBlockTitle($blockPbOption)
    {
//        dd($blockPbOption);
        $a = BlockPbOption::query()->where(['pbOption_id' => $blockPbOption->pbOption_id, 'id' => $blockPbOption->id, 'block_id' => $blockPbOption->block_id])->first();
//        dd($a);
        return $a->title;
    }
    public function render()
    {
        return view('livewire.front.pagebuilder.show')->layout('components.layouts.pageBuilder.app');
    }
}
