<?php

namespace App\Livewire\Front\Pagebuilder;

use App\Http\Controllers\pageBuilder\PageBuilderTrait;
use App\Models\Block;
use App\Models\BlockPbOption;
use App\Models\Profile;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    use PageBuilderTrait;

    public $profile;
    public $blocks;

    #[On('previewPB')]
    public function mount($link)
    {
        $this->profile = Profile::query()->where('link', $link)->first();
        if (!$this->profile) {
            abort(404);
        }
        $this->blocks = $this->profile->block;
    }

    public function getBlockItemsBorder(Block $block)
    {
       return $this->getBlockItemsBorderTrait($block);
    }
    public function setBlockWidthHalf($width, $loopLast, $loopIndex)
    {
        return $this->setBlockWidthHalfTrait($width, $loopLast, $loopIndex);
    }

    public function setBlockWidth($width)
    {
        return $this->setBlockWidthTrait($width);
    }

    public function getBlockItemIcon($icon, $blockItemColor)
    {
        return $this->getBlockItemIconTrait($icon, $blockItemColor);
    }
    public function getBgBlockItemColor(Block $block, $originalColor=null)
    {
       return $this->getBgBlockItemColorTrait($block, $originalColor);
    }

    public function getTextBlockItemColor(Block $block, $originalColor = null)
    {
        return $this->getTextBlockItemColorTrait($block, $originalColor);
    }

    public function getBorderBlockItemColor(Block $block, $originalColor = null)
    {
        return $this->getBorderBlockItemColorTrait($block, $originalColor);
    }

    public function getIconPaths()
    {
        $this->getIconPathsTrait();
    }

    public function getBlockTitle($blockPbOption)
    {
       return $this->getBlockTitleTrait($blockPbOption);
    }

    public function getBlockLink($link)
    {
//        dd($link);
        $link = BlockPbOption::query()->where(['pbOption_id' => $link['pbOption_id'], 'block_id' => $link['block_id'], 'id' => $link['id']])->first();
//        dd($link);
        return $link->connectionWay;
    }

    public function render()
    {
        return view('livewire.front.pagebuilder.show')->layout('components.layouts.pageBuilder.app');
    }
}
