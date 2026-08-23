@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury sf-page-hero--contact">
    <div class="sf-page-hero__media">
        <img src="{!! asset('assets/frontend/images/hero-kitchen.png') !!}" alt="Contact Smart Fit Cabinets">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">Get in Touch</p>
        <h1 class="reveal">Contact Us</h1>
        <p class="reveal">Have a project in mind? We'd love to hear from you. Reach out and our team will get back to you promptly.</p>
    </div>
</section>

<section class="sf-section sf-contact-page">
    <div class="container">
        <div class="sf-info-cards">
            <a href="tel:0434991936" class="sf-info-card reveal">
                <span class="sf-info-card__icon"><i class="fa fa-phone"></i></span>
                <h3 style="font-size: 18px;">Phone</h3>
                <p style="margin-top: 0px;">0434 991 936</p>
            </a>
            <a href="mailto:info@smartfitcabinets.com" class="sf-info-card reveal">
                <span class="sf-info-card__icon"><i class="fa fa-envelope"></i></span>
                <h3 style="font-size: 18px;">Email</h3>
                <p style="margin-top: 0px;">info@smartfitcabinets.com.au</p>
            </a>
            <div class="sf-info-card reveal">
                <span class="sf-info-card__icon"><i class="fa fa-map-marker"></i></span>
                <h3 style="font-size: 18px;">Address</h3>
                <p style="margin-top: 0px;">Unit 4/483B Dohertys Road,<br>Truganina VIC 3029</p>
            </div>
            <div class="sf-info-card reveal">
                <span class="sf-info-card__icon"><i class="fa fa-clock-o"></i></span>
                <h3 style="font-size: 18px;">Business Hours</h3>
                <p style="margin-top: 0px;">Mon – Fri: 7:00am – 5:00pm<br>Saturday: By appointment<br>Sunday: Closed</p>
            </div>
        </div>

        <div class="sf-quote-banner reveal">
            <div>
                <h3>Need a detailed quote?</h3>
                <p style="margin-top: 0px;">Share project details, suburb and joinery type — we’ll come back with next steps.</p>
            </div>
            <a href="#send-message" class="sf-btn sf-btn--champagne">Request a Quote</a>
        </div>

        <div class="sf-contact__grid sf-contact__grid--page" id="send-message">
            <div class="sf-contact__form reveal">
                <p class="sf-eyebrow" style="margin-top: 0px;">Send Us a Message</p>
                <h2>Fill in the form</h2>
                <p class="sf-form-lead" style="margin-top: 0px;">We'll be in touch shortly.</p>
                @if(session()->has('enquiry_sub'))
                    <p class="sf-form-success" style="margin-top: 0px;">Your enquiry has been submitted successfully.</p>
                @endif
                <form action="{{ route('contact-enquiry') }}" method="post">
                    {{ csrf_field() }}
                    <div class="sf-form-row">
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Full Name *">
                        @if($errors->has('name'))<span class="text-danger">{{ $errors->first('name') }}</span>@endif
                    </div>
                    <div class="sf-form-row sf-form-row--split">
                        <div>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Phone Number *">
                            @if($errors->has('phone'))<span class="text-danger">{{ $errors->first('phone') }}</span>@endif
                        </div>
                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email Address *">
                            @if($errors->has('email'))<span class="text-danger">{{ $errors->first('email') }}</span>@endif
                        </div>
                    </div>
                    <div class="sf-form-row sf-form-row--split">
                        <div>
                            <select name="service" required>
                                <option value="">Project Type *</option>
                                <option value="Kitchen" {{ old('service') == 'Kitchen' ? 'selected' : '' }}>Kitchen</option>
                                <option value="Custom Joinery" {{ old('service') == 'Custom Joinery' ? 'selected' : '' }}>Custom Joinery</option>
                                <option value="Laundry" {{ old('service') == 'Laundry' ? 'selected' : '' }}>Laundry</option>
                                <option value="Bath Cabinet" {{ old('service') == 'Bath Cabinet' ? 'selected' : '' }}>Vanity / Bath</option>
                                <option value="Entertainment Unit" {{ old('service') == 'Entertainment Unit' ? 'selected' : '' }}>Entertainment Unit</option>
                                <option value="Commercial" {{ old('service') == 'Commercial' ? 'selected' : '' }}>Commercial / Builder</option>
                                <option value="Other" {{ old('service') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @if($errors->has('service'))<span class="text-danger">{{ $errors->first('service') }}</span>@endif
                        </div>
                        <div>
                            <input type="text" name="suburb" value="{{ old('suburb') }}" required placeholder="Suburb / Project Location *">
                            @if($errors->has('suburb'))<span class="text-danger">{{ $errors->first('suburb') }}</span>@endif
                        </div>
                    </div>
                    <button type="submit" class="sf-btn sf-btn--champagne sf-btn--full">Send Message</button>
                </form>
            </div>
            <div class="sf-contact-map reveal">
                <h2>Find Us</h2>
                <p style="margin-top: 0px;">Unit 5/483B Dohertys Road, Truganina VIC 3029</p>
                <div class="sf-contact-map__embed">
                    <iframe title="Smart Fit Cabinets location"
                        src="https://maps.google.com/maps?q=Unit%205%2F483B%20Dohertys%20Road%2C%20Truganina%20VIC%203029&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>
                </div>
                <a class="sf-btn sf-btn--outline" target="_blank" rel="noopener" href="https://www.google.com/maps/dir/?api=1&destination=Unit+5/483B+Dohertys+Road,+Truganina+VIC+3029">Get Directions</a>
            </div>
        </div>
    </div>
</section>

@endsection
