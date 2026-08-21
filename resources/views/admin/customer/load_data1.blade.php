<?php 
$today = date('Y-m-d');
?>
<thead>
<tr
    <!-- th>Image</th> -->
    <th width="10%" class="text-center">Worker ID</th>
    <th>Worker Name</th>
    <th style="text-align: center;">Today</th>
    <th style="text-align: center;">Last 7 Days</th>
    <th style="text-align: center;">Last 30 Days</th>
    <th class="text-center">Details</th>
</tr>
</thead>
<tbody>
<?php $index = 1;

  $user_id = today_worker();
?>

@foreach($data as $detail)
@php
$report = get_total_reports($detail->id);
if(in_array($detail->id, $user_id)){

@endphp

<tr id="order_{{ $detail->id }}">
    <!--<td> <img src="{!! asset($detail->profile_image) !!}"> </td> -->
    <td style="vertical-align: middle;" class="text-center">{!! $detail->unique_id !!}</td>
    <td style="vertical-align: middle;">{!! $detail->name !!}</td>
    <td style="text-align: center;">{{ $report['today_work'] }} (Work Hours) <br> {{ $report['today_break'] }} (Break Hours) </td>
    <td style="text-align: center;">{{ $report['week_work'] }} (Work Hours) <br> {{ $report['week_break'] }} (Break Hours)</td>
    <td style="text-align: center;">{{ $report['month_work'] }} (Work Hours) <br> {{ $report['month_break'] }} (Break Hours)</td>
    
    
    <td style="vertical-align: middle;" class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" href="{{ route('attendance', [$detail->id]) }}"><i class="fa fa-eye"></i></a>
    </td>  
  
</tr>
@php } @endphp
@endforeach

@foreach($data as $detail)
@php
$report = get_total_reports($detail->id);
if(in_array($detail->id, $user_id)){
} else {
@endphp

<tr id="order_{{ $detail->id }}">
    <!--<td> <img src="{!! asset($detail->profile_image) !!}"> </td> -->
    <td style="vertical-align: middle;" class="text-center">{!! $detail->unique_id !!}</td>
    <td style="vertical-align: middle;">{!! $detail->name !!}</td>
    <td style="text-align: center;">{{ $report['today_work'] }} (Work Hours) <br> {{ $report['today_break'] }} (Break Hours)</td>
    <td style="text-align: center;">{{ $report['week_work'] }} (Work Hours) <br> {{ $report['week_break'] }} (Break Hours)</td>
    <td style="text-align: center;">{{ $report['month_work'] }} (Work Hours) <br> {{ $report['month_break'] }} (Break Hours)</td>
    
    
    <td style="vertical-align: middle;" class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" href="{{ route('attendance', [$detail->id]) }}"><i class="fa fa-eye"></i></a>
    </td>  
  
</tr>
@php } @endphp
@endforeach


@if (count($data) < 1)
<tr>
    <td class="text-center" colspan="8"> {!! lang('messages.no_data_found') !!} </td>
</tr>
@else
<tr>
    <td colspan="10">
        {!! paginationControls($page, $total, $perPage) !!}
    </td>
</tr>
@endif
</tbody>