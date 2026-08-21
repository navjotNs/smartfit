@extends('admin.layouts.master')
@section('content')
@section('css')
<!-- tables -->
<!-- <link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" /> -->
<!-- //tables -->
@endsection

  <div class="social grid">
    <div class="grid-info" style="float: left; width: 100%;">
        <!-- <div class="col-md-3 top-comment-grid">
          <a href="{!! route('customer') !!}">
            <div class="comments">
                <div class="comments-icon">
                    <i class="fa fa-pen" style="color: #fff; font-size: 5em !important; margin: 0; padding: 0;"></i>
                </div>
                <div class="comments-info">
                    <h3>{{ $articles }}</h3>
                    <a href="#">Total Articles</a>
                </div>
                <div class="clearfix"> </div>
            </div>
          </a>
        </div> -->

        <div class="col-md-3 top-comment-grid">
          <a href="{!! route('customer') !!}">
            <div class="comments">
                <div class="comments-icon">
                    <i class="fa fa-flag" style="color: #fff; font-size: 5em !important; margin: 0; padding: 0;"></i>
                </div>
                <div class="comments-info">
                    <h3>{{ $articles }}</h3>
                    <a href="#">Total Destinations</a>
                </div>
                <div class="clearfix"> </div>
            </div>
          </a>
        </div>

        <!-- <div class="col-md-3 top-comment-grid">
          <a href="{!! route('customer') !!}">
            <div class="comments" style="background: #ef70a3;">
                <div class="comments-icon">
                    <i class="fa fa-question" style="color: #fff; font-size: 5em !important; margin: 0; padding: 0;"></i>
                </div>
                <div class="comments-info">
                    <h3>{{ $faqs }}</h3>
                    <a href="#">Total Faq's</a>
                </div>
                <div class="clearfix"> </div>
            </div>
          </a>
        </div> -->

        <div class="col-md-3 top-comment-grid">
          <a href="#">
            <div class="comments" style="background: #ef70a3;">
                <div class="comments-icon">
                  <i class="fa fa-envelope" style="color: #fff; font-size: 5em !important; margin: 0; padding: 0;"></i>
                </div>
                <div class="comments-info">
                    <h3>{{ $contact_enquiry }}</h3>
                    <a href="#">Total Enquiries</a>
                </div>
                <div class="clearfix"> </div>
            </div>
          </a>
        </div>






        
    
       
        
        
       
    </div>
  </div> 
  
  
@endsection