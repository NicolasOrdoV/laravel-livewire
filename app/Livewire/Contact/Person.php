<?php

namespace App\Livewire\Contact;

use App\Models\ContactPerson;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Person extends Component
{
    #[Validate('required|min:2|max:255')]
    public $name;

    #[Validate('required|min:2|max:255')]
    public $surname;

    #[Validate('required')]
    public $choices;

    #[Validate('nullable')]
    public $other;

    public $parentId;

    protected $listeners = ['parentId'];

    function mount($parentId)
    {
        $this->parentId = $parentId;
    }

    public function parentId($id)
    {
        $this->parentId = $id;
        $c = ContactPerson::where('contact_general_id', $this->parentId)->first();
        if($c != null) {
            $this->name = $c->name;
            $this->surname = $c->surname;
            $this->choices = $c->choices;
            $this->other = $c->other;
        }
    }


    #[Layout('layouts.contact')]
    public function render()
    {
        return view('livewire.contact.person');
    }

    public function submit()
    {
        $this->validate();

        ContactPerson::updateOrCreate(['contact_general_id' => $this->parentId], [
            'name' => $this->name,
            'surname' => $this->surname,
            'choices' => $this->choices,
            'contact_general_id' => $this->parentId,
            'other' => $this->other,
        ]);

        $this->dispatch('stepEvent', 3);
    }

    public function back()
    {
        $this->dispatch('stepEvent', 1);
    }
}
