<x-form.input name="name" :label="__('contact.form.name')" :placeholder="__('contact.form.name')" model="name" />

<x-form.input name="email" :label="__('contact.form.email')" :placeholder="__('contact.form.email')" model="email" />

<x-form.input name="address" :label="__('contact.form.address')" :placeholder="__('contact.form.address')" model="address" />

<x-form.input name="phone" :label="__('contact.form.phone')" :placeholder="__('contact.form.phone')" model="phone" />

<x-form.radio name="gender" :label="__('contact.form.gender')" model="gender" :options="[
    'male' => __('contact.form.gender.male'),
    'female' => __('contact.form.gender.female'),
]" />

<x-form.dropdown name="age" :label="__('contact.form.age')" model="age" :options="[
    '12-16' => '12-16',
    '17-25' => '17-25',
    '26-35' => '26-35',
    '36-45' => '36-45',
    '46-55' => '46-55',
    '56-65' => '56-65',
    '>65' => '>65',
]"
    placeholder="{{ __('contact.form.age.placeholder') }}" />

<x-form.input name="city" :label="__('contact.form.city')" :placeholder="__('contact.form.city')" model="city" />

<x-form.dropdown name="purpose" :label="__('contact.form.purpose')" model="purpose" :options="collect(\App\Enums\ContactPurposes::cases())
    ->mapWithKeys(fn(\App\Enums\ContactPurposes $purpose) => [$purpose->value => $purpose->getLabel()])
    ->toArray()"
    placeholder="{{ __('contact.form.purpose.placeholder') }}" />

<x-form.input name="subject" :label="__('contact.form.subject')" :placeholder="__('contact.form.subject')" model="subject" />

<x-form.input name="message" :label="__('contact.form.message')" :placeholder="__('contact.form.message')" element="textarea" rows="5" model="message" />
