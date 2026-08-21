<!DOCTYPE html>
<head class="wide wow-animation" lang="en">
<!-- Site Title-->
<title>Smart Fit Cabinets | Custom Cabinetry &amp; Joinery Melbourne</title>
<meta name="description" content="Premium custom cabinetry and architectural joinery for Melbourne homes. Bespoke kitchens, wardrobes, vanities and joinery — designed to inspire, built to last."/>
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
<meta http-equiv="X-UA-Compatible" content="IE=edgex">
<meta charset="utf-8">
<meta name="csrf-token" content="{!! csrf_token() !!}" />
    <link rel="icon" href="{!! asset('assets/frontend/images/logo_icon.png') !!}" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+DK+Uloopet+Guides&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.css">
    <script src="https://kit.fontawesome.com/956568d106.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{!! asset('/images/logo.png') !!}" type="image/png">
{!! Html::style('assets/frontend/css/style.css') !!}
{!! HTML::style('assets/frontend/css/stellarnav.min.css') !!}
{!! HTML::style('assets/frontend/css/home-experience.css') !!}
{!! HTML::style('assets/frontend/css/dark-luxury.css') !!}
@yield('css')
@php
    $route  = \Route::currentRouteName();    
@endphp

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G9WRZZ34QQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G9WRZZ34QQ');
</script>
</head>
<body class="content-pages sf-dark {{ $route }} ">

    <!-- Page-->
    <div class="page">
        <!-- Header -->
        @include('frontend.layouts.header')      
        <!-- Main Content -->
        @yield('content')
        <!-- Footer -->

<!-- HEADER STARTS -->
    
        @include('frontend.layouts.footer') 

    </div> 
<!-- Javascript-->
<!-- SCRIPT STARTS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        {!! HTML::script('assets/frontend/js/stellarnav.min.js') !!}
        <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
        {!! HTML::script('assets/frontend/js/smooth-home.js') !!}
        <script>
            function rdmore() {
              var dots = document.getElementById("dots");
              var moreText = document.getElementById("more");
              var btnText = document.getElementById("myBtn");

              if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more"; 
                moreText.style.display = "none";
              } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less"; 
                moreText.style.display = "inline";
              }
            }
            </script>
            @if(session()->has('subscrive'))

            @else

            @if(session()->has('otp_sent'))

            @else
            @if(session()->has('you_not_register'))

            @else
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#onloadmodal").modal('show');
                });
            </script>
            @endif
            @endif
            @endif
    <!-- SCRIPT ENDS -->


<script src="https://malsup.github.com/jquery.form.js"></script>


<script type="text/javascript">

var token = $('meta[name="csrf-token"]').attr('content');
var authType = false;

$(document).ready(function(){
    $('#sign-up-form').submit(function(e){
        if ($("#sign-up-form").validationEngine('validate') ) {
        e.preventDefault();
        submitForm($(this), authSuccess);
    }
    });
});

function submitForm(_form, successFunc) {
    removeErrors();
    // showLoader();
    // var data = additionalData;
    var data = {'_token' : $('meta[name="csrf-token"]').attr('content')};
    console.log(data);
    _form.ajaxSubmit({
        type: 'POST',
        data: data,
        success: function(response){
            hideLoader();
            successFunc(response);
        },
        error: function(response){
            showErrors(response, _form);
           // hideLoader();
        }
    });
}

function showErrors(response, _form) {
    if (typeof response.responseJSON == 'undefined') {
        // swal('');
        alert('error occured');
    } else if (typeof response.responseJSON.error != 'undefined') {
        swal('Error:', response.responseJSON.error, 'error');
    } else {
        for (i in response.responseJSON.errors) {
            var fieldName = i;
            _form.find('[name="'+ fieldName +'"]').parent().addClass('err');
            _form.find('[name="'+ fieldName +'"]').parent().append('<span class="custom-validate-error-item">'+ response.responseJSON.errors[i][0] +'</span>');
        }
    }
}

function authSuccess(response) {
    if (typeof response.intended != 'undefined' ) {
        if (authType == 'blog_comment') {
            window.location = response.intended + '#comments-reply';
            location.reload();
        } else {
            window.location = response.intended;
        }
    }
}

