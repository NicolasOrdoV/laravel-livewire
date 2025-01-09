<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $cofirmingDeletePost;
    public $postToDelete;

    public function render()
    {
        $posts = Post::paginate(2);
        return view('livewire.dashboard.post.index', compact('posts'));
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
