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
    public $institution = null;
    public $visitor_size = null;
    public $proposed_date = null;
    public $age = '0';
    public $city = null;
    public $subject = null;
    public $message = null;

    public $type = null;

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
        $this->resetErrorBag();
        $this->resetValidation();

        $this->tab_index = $index;
    }

    public function rules()
    {
        $base =   [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required'],
            'city' => ['required', 'max:255'],

            // TODO: ADD TAG VALIDATION OR SANITIZATION
            'message' => ['required', 'min:3'],

            'type' => ['required']
        ];

        // inquiry
        if ($this->tab_index === 0) {
            $base = array_merge($base, [
                'gender' => ['required', Rule::in(['male', 'female'])],
                'address' => ['required', 'max:255'],
                'age' => ['required', Rule::notIn(['0']),],
                'city' => ['required'],
                'subject' => ['required', 'max:255'],
            ]);
        }
        // visit
        else {
            $base = array_merge($base, [
                'visitor_size' => ['required'],
                'institution' => ['required'],
                'proposed_date' => ['required'],
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

    function send()
    {
        if (!$this->isFormEnabled()) {
            return;
        }

        $this->type = $this->tab_index == 0 ? 'inquiry' : 'visit';

        $this->validate();

        if ($this->type === 'visit') {
            $this->age = null;
        }

        Message::create($this->except('tab_index'));

        $this->dispatch('message-sent');

        $this->resetExcept('tab_index');
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