function removeErrors() {
    $('.err').removeClass('err');
    $('.custom-validate-error-item').remove();
}

function removeInputsNErrors(formSelector) {
    removeErrors();
    if (typeof formSelector != 'undefined') {
        $( formSelector ).find('input, select').val('');
        $( formSelector ).find('textarea').val('');
    }
}

jQuery(document).ready(function(){
    smoothScrollTo('#verified-purchase', 1500, 100);
}); 

jQuery(document).ready(function(){
jQuery("#sign-in-form").validationEngine();
});

$(".ajax_login").click(function(e){
if ($("#sign-in-form").validationEngine('validate') ) {
        e.preventDefault();
        var email = $("input[name=email]").val();
        var password = $("input[name=password]").val();
        $.ajax({
           type:'GET',
           url: "{{ route('login') }}",
           data:{password:password, email:email},
           success:function(data){

            if(data.error){
                $("#login-res").html(data.error);
            } else {
                $("#login-succes").html(data.succes);
                if(data.url){
                    window.location.href = "/"+data.url;  
                } else {
                  window.location='/';
                }
                
            }
              
           } 
        });
    } else {
    }
    });
    $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function(){
    $("#success-alert").alert('close');
    });


</script>


@if(session()->has('message_reg'))
<script type="text/javascript">
    $('#modal1').modal('hide');
    $('#modal2').modal('show');
</script>
@endif

<script type="text/javascript">
 
function startDictation() {
    $('#speak_icon').addClass('red_speak_icon');
    if (window.hasOwnProperty('webkitSpeechRecognition')) {
      var recognition = new webkitSpeechRecognition();
      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('transcript').value = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };
      recognition.onerror = function(e) {
        recognition.stop();
      }
    }
}  

$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {

    $('#total_records1').html(data.table_data);
   }
  })
 }

 $(document).on('keyup', '.main-search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});

// SLIDER 1 JS STARTS
    $('#slider1').owlCarousel({
        autoplay: true,
        smartSpeed: 900,
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        center: false,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                nav: false
            },
            575:{
                items:1,
                nav: false
            },
            768:{
                items:1,
                nav: false
            },
            992:{
                items:1
            },
            1200:{
                items:1
            }
        }
    });
// SLIDER 1 JS ENDS

    if ($('#processSlider').length) {
        $('#processSlider').owlCarousel({
            loop: true,
            margin: 22,
            nav: false,
            dots: true,
            autoplay: false,
            smartSpeed: 600,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                1200: { items: 3 }
            }
        });
    }

// HOME SERVICES CAROUSEL
    if ($('#slider_services').length) {
        $('#slider_services').owlCarousel({
            autoplay: true,
            autoplayTimeout: 4500,
            smartSpeed: 700,
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            navText: ['<span aria-hidden="true">&lsaquo;</span>', '<span aria-hidden="true">&rsaquo;</span>'],
            autoplayHoverPause: true,
            responsive: {
                0: { items: 1, margin: 14 },
                576: { items: 2, margin: 16 },
                992: { items: 3, margin: 18 },
                1200: { items: 4, margin: 20 }
            }
        });
    }

// SLIDER REVIEWS STARTS
    $('#slider_rev').owlCarousel({
        autoplay: true,
        smartSpeed: 900,
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        center: false,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                nav: false
            },
            575:{
                items:1,
                nav: false
            },
            768:{
                items:2,
                nav: false
            },
            992:{
                items:3
            },
            1200:{
                items:3
            }
        }
    });

jQuery('#main-nav').stellarNav({
        theme     : 'plain', 
        breakpoint: 1199, 
        //menuLabel: '<a href="/"><img src="/assets/frontend/images/logo.png"></a>',  
        phoneBtn: false, 
        locationBtn: false, 
        sticky     : false, 
        openingSpeed: 250, 
        closingDelay: 250, 
        position: 'right', 
        showArrows: true, 
        closeBtn     : false, 
        scrollbarFix: false,
        mobileMode: false
    });
</script>


</body>
</html>
