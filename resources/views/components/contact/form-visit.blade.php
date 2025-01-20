<x-form.input name="name" :label="__('contact.form.name')" :placeholder="__('contact.form.name')" model="name" />

<x-form.input name="email" :label="__('contact.form.email')" :placeholder="__('contact.form.email')" model="email" />

<x-form.input name="city" :label="__('contact.form.city')" :placeholder="__('contact.form.city')" model="city" />

<x-form.input name="phone" :label="__('contact.form.phone')" :placeholder="__('contact.form.phone')" model="phone" />

<x-form.input name="agency" :label="__('contact.form.agency')" :placeholder="__('contact.form.agency')" model="agency" />

<x-form.input name="visitor_size" :label="__('contact.form.visitor_size')" :placeholder="__('contact.form.visitor_size')" model="visitor_size" />

<x-form.datepicker />

<x-form.input name="message" :label="__('contact.form.message')" :placeholder="__('contact.form.message')" element="textarea" rows="5" model="message" />
