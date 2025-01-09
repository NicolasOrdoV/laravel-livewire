<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Save extends Component
{

    public $title;
    public $description;
    public $text;
    public $posted;
    public $type;
    public $category_id;
    public $image;
    public $date;
    public $post;

    protected $rules = [
        'title' => 'required|min:2|max:255',
        'description' => 'required|min:2|max:255',
        'date' => 'required',
        'category_id' => 'required',
        'posted' => 'required',
        'text' => 'required|min:2|max:500',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
    ];

    function mount(?int $id = null)
    {
        if ($id != null) {
            $this->post = Post::findOrFail($id);
            $this->title = $this->post->title;
            $this->text = $this->post->text;
            $this->category_id = $this->post->category_id;
            $this->posted = $this->post->posted;
            $this->type = $this->post->type;
            $this->description = $this->post->description;
            $this->date = $this->post->date;
        }
    }

    public function render()
    {
        $categories = Category::get();
        return view('livewire.dashboard.post.save', compact('categories'));
    }

    function submit()
    {
        try {
            DB::beginTransaction();
            $this->validate();

            if ($this->post) {
                $this->post->update(
                    [
                        'title' => $this->title,
                        'text' => $this->text,
                        'description' => $this->description,
                        'category_id' => $this->category_id,
                        'date' => $this->date,
                        'type' => $this->type,
                        'posted' => $this->posted,
                        'slug' => str($this->title)->slug(),
                    ]
                );
                $this->dispatch('updated');
            } else {
                $this->post = Post::create(
                    [
                        'title' => $this->title,
                        'text' => $this->text,
                        'description' => $this->description,
                        'category_id' => $this->category_id,
                        'date' => $this->date,
                        'type' => $this->type,
                        'posted' => $this->posted,
                        'slug' => str($this->title)->slug(),
                    ]
                );
                $this->dispatch('created');
            }

            // upload
            if ($this->image) {
                $imageName = $this->category->slug . '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('images/post', $imageName, 'public_upload');

                $this->post->update([
                    'image' => $imageName
                ]);
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            Log::error($th);
        }
    }
}
