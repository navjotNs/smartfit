@extends('admin.layouts.master')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@section('content')

<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">                
                <h1 class="page-header">{{ 	$user->name }} ({{ 	$user->unique_id }})</h1>

                <div class="agile-tables">
                    <div class="w3l-table-info">

                        {{-- for message rendering --}}
                        @include('admin.layouts.messages')
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Attendance Filter
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    {!! Form::open(array('method' => 'POST',
                                    'route' => array('attendance', $user->id))) !!}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name" class="control-label">From Date</label>
                                            
                                                <input type="date" name="from_date" @if(isset($request->from_date)) value="{{ $request->from_date }}" @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="product_type" class="control-label">To Date</label>
                                                
                                                <input name="to_date" type="date" @if(isset($request->to_date))value="{{ $request->to_date }}" @endif class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3 margintop20">
                                            <div class="form-group">
                                                {!! Form::hidden('form-search', 1) !!}
                                                {!! Form::submit(lang('common.filter'), array('class' => 'btn btn-primary')) !!}
                                                <a href="{{ route('attendance', $user->id) }}" class="btn btn-success"> {!! lang('common.reset_filter') !!}</a>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>



                        <table class="table table-hover">
<thead>
<tr>
    <th width="15%">Date</th>
    <th>Construction Site</th>
    <th>Work Hours</th>
    <th>Break Hours</th>
    <th class="text-center">Details</th>
</tr>
</thead>
<tbody>
@php
$i = 1;
@endphp
@foreach($data as $key => $dat)
@php
$i++;
@endphp
<tr>
    <td>{{ $dat['date'] }}</td>
    <td><button type="button" data-toggle="modal" style="border: 0px; background: transparent; color: blue;" data-target="#exampleModal{{$i}}">{{ $dat['company'] }}</button>
    
    <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px; font-weight: 600;">{{ $dat['company'] }}</h5>
        <button type="button" class="close" style="margin-top: -20px;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul style="list-style: none;">
            <li style="margin-bottom: 7px;">Shift Start Time: {{ $dat['shift_start_time'] }}</li>
            <li style="margin-bottom: 7px;">Shift End Time: {{ $dat['shift_end_time'] }}</li>
            <li style="margin-bottom: 7px;">Latitude: {{ $dat['latitude'] }}</li>
            <li style="margin-bottom: 7px;">Longitude: {{ $dat['longitude'] }}</li>
        </ul>
      </div>
      
    </div>
  </div>
</div>
    
    
    </td>
    <td>{{ $dat['total_working_hr'] }}</td>
    <td>{{ $dat['total_break_hr'] }}</td>
    <td class="text-center">
        <a class="btn btn-xs btn-primary" href="/admin/day-details/{{$dat['day']}}/{{$user->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
        
        
    </td>    
</tr>
@endforeach
@if(empty($data))
<tr>
    <td colspan="5" style="text-align:center";>No Data Found</td>
    
</tr>

@endif
</tbody>
</table>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop

