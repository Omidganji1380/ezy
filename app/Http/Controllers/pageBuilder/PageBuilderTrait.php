<?php

namespace App\Http\Controllers\pageBuilder;

use App\Livewire\Front\Pagebuilder\Show;
use App\Models\Block;
use App\Models\blockBanner;
use App\Models\BlockOption;
use App\Models\BlockPbOption;
use App\Models\pbOption;
use App\Models\Profile;
use Auth;
use Livewire\WithFileUploads;
use Storage;

trait PageBuilderTrait
{
    use WithFileUploads;

    public $options      = [];
    public $constOptions = [];
    public $option;

    public $title;
    public $profile;
    public $link;
    public $blocks;
    public $blockItems        = [];
    public $blockBannerItems  = [];
    public $bannerImage;
    public $bannerLink;
    public $bannerTitle;
    public $bannerDescription;
    public $bannerButton;
    public $bannerImageUpload = [];

    public $block;
    public $blockTitle;
    public $blockItemColor;
    public $bgBlockItemColor;
    public $textBlockItemColor;
    public $borderBlockItemColor;
    public $blockItemsWidth;
    public $blockItemsBorder;
    public $blockVisibility;
    public $blockItemTitle;
    public $blockItemConnectionWay;
    public $blockItemExtraText;
    public $newBlock = true;

    public $profileTitle;
    public $profileSubtitle;
    public $profileImg;
    public $profileBgImg;
    public $profileBgBorder;
    public $profileImgBorder;

//    public $blockItems=[];
    public function setBlockWidthTrait($width)
    {
        if ($width == 'full') {
            return 'col-12';
        }
        elseif ($width == 'half') {
            return 'col-6';
        }
        elseif ($width == 'compress') {
            return 'col-auto';
        }
    }

    public function getBlockItemIconTrait($icon, $blockItemColor)
    {
        if ($blockItemColor == 2) {
            return $icon;
        }
        else {
            return $icon . '-solid';
        }
    }

    public function setBlockWidthHalfTrait($width, $loopLast, $loopIndex)
    {
        if ($width == 'half' && $loopLast % 2 != 0 && $loopIndex % 2 == 0) {
            return 'col-12';
        }
    }

    public function submitProfileOptionsTrait()
    {
        if ($this->profileImg) {
            Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->img);
            $filename     = time() . '_' . $this->profileImg->getFilename();
            $originalName = time() . '_' . $this->profileImg->getClientOriginalName();
            $this->profileImg->storeAs('pb/profiles/profile-' . $this->profile->id, $originalName, 'public');
            Storage::disk('local')->delete('livewire-tmp/' . $filename);
            $this->profileImg = null;
            $this->profile->update([
                'img' => $originalName,
            ]);
        }
        if ($this->profileBgImg) {
            Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->bg_img);
            $filename     = time() . '_' . $this->profileBgImg->getFilename();
            $originalName = time() . '_' . $this->profileBgImg->getClientOriginalName();
            $this->profileBgImg->storeAs('pb/profiles/profile-' . $this->profile->id, $originalName, 'public');
            Storage::disk('local')->delete('livewire-tmp/' . $filename);
            $this->profileBgImg = null;
            $this->profile->update([
                'bg_img' => $originalName,
            ]);
        }
        $this->profile->update([
            'title'      => $this->profileTitle,
            'subtitle'   => $this->profileSubtitle,
            'img_border' => $this->profileImgBorder,
            'bg_border'  => $this->profileBgBorder,
        ]);
        $this->clearInputs();
        $this->mount($this->link);
    }

    public function clearVariablesTrait()
    {
        $this->block    = null;
        $this->newBlock = true;
    }

    public function previewPBTrait()
    {
        $this->dispatch('previewPB', link: $this->link)->to(Show::class);
    }

