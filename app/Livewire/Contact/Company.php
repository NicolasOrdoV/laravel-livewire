<?php

namespace App\Livewire\Contact;

use App\Models\ContactCompany;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Company extends Component
{
    #[Validate('required|min:2|max:255')]
    public $name;

    #[Validate('required|min:2|max:255')]
    public $identificaction;

    #[Validate('required')]
    public $choices;

    #[Validate('nullable')]
    public $extra;

    #[Validate('required|min:2|max:80')]
    public $email;

    public $parentId;

    protected $listeners = ['parentId'];

    function mount($parentId)
    {
        $this->parentId = $parentId;
    }

    public function parentId($id)
    {
        $this->parentId = $id;
        $c = ContactCompany::where('contact_general_id', $this->parentId)->first();
        if($c != null) {
            $this->name = $c->name;
            $this->identificaction = $c->identificaction;
            $this->choices = $c->choices;
            $this->extra = $c->extra;
            $this->email = $c->email;
        }
    }

    #[Layout('layouts.contact')]
    public function render()
    {
        return view('livewire.contact.company');
    }

    public function submit()
    {
        $this->validate();

        ContactCompany::updateOrCreate(['contact_general_id' => $this->parentId], [
            'name' => $this->name,
            'identificaction' => $this->identificaction,
            'choices' => $this->choices,
            'extra' => $this->extra,
            'contact_general_id' => $this->parentId,
            'email' => $this->email,
        ]);

        $this->dispatch('stepEvent', 3);
    }

    public function back()
    {
        $this->dispatch('stepEvent', 1);
    }
}
