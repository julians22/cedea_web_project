<x-form.input name="name" :label="__('contact.form.name')" :placeholder="__('contact.form.name')" model="name" />

<x-form.input name="email" type="email" :label="__('contact.form.email')" :placeholder="__('contact.form.email')" model="email" />

<x-form.input name="city" :label="__('contact.form.city')" :placeholder="__('contact.form.city')" model="city" />

<x-form.input name="phone" :label="__('contact.form.phone')" :placeholder="__('contact.form.phone')" model="phone" />

<x-form.input name="institution" :label="__('contact.form.institution')" :placeholder="__('contact.form.institution')" model="institution" />

<x-form.input name="visitor_size" :label="__('contact.form.visitor_size')" :placeholder="__('contact.form.visitor_size')" model="visitor_size" />

{{-- <x-form.input name="visit_date" type="date" :label="__('contact.form.date')" placeholder="YYYY-MM-DD" model="visit_date" /> --}}

<x-form.input name="proposed_date" :label="__('contact.form.date')" :placeholder="__('contact.form.date')" element="textarea" rows="3"
    model="proposed_date" />

<x-form.input name="message" :label="__('contact.form.message')" :placeholder="__('contact.form.message')" element="textarea" rows="5" model="message" />
