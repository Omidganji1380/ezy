<?php

namespace App\Livewire\Admin;

use App\Models\About;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class AboutUs extends Component
{
    use WithFileUploads;

    public $topTitle;
    public $infoTopTitle;
    public $resume;
    public $resumeButton;
    public $infoTitle;
    public $infoLocation;
    public $infoText;
    public $infoImg;
    public $videoTitle;
    public $videoImg;
    public $videoLink;

    public $midTopTitle;
    public $midTitle;
    public $midSubtitle;
    public $midDesc;
    public $midImg;

    public $skillTopTitle;
    public $skillTitle;
    public $skillPercentage;

    public $bottomTopTitle;
    public $bottomTitle;
    public $bottomSubtitle;
    public $bottomText;
    public $teams;
    public $firstRecord;
    public $team;
    public $skill;
    public $skills;
    public $bottom;
    public $bottoms;

    public $infoImage;
    public $videoImage;
    public $teamImage;

    public function mount()
    {
        $this->firstRecord = About::query()->first();
        if (!$this->firstRecord) {
            $this->firstRecord = About::query()->create();
        }
        $this->teams   = About::query()->where('id', '>', $this->firstRecord->id)->whereNull(['skillPercentage','bottomTitle'])->get();
        $this->skills  = About::query()->where('id', '>', $this->firstRecord->id)->whereNotNull('skillPercentage')->get();
        $this->bottoms = About::query()->where('id', '>', $this->firstRecord->id)->whereNotNull('bottomTitle')->whereNull(['skillPercentage', 'infoTitle', 'infoImg', 'infoLocation', 'skillTitle'])->get();
        $this->fetchData();
    }

    public function updated()
    {
        if ($this->infoImage) {
            Storage::disk('public')->delete('about/infoImg/' . $this->firstRecord->infoImg);
            $filename     = $this->infoImage->getFilename();
            $originalName = $this->infoImage->getClientOriginalName();
            $this->infoImage->storeAs('about/infoImg', $originalName, 'public');
            $this->firstRecord->update([
                'infoImg' => $originalName,
            ]);
            Storage::disk('local')->delete('livewire-tmp/' . $filename);
            $this->infoImage = '';
        }
        if ($this->videoImage) {
            Storage::disk('public')->delete('about/videoImg/' . $this->firstRecord->videoImg);
            $filename     = $this->videoImage->getFilename();
            $originalName = $this->videoImage->getClientOriginalName();
            $this->videoImage->storeAs('about/videoImg', $originalName, 'public');
            $this->firstRecord->update([
                'videoImg' => $originalName,
            ]);
            Storage::disk('local')->delete('livewire-tmp/' . $filename);
            $this->videoImage = '';
        }
        if ($this->resume && is_file($this->resume)) {
            Storage::disk('public')->delete('about/resume/' . $this->firstRecord->resume);
            $filename     = $this->resume->getFilename();
            $originalName = $this->resume->getClientOriginalName();
            $this->resume->storeAs('about/resume', $originalName, 'public');
            $this->firstRecord->update([
                'resume' => $originalName,
            ]);
            Storage::disk('local')->delete('livewire-tmp/' . $filename);
            $this->resume = '';
        }
        if ($this->skillPercentage == null) {
            $this->skillPercentage = 0;
        }
    }

    public function removeResume()
    {
        Storage::disk('public')->deleteDirectory('about/resume');
        $this->firstRecord->update([
            'resume' => null,
        ]);
    }

    public function fetchData()
    {
        $fAbout               = About::query()->first();
        $this->topTitle       = $fAbout->topTitle;
        $this->infoTopTitle   = $fAbout->infoTopTitle;
        $this->resume         = $fAbout->resume;
        $this->resumeButton   = $fAbout->resumeButton;
        $this->infoTitle      = $fAbout->infoTitle;
        $this->infoLocation   = $fAbout->infoLocation;
        $this->infoText       = $fAbout->infoText;
        $this->videoTitle     = $fAbout->videoTitle;
        $this->videoLink      = $fAbout->videoLink;
        $this->midTopTitle    = $fAbout->midTopTitle;
        $this->skillTopTitle  = $fAbout->skillTopTitle;
        $this->bottomTopTitle = $fAbout->bottomTopTitle;
    }

    public function teamEdit(About $about)
    {
        $this->clearInputs();
        $this->team        = $about;
        $this->midTitle    = $about->midTitle;
        $this->midSubtitle = $about->midSubtitle;
        $this->midDesc     = $about->midDesc;
        $this->midImg      = $about->midImg;

    }

    public function teamDelete(About $about)
    {
        $about->delete();
        $this->mount();
        $this->clearInputs();
    }

    public function teamSubmit()
    {
        if ($this->teamImage) {
            Storage::disk('public')->delete('about/team-' . $this->team->id . '/' . $this->team->midImg);
            $filename     = $this->teamImage->getFilename();
            $originalName = $this->teamImage->getClientOriginalName();
            $this->teamImage->storeAs('about/team-' . $this->team->id, $originalName, 'public');
            $this->team->update([
                'midImg' => $originalName,
            ]);
            Storage::disk('local')->delete('livewire-tmp/' . $filename);
        }
        $this->team->update([
            'midTitle'    => $this->midTitle,
            'midSubtitle' => $this->midSubtitle,
            'midDesc'     => $this->midDesc,
        ]);
        $this->clearInputs();
        $this->mount();
    }

    public function skillEdit(About $about)
    {
        $this->clearInputs();
        $this->skill           = $about;
        $this->skillTitle      = $about->skillTitle;
        $this->skillPercentage = $about->skillPercentage;

    }

    public function skillDelete(About $about)
    {
        $about->delete();
        $this->mount();
        $this->clearInputs();
    }

    public function skillSubmit()
    {
        $this->skill->update([
            'skillTitle'      => $this->skillTitle,
            'skillPercentage' => $this->skillPercentage ? $this->skillPercentage : 0,
        ]);
        $this->clearInputs();
        $this->mount();
    }

    public function teamAdd()
    {
        $this->clearInputs();
        $team       = About::query()->create([
            'midTitle'    => $this->midTitle,
            'midSubtitle' => $this->midSubtitle,
            'midDesc'     => $this->midDesc,
            'midImg'      => $this->midImg,
        ]);
        $this->team = $team;
        $this->mount();
    }

    public function skillAdd()
    {
        $this->clearInputs();
        $skill       = About::query()->create([
            'skillTitle'      => $this->skillTitle,
            'skillPercentage' => 20,
        ]);
        $this->skill = $skill;
        $this->mount();
    }

    public function bottomAdd()
    {
        $this->clearInputs();
        $bottom       = About::query()->create([
            'bottomTitle'    => 'title',
            'bottomSubtitle' => $this->bottomSubtitle,
            'bottomText'     => $this->bottomText,
        ]);
        $this->bottom = $bottom;
        $this->mount();
    }


    public function bottomEdit(About $about)
    {
        $this->clearInputs();
        $this->bottom         = $about;
        $this->bottomTitle    = $about->bottomTitle;
        $this->bottomSubtitle = $about->bottomSubtitle;
        $this->bottomText     = $about->bottomText;

    }

    public function bottomDelete(About $about)
    {
        $about->delete();
        $this->mount();
        $this->clearInputs();
    }

    public function bottomSubmit()
    {
        $this->bottom->update([
            'bottomTitle'    => $this->bottomTitle,
            'bottomSubtitle' => $this->bottomSubtitle,
            'bottomText'     => $this->bottomText,
        ]);
        $this->clearInputs();
        $this->mount();
    }

    public function clearInputs()
    {
        if ($this->teamImage) {
            Storage::disk('local')->delete('livewire-tmp/' . $this->teamImage->getFilename());
        }
        $this->midTitle        = '';
        $this->midSubtitle     = '';
        $this->midDesc         = '';
        $this->midImg          = '';
        $this->skillTitle      = '';
        $this->skillPercentage = '';
        $this->bottomTitle     = '';
        $this->bottomSubtitle  = '';
        $this->bottomText      = '';
        $this->team            = '';
        $this->videoImage      = '';
        $this->infoImage       = '';
        $this->teamImage       = '';
        $this->resume          = '';
        $this->skill           = '';
        $this->bottom           = '';
    }

    public function updateTexts()
    {
        $this->firstRecord->update([
            'topTitle'       => $this->topTitle,
            'infoTopTitle'   => $this->infoTopTitle,
            'resumeButton'   => $this->resumeButton,
            'infoTitle'      => $this->infoTitle,
            'infoLocation'   => $this->infoLocation,
            'infoText'       => $this->infoText,
            'videoTitle'     => $this->videoTitle,
            'videoLink'      => $this->videoLink,
            'midTopTitle'    => $this->midTopTitle,
            'skillTopTitle'  => $this->skillTopTitle,
            'bottomTopTitle' => $this->bottomTopTitle,
        ]);
        $this->fetchData();
    }

    public function render()
    {
        return view('livewire.admin.about-us');
    }
}
