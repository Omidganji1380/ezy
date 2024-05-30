<?php

namespace App\Http\Controllers\pageBuilder;

use App\Models\Block;
use App\Models\BlockOption;
use App\Models\MenuBlock;
use Storage;

trait Menu
{
    public $blockMenuItems  = [];
    public $MenuTitle       = [];
    public $MenuPrice       = [];
    public $MenuDescription = [];
    public $menuImageUpload;
    public $sort;

    public function removeMenuImg() {
        Storage::disk('public')
               ->delete('pb/profiles/profile-' . $this->profile->id . '/menus/' . $this->blockMenuItems[0]->img);
        foreach ($this->blockMenuItems as $item) {
            $item->update([
                              'img' => null,
                          ]);
        }
        $this->blockMenuOptions($this->block);
    }

    public function getOptionsMenu($option, $newBlock) {
        if ($newBlock) {
            $this->newBlock = true;
        }
        else {
            $this->newBlock = false;
        }

        $this->options = [];
        $this->option  = $option;

        if ($option == 'منو' || $option == 'menu') {
            $this->title  = 'منو';
            $this->option = 'menu';
        }
        $this->insertMenu();

        $this->options = MenuBlock::query()
                                  ->where('block_id', $this->block->id)
                                  ->get();
    }

    public function insertMenu() {
        if ($this->newBlock) {
            $lastSort = $this->blocks->last() ? $this->blocks->last()->sort + 1 : 0;
            $block    = Block::create([
                                          'profile_id' => $this->profile->id,
                                          'sort'       => $lastSort,
                                      ]);
            BlockOption::create([
                                    'block_id'   => $block->id,
                                    'blockTitle' => $this->title,
                                    'option5'    => $this->title,
                                ]);
            MenuBlock::create([
                                  'block_id' => $block->id,
                              ]);
            $this->blockMenuOptions($block);
        }
        else {
            BlockOption::create([
                                    'block_id'   => $this->block->id,
                                    'blockTitle' => $this->title,
                                    'option5'    => $this->title,
                                ]);
            MenuBlock::create([
                                  'block_id' => $this->block->id,
                              ]);
            $this->blockMenuOptions($this->block);
        }
        //        $this->refreshPage();
        $this->mount($this->link);
    }

    public function blockMenuOptions(Block $block/*,$newBlock*/) {
        $this->clearInputsTrait();
        $this->blockMenuItems  = [];
        $this->MenuTitle       = [];
        $this->MenuPrice       = [];
        $this->MenuDescription = [];

        $this->block = $block;
        $this->title = $block->blockOption->option5;

        $this->blockMenuItems = MenuBlock::query()
                                         ->where(['block_id' => $this->block->id])
                                         ->orderBy('sort')
                                         ->get();

        foreach ($this->blockMenuItems as $item) {

            $this->MenuTitle[$item->id]       = $item->title;
            $this->MenuPrice[$item->id]       = $item->price;
            $this->MenuDescription[$item->id] = $item->description;
        }


        $this->getBlockMoreOptions($block);

    }

    public function deleteBlockMenuItem(MenuBlock $MenuBlock) {
        if (count($MenuBlock->block->Menu) == 1) {
            Storage::disk('public')
                   ->delete('pb/profiles/profile-' . $this->profile->id . '/menus/' . $this->blockMenuItems[0]->img);
            $MenuBlock->block->delete();
            $this->mount($this->link);
        }
        $MenuBlock->delete();
        $this->mount($this->link);
        if (count($MenuBlock->block->Menu) != 1) {
            $this->blockMenuOptions($this->block);
        }
    }

    /*
        public function removeMenuImg(MenuBlock $MenuBlock)
        {
            Storage::disk('public')->delete('pb/profiles/profile-' . $this->profile->id . '/Menus/Menu-' . $MenuBlock->id . '/' . $MenuBlock->img);
            $MenuBlock->update([
                'img' => null
            ]);
            $this->blockFailOptions($this->block);
        }*/

    public function submitMenu() {
        if ($this->menuImageUpload) {
            Storage::disk('public')
                   ->delete('pb/profiles/profile-' . $this->profile->id . '/menus/' . $this->blockMenuItems[0]->img);
            $filename     = $this->menuImageUpload->getFilename();
            $originalName = time() . '_' . $this->menuImageUpload->getClientOriginalName();
            $this->menuImageUpload->storeAs('pb/profiles/profile-' . $this->profile->id . '/menus/', $originalName, 'public');
            Storage::disk('local')
                   ->delete('livewire-tmp/' . $filename);
        }
        preg_match_all('!\d+!', $this->sort, $sort);
        $sort = $sort[0];
//                dd($this->sort,$sort);
//dd($this->sort,$sort,array_search('666',$sort));
        foreach ($this->blockMenuItems as $key=>$item) {
            $item->update([
                              'title'       => $this->MenuTitle[$item->id],
                              'description' => $this->MenuDescription[$item->id],
                              'price'       => $this->MenuPrice[$item->id],
                              'sort'        => in_array($item->id,$sort)?array_search($item->id,$sort):00,
                          ]);

            if ($this->menuImageUpload) {
                $item->update([
                                  'img' => $originalName,
                              ]);
            }
        }
        $this->menuImageUpload = null;

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
        $this->blockMenuItems  = [];
        $this->MenuTitle       = [];
        $this->MenuDescription = [];
        $this->MenuPrice       = [];
        $this->mount($this->link);
    }

    function menuDotted($string) {
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", ".", $string);
        return $string;
    }
}
