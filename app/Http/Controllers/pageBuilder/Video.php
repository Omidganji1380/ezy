<?php

namespace App\Http\Controllers\pageBuilder;

use App\Models\Block;
use App\Models\BlockOption;
use App\Models\BlockVideo;
use Storage;

trait Video
{
    public $blockVideo;
    public $videoLink;

    public function getOptionsVideo($option, $newBlock) {
        if ($newBlock) {
            $this->newBlock = true;
        }
        else {
            $this->newBlock = false;
        }

        $this->options = [];
        $this->option  = $option;

        if ($option == 'ویدئو' || $option == 'video') {
            $this->title  = 'ویدئو';
            $this->option = 'video';
        }
        $this->insertVideo();

        $this->options = BlockVideo::query()
                                   ->where('block_id', $this->block->id)
                                   ->first();
    }

    public function insertVideo() {
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
            BlockVideo::create([
                                   'block_id' => $block->id,
                               ]);
            $this->blockVideoOptions($block);
        }
        else {
            BlockOption::create([
                                    'block_id'   => $this->block->id,
                                    'blockTitle' => $this->title,
                                    'option5'    => $this->title,
                                ]);
            BlockVideo::create([
                                   'block_id' => $this->block->id,
                               ]);
            $this->blockVideoOptions($this->block);
        }
        $this->refreshPage();
    }

    public function blockVideoOptions(Block $block) {
        $this->clearInputsTrait();
        $this->videoLink = '';

        $this->block = $block;
        $this->title = $block->blockOption->option5;

        $this->blockVideo = BlockVideo::query()
                                      ->where(['block_id' => $this->block->id])
                                      ->first();

        $this->videoLink = $this->blockVideo->link;


        //        $this->getBlockMoreOptions($block);

    }

    public function submitVideo() {
        $this->blockVideo->update([
                                      'link' => $this->videoLink,
                                  ]);


        $this->clearVariables();
        $this->clearInputs();
        $this->mount($this->link);
    }
}
