<?php

namespace App\Http\Controllers\pageBuilder;

use App\Models\ProfileBackgroundImage;
use App\Models\ProfileFont;
use App\Models\ProfileOption;
use App\Models\ProfileTheme;

trait profileGlobalOptions
{
    public $fonts;
    public $backgroundImages;
    public $themes;
    public $bgImgSelected;

    public function globalOptionsMount()
    {
        $this->fonts            = ProfileFont::query()->get();
        $this->backgroundImages = ProfileBackgroundImage::query()->get();
        $this->themes           = ProfileTheme::query()->get();
    }

    public function submitProfileGlobalOptions()
    {
        $ProfileGlobalOptions = ProfileOption::query()->where('profile_id', $this->profile->id)->first();
        if ($ProfileGlobalOptions) {
            $ProfileGlobalOptions->update([
                'background_image_id' => $this->bgImgSelected,
                'theme_id'            => null,
                'background_color'    => null
            ]);
        }
        else {
            ProfileOption::query()->create([
                'profile_id'          => $this->profile->id,
                'background_image_id' => $this->bgImgSelected,
                'theme_id'            => null,
                'background_color'    => null
            ]);
        }
        $this->refreshPage();
    }

    public function getSelectedBgImg(/*ProfileOption */ $profileOption)
    {
        $ProfileGlobalOptions = ProfileOption::query()
            ->where(['profile_id' => $this->profile->id, 'background_image_id' => $profileOption])
            ->first();
        if ($ProfileGlobalOptions) {
            return 'bgImgSelected';
        }
    }

    public function getBackgroundImage()
    {
        $ProfileGlobalOptions = ProfileOption::query()
            ->where('profile_id', $this->profile->id)
            ->first();
        if ($ProfileGlobalOptions&&$ProfileGlobalOptions->background_image_id) {
            return 'background-image: url('.asset('storage/pb/bgImages/bgImage-'.$ProfileGlobalOptions->background_image_id.'/'.$ProfileGlobalOptions->backgroundImage->img).') !important;
                    background-position: center center !important;
                    background-size: cover !important;
                    background-repeat: no-repeat !important;
                    height:100vh;
                    ';
        }
    }
}
