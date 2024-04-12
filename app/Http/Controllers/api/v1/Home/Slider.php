<?php

namespace App\Http\Controllers\api\v1\Home;

use App\Models\Slider as SL;

class Slider
{
    public function getSliders()
    {
        $sliders = SL::query()->whereStatus(1)->get();
        $imgs    = [];
        foreach ($sliders as $slider) {
            $i      = asset('storage/sliders/slide-' . $slider->id . '/' . $slider->img);
            $imgs[] = $i;
        }
        return response($imgs);
    }
}
