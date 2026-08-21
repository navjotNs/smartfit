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
                <h1 class="page-header">Gallery <a class="btn btn-sm btn-primary pull-right" href="{!! route('gallery.index') !!}"> <i class="fa fa-plus fa-fw"></i> All Images</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>Gallery Information</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'gallery.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('gallery.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'gallery.edit')
                                    {!! Form::model($result, array('route' => array('gallery.update', $result->id), 'method' => 'PATCH', 'id' => 'slider-form', 'class' => '', 'files'=>'true')) !!}
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
                                            {!! Form::label('image', lang('Gallery Image'), array('class' => '')) !!}
                                            @if(!empty($result->image))
                                            {!! Form::file('image', array()) !!}
                                            @else
                                            {!! Form::file('image', array('required' => 'true')) !!}
                                            @endif
                                        </div>
                                        @if(!empty($result->image))
                                            <div class="form-group"> 
                                                 {!! Html::image(asset($result->image),'' ,array('width' => 150,'class'=>'img-responsive') ) !!}
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

