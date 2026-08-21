@extends('admin.layouts.master')
@section('content')
@include('admin.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">{!! lang('category.category') !!} <a class="btn btn-sm btn-primary pull-right" href="{!! route('category.index') !!}"> <i class="fa fa-solid fa-arrow-left"></i> All {!! lang('category.categories') !!}</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>{!! lang('category.category_info') !!}</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'category.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('category.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'category.edit')
                                    {!! Form::model($result, array('route' => array('category.update', $result->id), 'method' => 'PATCH', 'id' => 'category-form', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('name', lang('common.name'), array('class' => '')) !!}
                                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="parent_id" class="">Parent Category</label>
                                            {!! Form::select('parent_id',$ParentCategory,!empty($result->parent_id)?$result->parent_id:'', array('class' => 'select2 form-control1')) !!}
                                            @if ($errors->has('parent_id'))
                                             <span class="text-danger">{{$errors->first('parent_id')}}</span>
                                            @endif
                                        </div>
                                    </div>  
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                        <label for="show_to" class="">Show</label>
                                        <select name="show_to" class="select2 form-control1" required="true">
                                        <option value="">-Select-</option>
                                        <option {{ old('show_to') == '1' ? 'selected' : '' }} value="1" @if(isset($result)) @if($result->show_to == 1) selected @endif @endif>Doctor</option>
                                        <option {{ old('show_to') == '2' ? 'selected' : '' }} value="2" @if(isset($result)) @if($result->show_to == 2) selected @endif @endif>Patient</option>
                                        <option {{ old('show_to') == '3' ? 'selected' : '' }} value="3" @if(isset($result)) @if($result->show_to == 3) selected @endif @endif>Both</option>
                                        </select>
                                        @if($errors->has('show_to'))
                                             <span class="text-danger">{{$errors->first('show_to')}}</span>
                                        @endif
                                        </div>
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

</script>

@stop

