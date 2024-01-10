<?php

namespace App\Livewire\Front\WrapSection;

use App\Models\Category;
use App\Models\Portfolio;
use Livewire\Component;


class PortfolioSection extends Component
{

    public $portfolios;
    public $categories;

    public function mount()
    {
        $this->categories = Category::query()->orderByDesc('created_at')->get();
        $this->portfolios = Portfolio::query()->where('status', 1)->inRandomOrder()->get();

    }

    public function render()
    {

        return view('livewire.front.wrap-section.portfolio-section'/*, ['portfolios' => $this->portfolios]*/);
    }

}
