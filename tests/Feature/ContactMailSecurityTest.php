<?php

use App\Livewire\Contact;
use App\Mail\ContactMail;
use App\Models\Message;

it('uses the application sender and the visitor as reply-to', function () {
    config()->set('mail.from.address', 'website@cedeaseafood.com');
    config()->set('mail.from.name', 'CEDEA Website');

    $message = new Message([
        'name' => 'Visitor',
        'email' => 'visitor@example.com',
        'subject' => 'Product question',
    ]);

    $envelope = (new ContactMail($message))->envelope();

    expect($envelope->isFrom('website@cedeaseafood.com', 'CEDEA Website'))->toBeTrue()
        ->and($envelope->hasReplyTo('visitor@example.com', 'Visitor'))->toBeTrue()
        ->and($envelope->hasSubject('[Website contact] Product question'))->toBeTrue();
});

it('rejects line breaks in contact email headers', function () {
    $rules = (new Contact)->rules();

    expect($rules['name'])->toContain('not_regex:/[\r\n]/')
        ->and($rules['email'])->toContain('not_regex:/[\r\n]/')
        ->and($rules['subject'])->toContain('not_regex:/[\r\n]/');
});
