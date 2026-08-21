@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <img src="{!! asset('assets/frontend/images/oth_hdr_contact.webp') !!}" alt="Contact Smart Fit Cabinets">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Contact</p>
        <h1 class="reveal">Let's discuss<br>your project.</h1>
        <p class="reveal">Share your brief, plans or inspiration — our team will be in touch.</p>
    </div>
</section>

<section class="sf-section sf-contact sf-contact--luxury">
    <div class="container">
        <div class="sf-contact__grid">
            <div class="sf-contact__intro reveal">
                <p class="sf-eyebrow">Get in touch</p>
                <h2>Workshop &amp; enquiries</h2>
                <div class="sf-contact__meta">
                    <p><strong>Address</strong><br>Unit 5/483B Dohertys Road, Truganina, VIC 3029, Australia</p>
                    <p><strong>Phone</strong><br><a href="tel:0434991936">0434 991 936</a></p>
                    <p><strong>Email</strong><br><a href="mailto:info@smartfitcabinets.com">info@smartfitcabinets.com</a></p>
                    <p class="sf-footer__area">Greater Melbourne Region</p>
                </div>
            </div>
            <div class="sf-contact__form reveal">
                @if(session()->has('enquiry_sub'))
                    <p class="sf-form-success">Your enquiry has been submitted successfully.</p>
                @endif
                <form action="{{ route('contact-enquiry') }}" method="post">
                    {{ csrf_field() }}
                    <div class="sf-form-row">
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Name *">
                        @if($errors->has('name'))<span class="text-danger">{{ $errors->first('name') }}</span>@endif
                    </div>
                    <div class="sf-form-row">
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email *">
                        @if($errors->has('email'))<span class="text-danger">{{ $errors->first('email') }}</span>@endif
                    </div>
                    <div class="sf-form-row">
                        <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Phone *">
                        @if($errors->has('phone'))<span class="text-danger">{{ $errors->first('phone') }}</span>@endif
                    </div>
                    <div class="sf-form-row">
                        <select name="service" required>
                            <option value="">Project Type *</option>
                            <option value="Kitchen">Kitchen</option>
                            <option value="Custom Joinery">Custom Joinery</option>
                            <option value="Laundry">Laundry</option>
                            <option value="Bath Cabinet">Vanity / Bath</option>
                            <option value="Entertainment Unit">Entertainment Unit</option>
                            <option value="Commercial">Commercial / Builder</option>
                            <option value="Other">Other</option>
                        </select>
                        @if($errors->has('service'))<span class="text-danger">{{ $errors->first('service') }}</span>@endif
                    </div>
                    <div class="sf-form-row">
                        <input type="text" name="suburb" value="{{ old('suburb') }}" required placeholder="Suburb / Project Location *">
                        @if($errors->has('suburb'))<span class="text-danger">{{ $errors->first('suburb') }}</span>@endif
                    </div>
                    <button type="submit" class="sf-btn sf-btn--champagne sf-btn--full">Send Enquiry</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
