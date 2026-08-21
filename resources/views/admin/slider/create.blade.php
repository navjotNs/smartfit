@extends('admin.layouts.master')
@section('content')
@include('admin.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-header">{!! lang('slider.slider') !!} <a class="btn btn-sm btn-primary pull-right" href="{!! route('sliders.index') !!}"> <i class="fa fa-plus fa-fw"></i> All {!! lang('slider.sliders') !!}</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>{!! lang('slider.slider_info') !!}</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'sliders.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('sliders.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'sliders.edit')
                                    {!! Form::model($result, array('route' => array('sliders.update', $result->id), 'method' => 'PATCH', 'id' => 'slider-form', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group"> 
                                            {!! Form::label('title', lang('Title'), array('class' => '')) !!}
                                            {!! Form::text('title', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div> 

                                  
                                    
            
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            {!! Form::label('image', lang('Slider Image (size 1600X500)'), array('class' => '')) !!}
                                            @if(!empty($result->image))
                                            {!! Form::file('image', array()) !!}
                                            @else
                                            {!! Form::file('image', array('required' => 'true')) !!}
                                            @endif
                                        </div>
                                        @if(!empty($result->image))
                                            <div class="form-group"> 
                                                 {!! Html::image(asset($result->image),'' ,array('width' => 70 , 'height' => 70,'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif
                                    </div>    


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


@stop

