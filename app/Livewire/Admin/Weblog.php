<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;
use Storage;

class Weblog extends Component
{
    use WithPagination;

    protected $blogs;

    public function addBlog()
    {
        $blog = Blog::query()->create();
        $this->redirect(route('admin.blog.edit', $blog->id), true);
    }

    public function delete(Blog $blog)
    {
        Storage::disk('public')->deleteDirectory('blogs/blog-' . $blog->id);
        $blog->delete();
    }

    public function changeStatus(Blog $blog)
    {
        if ($blog->status == 1)
            $blog->update([
                'status' => 0,
            ]);
        else
            $blog->update([
                'status' => 1,
            ]);
    }

    public function render()
    {
        $this->blogs = Blog::query()->orderByDesc('created_at')->paginate(20);
        return view('livewire.admin.weblog', ['blogs' => $this->blogs]);
    }
}
