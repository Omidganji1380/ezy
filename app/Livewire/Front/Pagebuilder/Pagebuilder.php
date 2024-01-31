<?php

namespace App\Livewire\Front\Pagebuilder;

use App\Events\UpdateShowPbPage;
use App\Http\Controllers\pageBuilder\PageBuilderTrait;
use App\Models\Block;
use App\Models\BlockOption;
use App\Models\BlockPbOption;
use App\Models\pbOption;
use App\Models\Profile;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Pagebuilder extends Component
{
    use WithFileUploads, PageBuilderTrait;


//    public $blockItems=[];
    public function submitProfileOptions()
    {
        $this->submitProfileOptionsTrait();
    }

    public function clearVariables()
    {
        $this->clearVariablesTrait();
    }

    public function mount($link)
    {
        $this->mountTrait($link);
    }

    public function setBlockWidth($width)
    {
        return $this->setBlockWidthTrait($width);
    }

    public function setBlockWidthHalf($width, $loopLast, $loopIndex)
    {
       return $this->setBlockWidthHalfTrait($width, $loopLast, $loopIndex);
    }

    public function previewPB()
    {
        $this->previewPBTrait();
    }

    public function getIconPaths()
    {
        $this->getIconPathsTrait();
    }

    public function insertBlock(pbOption $pbOption)
    {
        $this->insertBlockTrait($pbOption);
    }

    public function getProfileOptions()
    {
        $this->getProfileOptionsTrait();
    }

    public function clearInputs()
    {
        $this->clearInputsTrait();
    }

    public function getBlockMoreOptions(Block $block)
    {
        $this->getBlockMoreOptionsTrait($block);
    }

    public function blockOptions(Block $block/*,$newBlock*/)
    {
        $this->blockOptionsTrait($block);
    }

    public function deleteBlock()
    {
        $this->deleteBlockTrait();
    }

    public function deleteBlockItem(BlockPbOption $blockPbOption)
    {
        $this->deleteBlockItemTrait($blockPbOption);
    }

    public function getOptions($option, $newBlock)
    {
        $this->getOptionsTrait($option, $newBlock);
    }

    public function getBlockTitle($blockPbOption)
    {
        return $this->getBlockTitleTrait($blockPbOption);
    }

    public function getBlockItemsBorder(Block $block)
    {
        return $this->getBlockItemsBorderTrait($block);
    }

    public function getBgBlockItemColor(Block $block, $originalColor)
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

    public function submitPbOption()
    {
        $this->submitPbOptionTrait();
    }

    public function removeImg()
    {
        $this->removeImgTrait();
    }

    public function removeBgImg()
    {
        $this->removeBgImgTrait();
    }

    public function render()
    {
        return view('livewire.front.pagebuilder.pagebuilder')->layout('components.layouts.pageBuilder.app');
    }
}
