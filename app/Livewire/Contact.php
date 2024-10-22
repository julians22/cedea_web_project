<?php

namespace App\Livewire;

use App\Models\Message;
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
        $base =   [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ];

        if (!($this->tabIndex > 0)) {
            $base = array_merge($base, [
                'subject'  => 'required|max:255',
                'message' => 'required|min:3'
            ]);
        }

        return $base;
    }

    // public function messages()
    // {
    //     return [
    //         'message.required' => 'The :attribute are missing.',
    //         'message.min' => 'The :attribute is too short.',
    //     ];
    // }

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

        $this->reset();

        $this->tabIndex = $index;
    }

    function send()
    {
        $this->validate();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message
        ]);

        $this->dispatch('message-sent');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
