<?php

namespace App\Livewire\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    //public $categories;
    use WithPagination;

    public function render()
    {
        $categories = Category::paginate(2);
        return view('livewire.dashboard.category.index', compact('categories'));
    }

    public function delete(Category $category)
    {
        $category->delete();
        $this->dispatch('deleted');
    }
}
