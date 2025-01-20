<x-form.input name="name" :label="__('contact.form.name')" :placeholder="__('contact.form.name')" model="name" />

<x-form.input name="email" :label="__('contact.form.email')" :placeholder="__('contact.form.email')" model="email" />

<x-form.input name="phone" :label="__('contact.form.phone')" :placeholder="__('contact.form.phone')" model="phone" />

<x-form.radio name="gender" label="Jenis Kelamin" model="gender" :options="[
    'male' => __('male'),
    'female' => __('female'),
]" />

<x-form.dropdown name="age" label="umur" model="age" :options="[
    '12-16' => '12-16',
    '17-25' => '17-25',
    '26-35' => '26-35',
    '36-45' => '36-45',
    '46-55' => '46-55',
    '56-65' => '56-65',
    '>65' => '>65',
]" placeholder="Pilih rentang usia" />

<x-form.input name="city" :label="__('contact.form.city')" :placeholder="__('contact.form.city')" model="city" />

<x-form.input name="subject" :label="__('contact.form.subject')" :placeholder="__('contact.form.subject')" model="subject" />

<x-form.input name="message" :label="__('contact.form.message')" :placeholder="__('contact.form.message')" element="textarea" rows="5" model="message" />
