<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $categories;

    public $category;
    public $name;

    public function mount()
    {
        $this->categories = Category::query()->orderByDesc('created_at')->get();
    }

    public function submit()
    {
        if ($this->category) {
            $this->category->update([
                'name' => $this->name,
            ]);
        } else {
            Category::query()->create([
                'name' => $this->name,
            ]);
        }
        $this->clearInputs();
        $this->mount();
    }

    public function delete(Category $category)
    {
        $category->delete();
        $this->mount();
    }

    public function edit(Category $category)
    {
        $this->clearInputs();
        $this->category = $category;
        $this->name     = $category->name;
    }

    public function clearInputs()
    {
        $this->category = '';
        $this->name     = '';

    }

    public function render()
    {
        return view('livewire.admin.categories');
    }
}
