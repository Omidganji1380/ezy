<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use App\Models\Category;
use File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class WeblogEdit extends Component
{
    use WithFileUploads;

    public $blog;
    public $categories;

    public $title;
    public $slug;
    public $text;
    public $category_id;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    public $status;
    public $image;

    public function updated()
    {
        if ($this->image) {
            Storage::disk('public')->delete('blogs/blog-' . $this->blog->id . '/' . $this->blog->img);
            $filename     = $this->image->getFilename();
            $originalName = $this->image->getClientOriginalName();
            $this->image->storeAs('blogs/blog-' . $this->blog->id, $originalName, 'public');
            $this->blog->update([
                'img' => $originalName,
            ]);
            Storage::disk('local')->delete('livewire-tmp/' . $filename);
            $this->image = null;
            $this->mount($this->blog->id);
        }
    }

    public function imgRemove()
    {
//        dd('asdasd');
        Storage::disk('public')->delete('blogs/blog-' . $this->blog->id . '/' . $this->blog->img);
    }

    public function mount($id)
    {
        $this->blog       = Blog::query()->findOrFail($id);
        $this->categories = Category::query()->orderByDesc('created_at')->get();
        $this->fetchData();
    }

    public function fetchData()
    {
        $this->title            = $this->blog->title;
        $this->slug             = $this->blog->slug;
        $this->text             = $this->blog->text;
        $this->category_id      = $this->blog->category_id;
        $this->meta_title       = $this->blog->meta_title;
        $this->meta_keywords    = $this->blog->meta_keywords;
        $this->meta_description = $this->blog->meta_description;
        $this->status           = $this->blog->status;
    }

    public function uploadImage(Request $request, $id)
    {
        if ($request->hasFile('upload')) {
            $file       = $request->file('upload');
            $originName = $file->getClientOriginalName();
            $fileName   = time() . '_' . $originName;

            $file->storeAs('blogs/blog-' . $id . '/media', $fileName, 'public');

            $url = asset('storage/blogs/blog-' . $id . '/media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function updateTexts()
    {
        $this->blog->update([
            'title'            => $this->NI($this->title),
            'slug'             => $this->NI($this->slug),
            'text'             => $this->text,
            'category_id'      => $this->NI($this->category_id),
            'meta_title'       => $this->NI($this->meta_title),
            'meta_keywords'    => $this->NI($this->meta_keywords),
            'meta_description' => $this->NI($this->meta_description),
            'status'           => $this->status,
        ]);
    }

    public function NI($input)
    {
        return $input ? $input : null;
    }

    public function render()
    {
        return view('livewire.admin.weblog-edit');
    }
}
