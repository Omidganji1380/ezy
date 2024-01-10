<?php

namespace App\Livewire\Front\WrapSection;

use App\Models\Blog;
use Livewire\Component;

class BlogSection extends Component
{
    public $blogs;

    public function mount()
    {
        $this->blogs = Blog::query()->where('status', 1)->orderByDesc('created_at')->limit(6)->get();
    }

    public function render()
    {
        return view('livewire.front.wrap-section.blog-section');
    }
}
