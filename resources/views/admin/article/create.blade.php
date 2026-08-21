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
                <h1 class="page-header">Service <a class="btn btn-sm btn-primary pull-right" href="{!! route('article.index') !!}"> <i class="fa fa-solid fa-arrow-left"></i> All Services</a></h1>
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>Service Information</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'article.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('article.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'article.edit')
                                    {!! Form::model($result, array('route' => array('article.update', $result->id), 'method' => 'PATCH', 'id' => 'article-form', 'class' => '', 'files'=>'true')) !!}
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
                                            <label for="description" class="">Description</label>
                                            {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
                                            @if ($errors->has('description'))
                                             <span class="text-danger">{{$errors->first('description')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            {!! Form::label('meta_description', lang('Meta Description'), array('class' => '')) !!}
                                            {!! Form::text('meta_description', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>

                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            {!! Form::label('sort_order', lang('Sort Order'), array('class' => '')) !!}
                                            {!! Form::number('sort_order', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>

                                    <div class="col-md-4" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label>Image</label> 
                                            @if(!empty($result->image))
                                            {!! Form::file('image', array()) !!}
                                            @else
                                            {!! Form::file('image', array('required' => 'true')) !!}
                                            @endif
                                            @if($errors->has('image'))
                                             <span class="text-danger">{{$errors->first('image')}}</span>
                                            @endif
                                        </div>
                                        @if(!empty($result->image))
                                            <div class="form-group"> 
                                                 {!! HTML::image(asset($result->image),'' ,array('width' => 150 , 'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif
                                    </div> 
                                    <div class="col-md-4" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label>Banner</label> 
                                            @if(!empty($result->banner))
                                            {!! Form::file('banner', array()) !!}
                                            @else
                                            {!! Form::file('banner', array('required' => 'true')) !!}
                                            @endif
                                            @if($errors->has('banner'))
                                             <span class="text-danger">{{$errors->first('banner')}}</span>
                                            @endif
                                        </div>
                                        @if(!empty($result->banner))
                                            <div class="form-group"> 
                                                 {!! HTML::image(asset($result->banner),'' ,array('width' => 150 , 'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif
                                    </div> 

                                    <div class="col-md-4" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            <label>Service Page Image</label> 
                                            @if(!empty($result->img_service))
                                            {!! Form::file('img_service', array()) !!}
                                            @else
                                            {!! Form::file('img_service', array('required' => 'true')) !!}
                                            @endif
                                            @if($errors->has('img_service'))
                                             <span class="text-danger">{{$errors->first('img_service')}}</span>
                                            @endif
                                        </div>
                                        @if(!empty($result->img_service))
                                            <div class="form-group"> 
                                                 {!! HTML::image(asset($result->img_service),'' ,array('width' => 150 , 'class'=>'img-responsive') ) !!}
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

