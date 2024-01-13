<?php

namespace App\Livewire\Front\Pagebuilder;

use App\Models\Block;
use App\Models\BlockOption;
use App\Models\BlockPbOption;
use App\Models\pbOption;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Pagebuilder extends Component
{
    use WithFileUploads;

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

    public $profileTitle;
    public $profileSubtitle;
    public $profileImg;
    public $profileBgImg;
    public $profileBgBorder;
    public $profileImgBorder;

//    public $blockItems=[];
    public function submitProfileOptions()
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

    public function clearVariables()
    {
        $this->block    = null;
        $this->newBlock = true;
    }

    public function mount($link)
    {
        $this->link    = $link;
        $this->profile = Profile::query()->with('block')->where('link', $link)->first();
//        dd($this->profile);
        if (!$this->profile) {
            abort(404);
        }
//        dd($this->profile->block[0]->blockOption->blockTitle);
        $this->blocks = $this->profile->block/*->with(['blockOption','pbOption'])*/
        ;
//        dd($this->blocks->first()->pbOption);
    }

    public function getIconPaths()
    {
        for ($ii = 1; $ii <= 50; $ii++) {
            echo '<span class="path' . $ii . '"></span >';
        }
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
            $this->blockOptions($block);
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
            $this->blockOptions($this->block);
        }
        $this->mount($this->link);
    }

    public function getProfileOptions()
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

    public function clearInputs()
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
    }

    public function blockOptions(Block $block)
    {
        $this->clearInputs();

        $this->block      = $block;
        $this->title      = $block->blockOption->blockTitle;
        $this->blockItems = BlockPbOption::query()->where([/*'pbOption_id' => $pbOption->id,*/ 'block_id' => $this->block->id])->get();
//        dd($block->pbOption);
        foreach ($this->blockItems as $item) {
            $this->blockItemTitle[$item->id]         = $item->title;
            $this->blockItemConnectionWay[$item->id] = $item->connectionWay;
        }
//        dd($this->blockItemTitle,$this->blockItemConnectionWay);
    }

    public function getOptions($option, $newBlock)
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
//        dd($blockPbOption);
        $a = BlockPbOption::query()->where(['pbOption_id' => $blockPbOption->pbOption_id, 'id' => $blockPbOption->id, 'block_id' => $blockPbOption->block_id])->first();
//        dd($a);
        return $a->title;
    }

    public function submitPbOption()
    {
        foreach ($this->blockItems as $item) {
            $item->update([
                'title'         => $this->blockItemTitle[$item->id],
                'connectionWay' => $this->blockItemConnectionWay[$item->id],
            ]);
        }
        $this->blockOptions($this->block);
    }


    public function render()
    {
        return view('livewire.front.pagebuilder.pagebuilder')->layout('components.layouts.pageBuilder.app');
    }
}
