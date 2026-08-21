@extends('admin.layouts.master')
@section('css')

{!! Html::script('js/nicEdit-latest.js') !!} <script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
</script>

@stop
@section('content')
@include('admin.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Content Management</h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <!--<div class="form-title">
                                <h4>Article Information</h4>                        
                            </div>-->
                            <div class="form-body">
                            {!! Form::model($result, array('route' => array('update-content', $result->id), 'method' => 'PATCH', 'id' => 'article-form', 'class' => '', 'files'=>'true')) !!}
                            
                                
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('twitter', lang('Twitter'), array('class' => '')) !!}
                                            {!! Form::text('twitter', null, array('class' => 'form-control')) !!}
                                        </div> 
                                    </div> 
                                    
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('instagram', lang('Instagram'), array('class' => '')) !!}
                                            {!! Form::text('instagram', null, array('class' => 'form-control')) !!}
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            {!! Form::label('facebook', lang('Facebook'), array('class' => '')) !!}
                                            {!! Form::text('facebook', null, array('class' => 'form-control')) !!}
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            {!! Form::label('youtube', lang('Youtube'), array('class' => '')) !!}
                                            {!! Form::text('youtube', null, array('class' => 'form-control')) !!}
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            {!! Form::label('linkedin', lang('Linkedin'), array('class' => '')) !!}
                                            {!! Form::text('linkedin', null, array('class' => 'form-control')) !!}
                                        </div> 
                                    </div>

                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label for="about" class="">About Us</label>
                                            {!! Form::textarea('about', null, array('class' => 'form-control')) !!}
                                            @if ($errors->has('about'))
                                             <span class="text-danger">{{$errors->first('about')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                 <!--    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label for="specialization" class="">Specialization</label>
                                            {!! Form::textarea('specialization', null, array('class' => 'form-control')) !!}
                                            @if ($errors->has('specialization'))
                                             <span class="text-danger">{{$errors->first('specialization')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label for="home_about" class="">Who We Are</label>
                                            {!! Form::textarea('home_about', null, array('class' => 'form-control')) !!}
                                            @if ($errors->has('home_about'))
                                             <span class="text-danger">{{$errors->first('home_about')}}</span>
                                            @endif
                                        </div>
                                    </div> -->

                                  <!--   <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label>Landing Page Image</label> 
                                            @if(!empty($result->landing_image))
                                            {!! Form::file('landing_image', array()) !!}
                                            @else
                                            {!! Form::file('landing_image', array('required' => 'true')) !!}
                                            @endif
                                            @if($errors->has('landing_image'))
                                             <span class="text-danger">{{$errors->first('landing_image')}}</span>
                                            @endif
                                        </div>
                                        @if(!empty($result->landing_image))
                                            <div class="form-group"> 
                                                 {!! HTML::image(asset($result->landing_image),'' ,array('width' => 150 , 'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif
                                    </div> 
 -->                                    
                                 <!--    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label>Who We Are Image</label> 
                                            @if(!empty($result->home_about_image))
                                            {!! Form::file('home_about_image', array()) !!}
                                            @else
                                            {!! Form::file('home_about_image', array('required' => 'true')) !!}
                                            @endif
                                            @if($errors->has('home_about_image'))
                                             <span class="text-danger">{{$errors->first('home_about_image')}}</span>
                                            @endif
                                        </div>
                                        @if(!empty($result->home_about_image))
                                            <div class="form-group"> 
                                                 {!! HTML::image(asset($result->home_about_image),'' ,array('width' => 250 , 'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif
                                    </div> 
 -->                                    
                                    <!-- <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label>Landing Page Doctor Image (600*400)</label> 
                                            @if(!empty($result->doctor_image))
                                            {!! Form::file('doctor_image', array()) !!}
                                            @else
                                            {!! Form::file('doctor_image', array('required' => 'true')) !!}
                                            @endif
                                            @if($errors->has('doctor_image'))
                                             <span class="text-danger">{{$errors->first('doctor_image')}}</span>
                                            @endif
                                        </div>
                                        @if(!empty($result->doctor_image))
                                            <div class="form-group"> 
                                                 {!! HTML::image(asset($result->doctor_image),'' ,array('width' => 250 , 'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif
                                    </div>  -->
                                    
                                    <!-- <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label>Landing Page Patient Image (600*400)</label> 
                                            @if(!empty($result->patient_image))
                                            {!! Form::file('patient_image', array()) !!}
                                            @else
                                            {!! Form::file('patient_image', array('required' => 'true')) !!}
                                            @endif
                                            @if($errors->has('patient_image'))
                                             <span class="text-danger">{{$errors->first('patient_image')}}</span>
                                            @endif
                                        </div>
                                        @if(!empty($result->patient_image))
                                            <div class="form-group"> 
                                                 {!! HTML::image(asset($result->patient_image),'' ,array('width' => 250 , 'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif
                                    </div>  -->

                                    
                                 
                                    </div>
                                    
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <div class="col-md-12">
                                         <button type="submit" class="btn btn-default w3ls-button">Submit</button> 
                                    </div>
                                </div>
                                    
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}    

function getSubcategory(val) {
  $.ajax({
    type: "GET",
    url: "{{ route('getSubcategory') }}",
    data: {'main_id' : val},
    success: function(data){
        $("#category-list").html(data);
    }
  });
}

</script>

@stop

