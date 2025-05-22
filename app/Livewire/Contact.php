<?php

namespace App\Livewire;

use App\Enums\ContactPurposes;
use App\Models\Message;
use App\Settings\ContactSettings;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

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

    public function mount()
    {
        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'Contact - ' . env('APP_NAME');
        $description = 'Tinggalkan Pesan';
        $url = route('contact');
        $image = asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('Contact');

        $og
            ->setType('website')
            ->setSiteName(env('APP_NAME'))
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->setLocale($locale)
            ->addAlternateLocale($alternateLocale);

        $twitter_card
            ->setTitle($title)
            ->setDescription($description)
            ->setImage($image);

        Meta::registerPackage($og);
        Meta::registerPackage($twitter_card);


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
                'purpose' => ['required', Rule::enum(ContactPurposes::class)],
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
    protected function validateRecaptcha(string $token): void
    {
        // validate Google reCaptcha.
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => request()->ip(),
        ]);
        $throw = fn($message) => throw ValidationException::withMessages(['recaptcha' => $message]);
        if (! $response->successful() || ! $response->json('success')) {
            $throw($response->json(['error-codes'])[0] ?? 'An error occurred.');
        }
        // if response was score based (the higher the score, the more trustworthy the request)
        if ($response->json('score') < 0.6) {
            $throw('We were unable to verify that you\'re not a robot. Please try again.');
        }
    }
    #[On('formSubmitted')]
    function send($token)
    {
        if (!$this->isFormEnabled()) {
            return;
        }

        $this->type = $this->tab_index == 0 ? 'inquiry' : 'visit';

        $this->validate();
        $this->validateRecaptcha($token);

        if ($this->type === 'visit') {
            $this->age = null;
            $this->purpose = null;
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
