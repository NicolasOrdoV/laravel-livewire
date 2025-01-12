<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Dashboard\OrderTrait;

class Index extends Component
{

    use WithPagination;
    use OrderTrait;


    #[Url]
    public $type;
    #[Url]
    public $category_id;
    #[Url]
    public $posted;
    public $search;
    #[Url]
    public $from;
    #[Url]
    public $to;

    public $cofirmingDeletePost;
    public $postToDelete;

    public $columns = [
        'id' => 'Id',
        'title' => 'Title',
        'description' => 'Description',
        'category_id' => 'Category',
        'date' => 'Date'
    ];


    public function render()
    {
        // $posts = Post::where('id', '>=', '1');
        $posts = new Post();
        $categories = Category::get();

        if ($this->type) {
            $posts = $posts->where('type', $this->type);
        }

        if ($this->category_id) {
            $posts = $posts->where('category_id', $this->category_id);
        }

        if ($this->posted) {
            $posts = $posts->where('posted', $this->posted);
        }

        if ($this->search) {
            $posts = $posts->where(function ($query) {
                $query->orWhere('id', 'like', '%' . $this->search . '%')
                    ->orWhere('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->from && $this->to) {
            $posts = $posts->whereBetween('date', [date($this->from), date($this->to)]);
        }

        $posts = $posts->orderBy($this->sortColumn, $this->sortDirection)->paginate(20);
        return view('livewire.dashboard.post.index', compact('posts', 'categories'));
    }

    public function delete(/*Category $category*/)
    {
        $this->postToDelete->delete();
        $this->cofirmingDeletePost = false;
        $this->dispatch('deleted');
    }

    public function selectPostToDelete(Post $post)
    {
        $this->cofirmingDeletePost = true;
        $this->postToDelete = $post;
    }
}
