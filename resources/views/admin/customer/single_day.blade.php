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
                        



                        <table class="table table-hover">
<thead>
<tr>
    <th width="15%">Date</th>
    <th>Company</th>
    <th>In - Out</th>
    <th>In Distance</th>
    <th>Out Distance</th>
    <th>Work Hours</th>
    <th>Break Hours</th>
    
</tr>
</thead>
<tbody>
@php
$i = 1;
@endphp
@foreach($data as $dat)
@foreach($dat['all_punch'] as $key => $all_punch)
@php
$i++;
@endphp
<tr>
    <td>{{ $dat['date'] }}</td>
    <td><button type="button" data-toggle="modal" style="border: 0px; background: transparent; color: blue;" data-target="#exampleModal{{$i}}">{{ $all_punch['company'] }}</button>
    
    <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px; font-weight: 600;">{{ $all_punch['company'] }}</h5>
        <button type="button" class="close" style="margin-top: -20px;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul style="list-style: none;">
            <li style="margin-bottom: 7px;">Shift Start Time: {{ $all_punch['shift_start_time'] }}</li>
            <li style="margin-bottom: 7px;">Shift End Time: {{ $all_punch['shift_end_time'] }}</li>
            <li style="margin-bottom: 7px;">Latitude: {{ $all_punch['latitude'] }}</li>
            <li style="margin-bottom: 7px;">Longitude: {{ $all_punch['longitude'] }}</li>
        </ul>
      </div>
      
    </div>
  </div>
</div>
    
    
    </td>
    <td>{{ $all_punch['in'] }} - {{ $all_punch['out'] }}</td>
    <td>
   @php
   $lat1 = $all_punch['punch_in_lat'];
   $lon1 = $all_punch['punch_in_lon']; 
   $lat2 = $all_punch['company_in_lat']; 
   $lon2 = $all_punch['company_in_lon'];
   
   
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $km = ($miles * 1.609344);
   
   
   @endphp
        {{ round($km, 3) }}km
        
    </td>
    <td>
   @php
   $lat1 = $all_punch['punch_out_lat'];
   $lon1 = $all_punch['punch_out_lon']; 
   $lat2 = $all_punch['company_out_lat']; 
   $lon2 = $all_punch['company_out_lon'];
   
   
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $km = ($miles * 1.609344);
   
   
   @endphp
        {{ round($km, 3) }}km
        
    </td>
    <td>{{ $all_punch['duration'] }}</td>
    <td>{{ $all_punch['break'] }}</td>
    
</tr>
@endforeach
@if(!empty($data))
<tr>
    <td colspan="4"><b>Total Hours</b></td>
    <td><b>{{ $total_working_hr }}</b></td>
    <td><b>{{ $total_break_hr }}</b></td>
    
</tr>
@endif
@endforeach
</tbody>
</table>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop

