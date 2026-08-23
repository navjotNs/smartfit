@extends('frontend.layouts.app')
@section('content')

<section class="sf-page-hero sf-page-hero--luxury">
    <div class="sf-page-hero__media">
        <img src="{!! asset('assets/frontend/images/hero-kitchen.png') !!}" alt="Smart Fit Cabinets services">
        <div class="sf-page-hero__shade"></div>
    </div>
    <div class="sf-page-hero__content">
        <p class="sf-eyebrow reveal">What We Build</p>
        <h1 class="reveal">Our Services</h1>
        <p class="reveal">From custom kitchens and wardrobes to vanities, laundries and architectural joinery — Smart Fit Cabinets delivers complete cabinetry packages across Melbourne.</p>
    </div>
</section>

<section class="sf-section sf-section--graphite">
    <div class="container">
        <div class="sf-page-intro__inner reveal">
            <h2>Complete custom cabinetry</h2>
            <p>Smart Fit Cabinets offers a comprehensive range of bespoke joinery. Whether you are fitting a new kitchen, upgrading storage, or delivering a full-home joinery package, our team manages design, documentation, manufacture and installation with precision and care.</p>
        </div>
        <nav class="sf-svc-jump reveal" aria-label="Service categories">
            <a href="#kitchens">Kitchen</a>
            <a href="#laundries">Laundry</a>
            <a href="#vanities">Vanities</a>
            <a href="#wardrobes">Custom Wardrobes</a>
            <a href="#entertainment">Entertainment Units</a>
            <a href="#bars">Bar/Display</a>
            <a href="#offices">Home Offices</a>
            <a href="#architectural">Architectural Joinery</a>
        </nav>
    </div>
</section>

<section class="sf-section sf-section--dark sf-svc-list">
    <div class="container">

        <article class="sf-svc-block reveal" id="kitchens">
            <div class="sf-svc-block__media">
                <img src="{!! asset('assets/frontend/images/Kitchens_j.jpeg') !!}" alt="Custom kitchen joinery">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Kitchen</h2>
                <p style="margin-top: 0px;" class="sf-svc-block__lead">Beautifully designed, expertly crafted.</p>
                <p style="margin-top: 0px;">A Smart Fit kitchen is tailored to the home, the brief and the way you live. From integrated appliances and concealed storage to stone, timber and architectural lighting — every layout is designed and manufactured with precision.</p>
                <ul class="sf-svc-include">
                    <li>Custom layouts and shop drawings</li>
                    <li>Premium board, stone and hardware</li>
                    <li>Manufacture and professional installation</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

        <article class="sf-svc-block sf-svc-block--reverse reveal" id="laundries">
            <div class="sf-svc-block__media">
                <img src="{!! asset('uploads/images/laundry.jpeg') !!}" alt="Custom laundry joinery">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Laundry</h2>
                <p style="margin-top: 0px;" class="sf-svc-block__lead">Functional joinery that keeps spaces ordered.</p>
                <p style="margin-top: 0px;">Laundry cabinetry that conceals appliances, manages utilities and provides practical storage — finished to the same standard as the rest of the home.</p>
                <ul class="sf-svc-include">
                    <li>Appliance housing and benchtops</li>
                    <li>Tall storage and hanging space</li>
                    <li>Clean, easy-to-maintain finishes</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

        <article class="sf-svc-block reveal" id="vanities">
            <div class="sf-svc-block__media">
                <img src="{!! asset('uploads/images/860430bath_15.webp') !!}" alt="Custom bathroom vanities">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Vanities</h2>
                <p style="margin-top: 0px;" class="sf-svc-block__lead">Durable joinery with refined detailing.</p>
                <p style="margin-top: 0px;">Custom vanities designed for wet areas, with considered storage, stone tops and finishes selected for longevity. Built to complement the bathroom architecture rather than sit as a standard unit.</p>
                <ul class="sf-svc-include">
                    <li>Custom sizes and storage layouts</li>
                    <li>Stone tops and moisture-resistant construction</li>
                    <li>Coordinated installation</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

        <article class="sf-svc-block sf-svc-block--reverse reveal" id="wardrobes">
            <div class="sf-svc-block__media">
                <img src="{!! asset('uploads/images/bardwrobe.jpeg') !!}" alt="Custom wardrobe joinery">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Custom Wardrobes</h2>
                <p style="margin-top: 0px;" class="sf-svc-block__lead">Fitted storage designed around daily use.</p>
                <p style="margin-top: 0px;">Walk-in and fitted wardrobes with considered hanging, drawers, lighting and internal organisation. Designed to sit quietly in the architecture of the room — not as an afterthought.</p>
                <ul class="sf-svc-include">
                    <li>Walk-in and built-in configurations</li>
                    <li>Internal lighting and accessories</li>
                    <li>Full-height doors and refined detailing</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

        <article class="sf-svc-block reveal" id="entertainment">
            <div class="sf-svc-block__media">
                <img src="{!! asset('uploads/images/941639entertain_05.webp') !!}" alt="Entertainment unit joinery">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Entertainment units</h2>
                <p style="margin-top: 0px;" class="sf-svc-block__lead">Media walls integrated with the room.</p>
                <p style="margin-top: 0px;">TV cabinetry and entertainment joinery designed around screens, sound, storage and cable management — so the living space stays architectural and uncluttered.</p>
                <ul class="sf-svc-include">
                    <li>Media walls and TV cabinetry</li>
                    <li>Concealed cable management</li>
                    <li>Display and closed storage</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

        <article class="sf-svc-block sf-svc-block--reverse reveal" id="bars">
            <div class="sf-svc-block__media">
                <img src="{!! asset('uploads/images/bar_disp.jpeg') !!}" alt="Bar and display joinery">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Bar/Display</h2>
                <p style="margin-top: 0px;" class="sf-svc-block__lead">Feature joinery for entertaining.</p>
                <p style="margin-top: 0px;">Bar joinery, display cabinetry and feature walls designed as part of the architecture — for entertaining, collections and statement spaces.</p>
                <ul class="sf-svc-include">
                    <li>Home bars and servery joinery</li>
                    <li>Display, lighting and glass storage</li>
                    <li>Integrated appliances where required</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

        <article class="sf-svc-block reveal" id="offices">
            <div class="sf-svc-block__media">
                <img src="{!! asset('uploads/images/home_office.jpeg') !!}" alt="Home office joinery">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Home Office</h2>
                <p style="margin-top: 0px;" class="sf-svc-block__lead">Study joinery with clean lines and storage.</p>
                <p style="margin-top: 0px;">Desks, shelving and concealed storage designed for how you work — with cable management, filing and a finish that belongs in a residential interior.</p>
                <ul class="sf-svc-include">
                    <li>Desks, libraries and wall joinery</li>
                    <li>Concealed storage and cabling</li>
                    <li>Quiet, durable finishes</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

        <article class="sf-svc-block sf-svc-block--reverse reveal" id="architectural">
            <div class="sf-svc-block__media">
                <img src="{!! asset('assets/frontend/images/arct.jpeg') !!}" alt="Architectural joinery">
            </div>
            <div class="sf-svc-block__copy">
                <h2>Custom Joinery instead of architectural</h2>
                <p class="sf-svc-block__lead" style="margin-top: 0px;">Bespoke craftsmanship for every room.</p>
                <p style="margin-top: 0px;">Full-height panelling, linen towers, integrated walls and detailed joinery packages worked from architectural drawings — for homeowners, builders and interior designers.</p>
                <ul class="sf-svc-include">
                    <li>Shop drawings and detailing</li>
                    <li>Full-height and integrated joinery</li>
                    <li>Manufacture and site installation</li>
                </ul>
                <div class="sf-hero__actions">
                    <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
                </div>
            </div>
        </article>

    </div>
</section>

<section class="sf-section sf-contact--band reveal">
    <div class="container text-center">
        <h2>Ready to Get Started?</h2>
        <p style="max-width: 560px; margin: 0 auto 1.5rem;">Contact us for a no-obligation consultation and quote on your next cabinetry project.</p>
        <div class="sf-hero__actions" style="justify-content: center;">
            <a href="{{ route('contact') }}" class="sf-btn sf-btn--champagne">Get a Quote</a>
            <a href="{{ route('contact') }}" class="sf-btn sf-btn--outline">Contact Us</a>
        </div>
    </div>
</section>

@endsection
