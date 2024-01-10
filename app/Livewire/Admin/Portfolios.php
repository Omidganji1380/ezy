<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Portfolio;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Portfolios extends Component
{
    use WithFileUploads;

    public $portfolios;
    public $categories;

    public $portfolio;
    public $title;
    public $link;
    public $category_id;

    public $image;

    public function mount()
    {
        $this->portfolios = Portfolio::query()->orderByDesc('created_at')->get();
        $this->categories = Category::query()->orderByDesc('created_at')->get();
    }

    public function submit()
    {
        if ($this->portfolio) {
            $this->portfolio->update([
                'title'       => $this->title,
                'link'        => $this->link,
                'category_id' => $this->category_id ? $this->category_id : null,
            ]);
        } else {
            $portfolio       = portfolio::query()->create([
                'title'       => $this->title,
                'link'        => $this->link,
                'category_id' => $this->category_id ? $this->category_id : null,
                'img'         => 0,
            ]);
            $this->portfolio = $portfolio;
        }
        if ($this->image) {
            $this->uploadImage($this->portfolio);
        }
        $this->clearInputs();
        $this->mount();
    }

    public function changeStatus(Portfolio $portfolio)
    {
        if ($portfolio->status == 0)
            $portfolio->update(['status' => 1]);
        else
            $portfolio->update(['status' => 0]);
        $this->mount();
    }

    public function uploadImage(Portfolio $portfolio)
    {
        Storage::disk('public')->delete('portfolios/portfolio-' . $portfolio->id . '/' . $portfolio->img);
        $filename     = $this->image->getFilename();
        $originalName = $this->image->getClientOriginalName();
        $this->image->storeAs('portfolios/portfolio-' . $portfolio->id, $originalName, 'public');
        Storage::disk('local')->delete('livewire-tmp/' . $filename);

        $portfolio->update([
            'img' => $originalName,
        ]);
    }

    public function delete(Portfolio $portfolio)
    {
        Storage::disk('public')->deleteDirectory('portfolios/portfolio-' . $portfolio->id);
        $portfolio->delete();
        $this->mount();
    }

    public function edit(Portfolio $portfolio)
    {
        $this->clearInputs();
        $this->portfolio   = $portfolio;
        $this->title       = $portfolio->title;
        $this->link        = $portfolio->link;
        $this->category_id = $portfolio->category_id;
    }

    public function clearInputs()
    {
        $this->portfolio   = '';
        $this->title       = '';
        $this->link        = '';
        $this->category_id = '';
        $this->image       = '';
    }

    public function render()
    {
        return view('livewire.admin.portfolios');
    }
}
