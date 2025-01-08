<?php

namespace App\Livewire\Contact;

use App\Models\ContactGeneral;
use Livewire\Attributes\Validate;
use Livewire\Component;

class General extends Component
{
    #[Validate('required|min:2|max:255')]
    public $subject;

    #[Validate('required|min:2')]
    public $message;

    #[Validate('required')]
    public $type;

    public $step = 1;

    public $contactGeneral;

    protected $listeners = ['stepEvent'];

    function mount(?int $id = null, ?int $step = null)
    {
        if ($id != null) {
            $this->contactGeneral = ContactGeneral::findOrFail($id);
            $this->pk = $this->contactGeneral->id;
            $this->subject = $this->contactGeneral->subject;
            $this->message = $this->contactGeneral->message;
            $this->type = $this->contactGeneral->type;

            if ($step) {
                if ($this->type == 'company') {
                    $this->step = 2;
                } elseif ($this->type == 'person') {
                    $this->step = 2.5;
                }
            }
        }
    }

    public function stepEvent($step)
    {
        $this->step = $step;
        $this->dispatch('parentId', $this->pk);
    }

    public $pk;

    // protected $rules = [
    //     'subject' => 'required|min:2|max:255',
    //     'message' => 'required|min:2',
    //     'type' => 'required',
    // ];

    public function render()
    {
        return view('livewire.contact.general')->layout('layouts.contact');
    }

    public function submit()
    {
        $this->validate();

        if ($this->pk) {
            ContactGeneral::where('id', $this->pk)->update([
                'subject' => $this->subject,
                'message' => $this->message,
                'type' => $this->type,
            ])->id;
        } else {
            if ($this->contactGeneral) {
                $this->contactGeneral->update([
                    'subject' => $this->subject,
                    'message' => $this->message,
                    'type' => $this->type,
                ]);
            } else {
                $this->pk = ContactGeneral::create([
                    'subject' => $this->subject,
                    'message' => $this->message,
                    'type' => $this->type,
                ])->id;
                $this->redirectRoute('contact-edit', ['id' => $this->pk, 'step' => 1]);
            }
        }


        if ($this->type == 'company') {
            $this->step = 2;
        } elseif ($this->type == 'person') {
            $this->step = 2.5;
        }
        $this->stepEvent($this->step);
    }
}
