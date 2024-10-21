<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Contact extends Component
{
    public $tabIndex = 0;

    public $name = null;
    public $email = null;
    public $subject = null;
    public $message = null;

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',

            'message' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'The :attribute are missing.',
            'message.min' => 'The :attribute is too short.',
        ];
    }

    // public function validationAttributes()
    // {
    //     return [
    //         'message' => 'description',
    //     ];
    // }


    function handleTabChange($index)
    {
        if (abs($index) > 1 || $this->tabIndex == $index) {
            return;
        }

        $this->tabIndex = $index;
    }

    function send()
    {
        $this->validate();

        $this->dispatch('message-sent');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
