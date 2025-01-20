<?php

namespace App\Livewire;

use App\Models\Message;
use App\Settings\ContactSettings;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Contact extends Component
{
    public $tab_index = 0;

    public $name = null;
    public $email = null;
    public $address = null;
    public $phone = null;
    public $gender = null;
    public $agency = null;
    public $visitor_size = null;
    public $age = 0;
    public $city = null;
    public $subject = null;
    public $message = null;

    public function rules()
    {
        $base =   [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'phone' => ['nullable'],
            'gender' => ['nullable', Rule::in(['male', 'female'])],
            'age' => ['nullable'],
            'city' => ['nullable', 'max:255'],
        ];

        if (!($this->tab_index > 0)) {
            $base = array_merge($base, [
                'subject' => ['required', 'max:255'],

                // TODO: ADD TAG VALIDATION OR SANITIZATION
                'message' => ['required', 'min:3']
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

    public function mount()
    {
        $this->handleTabChange(app(ContactSettings::class)->enable_inquiry_form ? 0 : 1);
    }



    #[Computed]
    public function isFormEnabled(): bool
    {
        return app(ContactSettings::class)->enable_visit_form || app(ContactSettings::class)->enable_inquiry_form;
    }

    function handleTabChange($index)
    {

        if (!app(ContactSettings::class)->enable_visit_form && !app(ContactSettings::class)->enable_inquiry_form) {
            return;
        }

        if (abs($index) > 1 || $this->tab_index == $index) {
            return;
        }

        $this->reset();

        $this->tab_index = $index;
    }

    function send()
    {
        if (!$this->isFormEnabled()) {
            return;
        }

        $this->validate();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'type' => $this->tab_index == 0 ? 'question' : 'visit',
        ]);

        $this->dispatch('message-sent');

        $this->resetExcept('tab_index');
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
