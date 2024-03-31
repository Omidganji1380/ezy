<?php

namespace App\Http\Controllers\api\v1\traits;

use App\Models\BlockPbOption;

trait pageBuilder
{
    public function getBlockLink($link)
    {
        $link = BlockPbOption::query()->where(['pbOption_id' => $link['pbOption_id'], 'block_id' => $link['block_id'], 'id' => $link['id']])->first();
        return $link->connectionWay;
    }

    public function setBlockWidthHalf($width, $loopLast, $loopIndex)
    {
        if ($width == 'half' && $loopLast % 2 != 0 && $loopIndex % 2 == 0) {
            return 'col-12';
        }
    }

    public function setBlockWidth($width)
    {
        if ($width == 'full') {
            return 'col-12';
        }
        elseif ($width == 'half') {
            return 'col-6 w-half-block';
        }
        elseif ($width == 'compress') {
            return 'col-auto';
        }
    }

    public function getBlockTitle($blockPbOption)
    {
//        dd($blockPbOption);
        $a = BlockPbOption::query()->where(['pbOption_id' => $blockPbOption->pbOption_id, 'id' => $blockPbOption->id, 'block_id' => $blockPbOption->block_id])->first();
//        dd($a);
        return $a->title;
    }
}
