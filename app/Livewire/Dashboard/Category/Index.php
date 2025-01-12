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
    public $cofirmingDeleteCategory;
    public $categoryToDelete;

    public function render()
    {
        $categories = Category::paginate(2);
        return view('livewire.dashboard.category.index', compact('categories'));
    }

    public function delete(/*Category $category*/)
    {
        $this->categoryToDelete->delete();
        $this->cofirmingDeleteCategory = false;
        $this->dispatch('deleted');
    }

    public function selectCategoryToDelete(Category $category)
    {
        $this->cofirmingDeleteCategory = true;
        $this->categoryToDelete = $category;
    }


    function getCategoryProperty()
    {
        if ($this->categoryToDelete) {
            return Category::find($this->categoryToDelete->id);
        }

        return "Sin categoria";
    }
}
