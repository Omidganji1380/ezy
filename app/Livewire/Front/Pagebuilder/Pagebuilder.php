<?php

namespace App\Livewire\Front\Pagebuilder;

use App\Events\UpdateShowPbPage;
use App\Http\Controllers\pageBuilder\PageBuilderTrait;
use App\Models\Block;
use App\Models\blockBanner;
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
    use WithFileUploads;
    use PageBuilderTrait;


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
//        dd($this->blocks);
    }

    public function setBlockWidth($width)
    {
        return $this->setBlockWidthTrait($width);
    }

    public function setBlockWidthHalf($width, $loopLast, $loopIndex)
    {
        return $this->setBlockWidthHalfTrait($width, $loopLast, $loopIndex);
    }

    public function getBlockItemIcon($icon, $blockItemColor)
    {
        return $this->getBlockItemIconTrait($icon, $blockItemColor);
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

    public function blockBannerOptions(Block $block/*,$newBlock*/)
    {
        $this->blockBannerOptionsTrait($block);
    }

    public function deleteBlock()
    {
        $this->deleteBlockTrait();
    }

    public function deleteBlockItem(BlockPbOption $blockPbOption)
    {
        $this->deleteBlockItemTrait($blockPbOption);
    }

    public function deleteBlockBannerItem(blockBanner $blockBanner)
    {
        $this->deleteBlockBannerItemTrait($blockBanner);
    }

    public function getOptions($option, $newBlock)
    {
        $this->getOptionsTrait($option, $newBlock);
    }

    public function getOptionsBanner($option, $newBlock)
    {
        $this->getOptionsBannerTrait($option, $newBlock);
    }

    public function insertBanner()
    {
        $this->insertBannerTrait();
    }

    public function updateSort($a)
    {
        $str = $a;
        preg_match_all('!\d+!', $str, $matches);
        $matches = $matches[0];
        for ($i = 0; $i < count($this->blocks); $i++) {
            $this->blocks->find($matches[$i])->update([
                'sort' => $i
            ]);
        }
        $this->redirect(route('pagebuilder.pagebuilder', $this->link));
    }

    public function removeBannerImg(blockBanner $blockBanner)
    {
        Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/banners/banner-' . $blockBanner->id . '/' . $blockBanner->image);
        $blockBanner->update([
            'image' => null
        ]);
        $this->blockBannerOptionsTrait($this->block);
//        $blockBanner->delete();
//        $this->mount($this->link);
    }

    public function getBlockTitle($blockPbOption)
    {
        return $this->getBlockTitleTrait($blockPbOption);
    }

    public function getBlockItemsBorder(Block $block)
    {
        return $this->getBlockItemsBorderTrait($block);
    }

    public function getBgBlockItemColor(Block $block, $originalColor = null)
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

    public function submitBanner()
    {
        $this->submitBannerTrait();
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