//    public function sendEventTrait(): void
//    {
//        $a = new UpdateShowPbPage($this->link);
//        event($a);
//    }
    public function mountTrait($link)
    {
        $this->link    = $link;
        $this->profile = Profile::query()->with('block')->where(['link'=> $link,'user_id' => Auth::id()])->first();
        if (!$this->profile) {
            abort(404);
        }
        $this->blocks = $this->profile->block()->get()->sortBy('sort');
//dd($this->blocks->find(105));
//        $this->getOptions($this->title, false);
        $this->constOptions = pbOption::query()->where('for', 'social')->get();
    }

    public function getIconPathsTrait()
    {
        for ($ii = 1; $ii <= 50; $ii++) {
            echo '<span class="path' . $ii . '"></span >';
        }
    }

    public function insertBlockTrait(pbOption $pbOption)
    {
//        dd($pbOption->block);
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
            BlockPbOption::create([
                'block_id'    => $block->id,
                'pbOption_id' => $pbOption->id,
                'title'       => $pbOption->title,
            ]);
            $this->blockOptions($block);
        }
        else {
            BlockOption::create([
                'block_id'   => $this->block->id,
                'blockTitle' => $this->title,
                'option5'    => $this->title,
            ]);
            BlockPbOption::create([
                'block_id'    => $this->block->id,
                'pbOption_id' => $pbOption->id,
                'title'       => $pbOption->title,
            ]);
            $this->blockOptions($this->block);
        }
        $this->refreshPage();
    }

    public function insertBannerTrait()
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
            blockBanner::create([
                'block_id' => $block->id,
            ]);
            $this->blockBannerOptions($block);
        }
        else {
            BlockOption::create([
                'block_id'   => $this->block->id,
                'blockTitle' => $this->title,
                'option5'    => $this->title,
            ]);
            blockBanner::create([
                'block_id' => $this->block->id,
            ]);
            $this->blockBannerOptions($this->block);
        }
        $this->refreshPage();
    }

    public function refreshPage()
    {
//        $this->mountTrait($this->link);
        $this->redirect(route('pagebuilder.pagebuilder', $this->link));

    }

    public function getProfileOptionsTrait()
    {
        $this->clearInputs();
        $this->profileTitle     = $this->profile->title;
        $this->profileSubtitle  = $this->profile->subtitle;
        $this->profileImg       = $this->profile->profileImg;
        $this->profileBgImg     = $this->profile->profileBgImg;
        $this->profileBgBorder  = $this->profile->bg_border;
        $this->profileImgBorder = $this->profile->img_border;
//        dd($this->profileBgBorder);
    }

    public function clearInputsTrait()
    {
        $this->profileTitle           = null;
        $this->profileSubtitle        = null;
        $this->profileImg             = null;
        $this->profileBgImg           = null;
        $this->block                  = null;
        $this->blockItemTitle         = null;
        $this->blockItemConnectionWay = null;
        $this->blockItemExtraText     = null;
        $this->title                  = null;
        $this->blockItems             = [];
        $this->blockItemTitle         = [];
        $this->blockItemConnectionWay = [];
        $this->blockItemExtraText     = [];
        $this->blockBannerItems       = [];
        $this->bannerTitle            = [];
        $this->bannerDescription      = [];
        $this->bannerButton           = [];
        $this->bannerImage            = [];
        $this->bannerLink             = [];
    }

    public function getBlockMoreOptionsTrait(Block $block)
    {
        $blockMoreOptions           = $block->blockOption;
        $this->blockVisibility      = $blockMoreOptions->blockVisibility == 1 ? true : false;
        $this->blockTitle           = $blockMoreOptions->blockTitle;
        $this->blockItemsWidth      = $blockMoreOptions->blockWidth;
        $this->blockItemsBorder     = $blockMoreOptions->blockBorder;
        $this->blockItemColor       = $blockMoreOptions->blockItemColor;
        $this->bgBlockItemColor     = $blockMoreOptions->bgBlockItemColor;
        $this->textBlockItemColor   = $blockMoreOptions->textBlockItemColor;
        $this->borderBlockItemColor = $blockMoreOptions->borderBlockItemColor;
    }

    public function getOptionsBannerTrait($option, $newBlock)
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

        if ($option == 'بنر' || $option == 'banner') {
            $this->title  = 'بنر';
            $this->option = 'banner';
        }
        $this->insertBanner();

        $this->options = blockBanner::query()->where('block_id', $this->block->id)->get();
    }

    public function blockBannerOptionsTrait(Block $block/*,$newBlock*/)
    {
        $this->clearInputsTrait();
        $this->block = $block;
        $this->title = $block->blockOption->option5;
//        dd($this->option);
        $this->blockBannerItems = blockBanner::query()->where([/*'pbOption_id' => $pbOption->id,*/ 'block_id' => $this->block->id])->get();
//            dd($this->blockBannerItems);
        foreach ($this->blockBannerItems as $item) {
//            dd($item);
            $this->bannerTitle[$item->id]       = $item->title;
            $this->bannerDescription[$item->id] = $item->description;
            $this->bannerButton[$item->id]      = $item->button;
            $this->bannerImage[$item->id]       = $item->image;
            $this->bannerLink[$item->id]        = $item->link;
        }
//        dd($this->bannerImageUpload);

        $this->getBlockMoreOptions($block);
//        dd($this->bannerImage);
    }

    public function blockOptionsTrait(Block $block/*,$newBlock*/)
    {
//        $this->newBlock = $newBlock;
//        if ($this->newBlock)
//            $this->clearInputs();

        $this->block = $block;
        $this->title = $block->blockOption->option5;
//        dd($block->blockOption);
        $this->blockItems = BlockPbOption::query()->where([/*'pbOption_id' => $pbOption->id,*/ 'block_id' => $this->block->id])->get();
//        dd($this->blockItemTitle);
//        dd($block->pbOption);
        foreach ($this->blockItems as $item) {
            $this->blockItemTitle[$item->id]         = $item->title;
            $this->blockItemConnectionWay[$item->id] = $item->connectionWay;
        }
        $this->getBlockMoreOptions($block);
//        dd($this->blockItemTitle,$this->blockItemConnectionWay);
    }

    public function deleteBlockTrait()
    {
        foreach ($this->block->banner as $item) {
            Storage::disk('public')->deleteDirectory('pb/profiles/profile-' . $this->profile->id . '/banners/banner-'.$item->id);
        }
        foreach ($this->block->fair as $item) {
            Storage::disk('public')->deleteDirectory('pb/profiles/profile-' . $this->profile->id . '/fairs/fair-'.$item->id);
        }
        $this->block->delete();
        $this->refreshPage();
    }

    public function deleteBlockItemTrait(BlockPbOption $blockPbOption)
    {
//        dd($blockPbOption->block->pbOption);
        if (count($blockPbOption->block->pbOption) == 1) {
            $blockPbOption->block->delete();
            $this->refreshPage();
        }
        $blockPbOption->delete();
        $this->mount($this->link);
        if (count($blockPbOption->block->pbOption) != 1) {
            $this->blockOptions($this->block);
        }
    }

    public function deleteBlockBannerItemTrait(blockBanner $blockBanner)
    {
//        dd(count($blockBanner->block->banner));
        Storage::disk('public')->deleteDirectory('pb/profiles/profile-' . $this->profile->id . '/banners/banner-' . $blockBanner->id);
        if (count($blockBanner->block->banner) == 1) {
            $blockBanner->block->delete();
            $this->refreshPage();
        }
        $blockBanner->delete();
        $this->mount($this->link);
        if (count($blockBanner->block->banner) != 1) {
            $this->blockBannerOptionsTrait($this->block);
        }
    }

    public function getOptionsTrait($option, $newBlock)
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
//dd($option);

        if ($option == 'پیام رسان ها' || $option == 'messenger') {
            $this->title = 'پیام رسان ها';
            $option      = 'messenger';
        }
        elseif ($option == 'شبکه های اجتماعی' || $option == 'social') {
            $this->title = 'شبکه های اجتماعی';
            $option      = 'social';
        }
        elseif ($option == 'تماس و راه های ارتباطی' || $option == 'call') {
            $this->title = 'تماس و راه های ارتباطی';
            $option      = 'call';
        }
        elseif ($option == 'لینک و سوپر لینک' || $option == 'link') {
            $this->title = 'لینک و سوپر لینک';
            $option      = 'link';
        }
