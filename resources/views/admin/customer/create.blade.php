@extends('admin.layouts.master')
@section('content')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-10">
                <h1 class="page-header">Worker <a class="btn btn-sm btn-primary pull-right" href="{!! route('customer') !!}"> <i class="fa fa-arrow-left"></i> All Worker </a></h1>
                <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>Worker Information</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'customer.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('customer.store'), 'id' => 'ajaxSave', 'class' => '')) !!}
                                @elseif($route == 'customer.edit')
                                    {!! Form::model($result, array('route' => array('customer.update', $result->id), 'method' => 'PATCH', 'id' => 'customer-form', 'class' => '')) !!}
                                @else
                                    Nothing
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('first_name', lang('First Name'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('first_name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @else
                                                {!! Form::text('first_name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('last_name', lang('Last Name'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('last_name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @else
                                                {!! Form::text('last_name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                        </div> 
                                    </div>
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                            {!! Form::label('email', lang('common.email'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::email('email', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::email('email', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('email'))
                                             <span class="text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                        {!! Form::label('mobile', lang('Mobile'), array('class' => '')) !!}
                                        {!! Form::number('mobile', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                        @if($errors->has('mobile'))
                                            <span class="text-danger">{{$errors->first('mobile')}}</span>
                                        @endif
                                        </div> 
                                    </div>
                                    <input type="hidden" value="2" name="user_type">

                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                        {!! Form::label('country_id', lang('Country'), array('class' => '')) !!}
                                        <select name="country_id" onChange="getSubcategory(this.value);" class="select2 form-control1">
                                        <option value="">-Select-</option>
                                        @foreach($countries as $cat)
                                        <option value="{{ $cat->id }}" @if(isset($result)) @if($result->country_id == $cat->id) selected @endif @endif>{{ $cat->name }}</option>
                                        @endforeach
                                        </select>
                                        @if($errors->has('country_id'))
                                            <span class="text-danger">{{$errors->first('country_id')}}</span>
                                        @endif
                                        </div> 
                                    </div>

                                    <div class="col-md-6 state" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                        <label for="state_id" class="">State</label>
                                        <select name="state_id" onChange="getSubcategory_2(this.value);" id="state-list" class="select2 form-control1">
                                        <option value="">-Select-</option>
                                        @if(isset($state_list))
                                        @foreach($state_list as $cat_list2)
                                         <option value="{{ $cat_list2->id }}" @if($result->state_id == $cat_list2->id) selected @endif>{{ $cat_list2->name }}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 city" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                        <label for="city_id" class="">City</label>
                                        <select name="city_id" id="city-list" class="select2 form-control1">
                                        <option value="">-Select-</option>
                                        @if(isset($city_list))
                                        @foreach($city_list as $cat_list2)
                                         <option value="{{ $cat_list2->id }}" @if($result->city_id == $cat_list2->id) selected @endif>{{ $cat_list2->name }}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                        </div>
                                    </div>

                                    

                                    @if(isset($result))
                                    @else
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="form-group"> 
                                          {!! Form::label('password', lang('Password'), array('class' => '')) !!}
                                            {!! Form::password('password', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @if($errors->has('password'))
                                        <span class="text-danger"><br>{{$errors->first('password')}}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    @endif
                                    
                    
                                    <div class="col-md-12" style="margin-top: 20px;"> 
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

function getSubcategory(val) {
  $.ajax({
    type: "GET",
    url: "{{ route('getState') }}",
    data: {'main_id' : val},
    success: function(data){
        $("#state-list").html(data);
    }
  });
}

function getSubcategory_2(val) {
  $.ajax({
    type: "GET",
    url: "{{ route('getCity') }}",
    data: {'main_id' : val},
    success: function(data){
        $("#city-list").html(data);
    }
  });
}

</script>
<style type="text/css">
#password {
    height: 40px;
}
select{
    outline: navajowhite;
}
</style>
@if($errors->has('total_ads'))
<style type="text/css">
  .company_name,
  .total_ads {
    display: block !important;
  }
</style>
@endif
@stop




