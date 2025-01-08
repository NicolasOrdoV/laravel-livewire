<?php

namespace App\Livewire\Contact;

use App\Models\ContactDetail;
use App\Models\ContactGeneral;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Detail extends Component
{

    #[Validate('required|min:2|max:500')]
    public $extra;

    public $parentId;

    protected $listeners = ['parentId'];

    function mount($parentId)
    {
        $this->parentId = $parentId;
    }

    public function parentId($id)
    {
        $this->parentId = $id;
        $c = ContactDetail::where('contact_general_id', $this->parentId)->first();
        if ($c != null) {
            $this->extra = $c->extra;
        }
    }

    #[Layout('layouts.contact')]
    public function render()
    {
        return view('livewire.contact.detail');
    }

    public function submit()
    {
        $this->validate();

        ContactDetail::updateOrCreate(['contact_general_id' => $this->parentId], [
            'extra' => $this->extra,
            'contact_general_id' => $this->parentId,
        ]);

        $this->dispatch('stepEvent', 4);
    }



    public function back()
    {
        $contactGeneral = ContactGeneral::find($this->parentId);
        if ($contactGeneral->type == 'company') {
            $this->dispatch('stepEvent', 2);
        } elseif ($contactGeneral->type == 'person') {
            $this->dispatch('stepEvent', 2.5);
        }
    }
}