//        $this->title = $option;
//        if ($option == 'messenger')
//            $this->title = 'پیام رسان ها';
//        if ($option == 'social')
//            $this->title = 'شبکه های اجتماعی';
//        if ($option == 'link')
//            $this->title = 'لینک و سوپر لینک';
        $this->options = pbOption::query()->where('for', $option)->get();


    }

    public function getBlockTitleTrait($blockPbOption)
    {
//        dd($blockPbOption);
        $a = BlockPbOption::query()->where(['pbOption_id' => $blockPbOption->pbOption_id, 'id' => $blockPbOption->id, 'block_id' => $blockPbOption->block_id])->first();
//        dd($a);
        return $a->title;
    }

    public function getBlockItemsBorderTrait(Block $block)
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

    public function getBgBlockItemColorTrait(Block $block, $originalColor = null)
    {
        $blockItemColor   = $block->blockOption->blockItemColor;
        $bgBlockItemColor = $block->blockOption->bgBlockItemColor;

        if ($blockItemColor == 3 || $blockItemColor == 1) {
            return $bgBlockItemColor;
        }
        else {
            return $originalColor;
        }
    }

    public function getTextBlockItemColorTrait(Block $block, $originalColor = null)
    {
        $blockItemColor     = $block->blockOption->blockItemColor;
        $textBlockItemColor = $block->blockOption->textBlockItemColor;

        if ($blockItemColor == 3 || $blockItemColor == 1) {
            return $textBlockItemColor;
        }
        else {
            return $originalColor;
        }
    }

    public function getBorderBlockItemColorTrait(Block $block, $originalColor = null)
    {
        $blockItemColor       = $block->blockOption->blockItemColor;
        $borderBlockItemColor = $block->blockOption->borderBlockItemColor;

        if ($blockItemColor == 3 || $blockItemColor == 1) {
            return $borderBlockItemColor;
        }
        else {
            return $originalColor;
        }
    }

    public function submitPbOptionTrait()
    {
        foreach ($this->blockItems as $item) {
            $item->update([
                'title'         => $this->blockItemTitle[$item->id],
                'connectionWay' => $this->blockItemConnectionWay[$item->id],
            ]);
        }

//        dd($this->blockVisibility);
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
        $this->refreshPage();
    }

    public function submitBannerTrait()
    {
//        dd($this->bannerImageUpload);
        foreach ($this->blockBannerItems as $item) {
            $item->update([
                'title'       => $this->bannerTitle[$item->id],
                'description' => $this->bannerDescription[$item->id],
                'button'      => $this->bannerButton[$item->id],
                'link'        => $this->bannerLink[$item->id],
            ]);
//            dd(isset($this->bannerImageUpload[105]));
            if (isset($this->bannerImageUpload[$item->id])) {
                Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/banners/banner-' . $item->id . '/' . $item->image);
                $filename     = $this->bannerImageUpload[$item->id]->getFilename();
                $originalName = time() . '_' . $this->bannerImageUpload[$item->id]->getClientOriginalName();
                $this->bannerImageUpload[$item->id]->storeAs('pb/profiles/profile-' . $this->profile->id . '/banners/banner-' . $item->id, $originalName, 'public');
                Storage::disk('local')->delete('livewire-tmp/' . $filename);
                $this->bannerImageUpload[$item->id] = null;
                $item->update([
                    'image' => $originalName,
                ]);
            }
        }

//        dd($this->blockVisibility);
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
        $this->refreshPage();
    }

    public function removeImgTrait()
    {
        if ($this->profile->img) {
            Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->img);
            $this->profile->update([
                'img' => null,
            ]);
//            $this->mount($this->link);
        }

    }

    public function removeBgImgTrait()
    {
        if ($this->profile->bg_img) {
            Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/' . $this->profile->bg_img);
            $this->profile->update([
                'bg_img' => null,
            ]);
//            $this->mount($this->link);
        }

    }

}
