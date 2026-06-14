<?php

namespace App\Livewire;

use App\Enums\ContactPurposes;
use App\Jobs\SendMailJob;
use App\Models\Message;
use App\Settings\ContactSettings;
use App\Support\SeoMetadata;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Throwable;

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

    public $purpose = '0';

    public $subject = null;

    public $message = null;

    public $type = null;

    public function mount(): void
    {
        SeoMetadata::register(
            title: __('seo.contact.title'),
            description: __('seo.contact.description'),
            url: route('contact'),
            image: asset('img/mutu.jpg'),
        );

        $this->handleTabChange(app(ContactSettings::class)->enable_inquiry_form ? 0 : 1);
    }

    #[Computed]
    public function isFormEnabled(): bool
    {
        return app(ContactSettings::class)->enable_visit_form || app(ContactSettings::class)->enable_inquiry_form;
    }

    public function handleTabChange($index)
    {

        if (! app(ContactSettings::class)->enable_visit_form && ! app(ContactSettings::class)->enable_inquiry_form) {
            return;
        }

        if (abs($index) > 1 || $this->tab_index == $index) {
            return;
        }

        $this->resetExcept(
            ['tab_index'],
        );

        $this->resetErrorBag();
        $this->resetValidation();

        $this->tab_index = $index;
    }

    public function rules(): array
    {
        $base = [
            'name' => ['required', 'string', 'max:255', 'not_regex:/[\r\n]/'],
            'email' => ['required', 'string', 'email', 'max:255', 'not_regex:/[\r\n]/'],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['required', 'max:255'],
            'message' => ['required', 'string', 'min:3', 'max:5000'],
            'type' => ['required', Rule::in(['inquiry', 'visit'])],
        ];

        // inquiry
        if ($this->tab_index === 0) {
            $base = array_merge($base, [
                'gender' => ['required', Rule::in(['male', 'female'])],
                'address' => ['required', 'max:255'],
                'age' => ['required', Rule::notIn(['0'])],
                'city' => ['required'],
                'purpose' => ['required', Rule::enum(ContactPurposes::class)],
                'subject' => ['required', 'string', 'max:255', 'not_regex:/[\r\n]/'],
            ]);
        }
        // visit
        else {
            $base = array_merge($base, [
                'visitor_size' => ['required', 'integer', 'min:1'],
                'institution' => ['required', 'string', 'max:255'],
                'proposed_date' => ['required', 'date', 'after_or_equal:today'],
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

    /**
     * Validate the given reCAPTCHA token.
     *
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRecaptcha(string $token): void
    {
        // validate Google reCaptcha.
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => request()->ip(),
        ]);
        $throw = fn ($message) => throw ValidationException::withMessages(['recaptcha' => $message]);
        if (! $response->successful() || ! $response->json('success')) {
            $throw($response->json(['error-codes'])[0] ?? 'An error occurred.');
        }
        // if response was score based (the higher the score, the more trustworthy the request)
        if ($response->json('score') < 0.6) {
            $throw('We were unable to verify that you\'re not a robot. Please try again.');
        }
    }

    /**
     * Send the message.
     *
     * @param  string  $token
     * @return void
     */
    #[On('formSubmitted')]
    public function send($token)
    {
        if (! $this->isFormEnabled()) {
            return;
        }

        $this->type = $this->tab_index == 0 ? 'inquiry' : 'visit';

        $this->validate();

        $this->validateRecaptcha($token);

        if ($this->type === 'visit') {
            $this->age = null;
            $this->purpose = null;
        }

        $message = Message::create($this->except(['tab_index']));

        $this->dispatch('message-sent');
        $this->resetExcept('tab_index');

        try {
            dispatch(new SendMailJob($message));
        } catch (Throwable $e) {
            Log::error('Failed to send contact email: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
