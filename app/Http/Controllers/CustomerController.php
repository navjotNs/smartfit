<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use App\Models\Company;
use App\Models\State;
use App\Models\Attendance;
use App\Models\Content;
use League\Flysystem\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Carbon\Carbon;

class CustomerController extends Controller {
   
    public function index() {
        return view('admin.customer.index');
    }

    public function content_view(){
        $result = Content::where('id', 1)->first();
        return view('admin.customer.content', compact('result'));
    }

    public function create()  {
        $countries = Country::select('id', 'name')->get();
        return view('admin.customer.create', compact('countries'));
    }

    public function construction_site_master($id = null){
        $users = User::where('status', 1)->where('user_type', 2)->select('id', 'name', 'unique_id')->get();
        $staff = User::where('status', 1)->where('company_id', $id)->pluck('id')->toArray();
        $company = Company::where('id', $id)->select('id', 'name')->first();

        return view('admin.customer.construction_site', compact('users', 'staff', 'company'));
    }

    public function save_construction_site_master(Request $request){
        try{

           User::Where('company_id', $request->id)->update(['company_id' => null]);
           if(isset($request->user_id)){
            foreach ($request->user_id as $user) {
               User::Where('id', $user)->update(['company_id' => $request->id]);
            }
           }

            return redirect()->route('company-master.index')
                ->with('success', lang('messages.updated', lang('Staff')));

        } catch (Exception $exception) {
           // dd($exception);
            return redirect()->route('company-master.index')
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }
    
    public function allotment(){
        
        $unalloted_users = User::where('company_id', null)->where('status', 1)->where('user_type', 2)->select('id', 'name', 'email', 'unique_id', 'mobile')->get();
        $company = Company::where('status', 1)->select('name', 'id')->get();
        $alloted_users = User::join('companies', 'companies.id', 'users.company_id')
              ->where('users.status', 1)
              ->where('companies.status', 1)
              ->select('users.id', 'users.name', 'users.unique_id', 'users.mobile', 'users.email', 'companies.id as company_id', 'companies.name as company')
              ->get();
        
        return view('admin.customer.allotment', compact('unalloted_users', 'company', 'alloted_users'));
    }
    
    public function update_content(request $request){
        try {
           
            $inputs = $request->all();
            $result = Content::where('id', 1)->select('landing_image', 'home_about_image')->first();
            if(isset($inputs['home_about_image']) or !empty($inputs['home_about_image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('home_about_image'))  {
                    $file = $request->file('home_about_image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->home_about_image;
            }
            unset($inputs['home_about_image']);
            $inputs['home_about_image'] = $image;
            
            if(isset($inputs['doctor_image']) or !empty($inputs['doctor_image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('doctor_image'))  {
                    $file = $request->file('doctor_image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->doctor_image;
            }
            unset($inputs['doctor_image']);
            $inputs['doctor_image'] = $image;
            
            if(isset($inputs['patient_image']) or !empty($inputs['patient_image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('patient_image'))  {
                    $file = $request->file('patient_image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->patient_image;
            }
            unset($inputs['patient_image']);
            $inputs['patient_image'] = $image;
            
            if(isset($inputs['landing_image']) or !empty($inputs['landing_image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('landing_image'))  {
                    $file = $request->file('landing_image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->landing_image;
            }
            unset($inputs['landing_image']);
            $inputs['landing_image'] = $image;
           
           (new Content)->store($inputs, 1);
           
           return back()->with('success', 'Successfully updated');
        } catch (Exception $exception) {
          //  dd($exception);
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        } 
    }
    
   public function all_reports(request $request){

    try {
     
         // $to = date('Y-m-d', strtotime($request['to']));
         // $from = date('Y-m-d', strtotime($request['from']));

          $users =  User::where('status', 1)->select('name')->get();

          \Excel::create('users', function($excel) use($users) {
            $excel->sheet('customer', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

        }
        catch (Exception $exception) {
            dd($exception);
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }

  }
    
    public function worker_reports(){
        
        try{
            $date = Date('Y-m-d');
            
            $attendance = \DB::table('attendance')
            ->join('companies', 'companies.id', '=','attendance.company_id')
            ->join('users', 'users.id', '=','attendance.user_id')
            ->whereRaw('date_format(attendance.created_at,"%Y-%m-%d")'."='".$date . "'")->select('attendance.created_at', 'users.id', 'users.name', 'companies.name as company')->get();
            
            return view('admin.customer.worker_reports', compact('attendance')); 
            
        }  catch (Exception $exception) {
           // dd($exception);
            return back();
        }
        
    }
    
    
    public function day_details($date, $id){
        
        try{
            
            $total_working_hr = 0;
            
            $posts = Attendance::latest()->where('user_id', $id)->whereRaw('date_format(created_at,"%Y-%m-%d")'."='".$date . "'")
            ->get()->groupBy(function($item)
            {
              return $item->created_at->format('d-M-y');
            });
          
            $data = [];
            $today = 0;
            $total_work_hr = 0;
            $total_break_hr = 0;
            foreach($posts as $post){
            
            $totalb_min = 0;
            $br_min = 0;
            $hr_min = 0;
            $working_hr = 0;
            $working_min = 0;
                    
                    $date = date('Y-m-d', strtotime($post[0]->created_at));
                    $report['date'] = date('d M, Y', strtotime($post[0]->created_at));
                    
                    $one_day = Attendance::where('user_id', $id)->whereRaw('date_format(created_at,"%Y-%m-%d")'."='".$date . "'")->get();
                    
                    $i = 0;
                    $configure = array();
                    foreach($one_day as $day){
                      
                    if($i == 0 || $i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14 || $i == 16 || $i == 18 || $i == 20 || $i == 22 || $i == 24) {
                       
                        $dt = new DateTime($day->created_at);
                        $tz = new \DateTimeZone('Asia/Kolkata'); 
                        $dt->setTimezone($tz);
                        $punch_in = $dt->format('Y-m-d H:i:s');
                        $punch_in_lat = $day->latitude;
                        $punch_in_lon = $day->longitude;
                        $company = Company::where('id', $day->company_id)->select('name', 'shift_start_time', 'latitude', 'shift_end_time', 'longitude')->first();
                        
                        
                        
                    } else {
                        
                        $day_start = date('Y-m-d', strtotime($day->created_at));
                        if(isset($company)){
                        $current_day = $day_start.' '.$company->shift_start_time.':00';
                        $current_day_end = $day_start.' '.$company->shift_end_time.':00';
                        } else {
                            $current_day = date('Y-m-d H:i:s', strtotime($day->created_at));
                        }
                        
                        if($i == 1){
                        $shift_start = date('Y-m-d H:i:s', strtotime($current_day));
                        $shift_end = date('Y-m-d H:i:s', strtotime($current_day_end));
                        
                        $shift_start_time = new Carbon($shift_start);
                        
                        $break_hr = $shift_start_time->diff($punch_in)->format('%H');
                        $break_min = $shift_start_time->diff($punch_in)->format('%I');
                        
                        } else {
                            
                            $shift_end = date('Y-m-d H:i:s', strtotime($current_day_end));
                        if(isset($punch_out)) {   
                        $punch_in_in  = new Carbon($punch_in);
                        $punch_out_out    = new Carbon($punch_out);
                            
                        $break_hr = $punch_out_out->diff($punch_in_in)->format('%H');
                        $break_min = $punch_out_out->diff($punch_in)->format('%I');
                        }
                            
                        }
                        
                        
                        $dt = new DateTime($day->created_at);
                        $tz = new \DateTimeZone('Asia/Kolkata'); 
                        $dt->setTimezone($tz);
                        $punch_out = $dt->format('Y-m-d H:i:s');
                        
                        $detail['in'] = date('H:i:s', strtotime($punch_in));
                        $detail['out'] = date('H:i:s', strtotime($punch_out));
                        
                        $detail['punch_in_lat'] = $punch_in_lat;
                        $detail['punch_in_lon'] = $punch_in_lon; 
                        
                        $detail['company_in_lat'] = $company->latitude;
                        $detail['company_in_lon'] = $company->longitude;
                        $company_out = Company::where('id', $day->company_id)->select('latitude', 'longitude')->first();
                        
                        $detail['company_out_lat'] = $company_out->latitude;
                        $detail['company_out_lon'] = $company_out->longitude;
                        
                        $detail['punch_out_lat'] = $day->latitude;
                        $detail['punch_out_lon'] = $day->longitude;
                        
                        $start  = new Carbon($punch_in);
                        $end    = new Carbon($punch_out);
                        
                        $working_hr = $start->diff($end)->format('%H');
                        $working_min = $start->diff($end)->format('%I');
                        
                        $hr_min = $working_hr*60;
                        $total_min = $hr_min + $working_min;
                        $total_work_hr += $total_min;
                        $detail['duration'] = floor($total_min / 60).'h '.($total_min -   floor($total_min / 60) * 60).'m';
                        if(isset($break_hr)){
                        $br_min = $break_hr*60;
                        $totalb_min = $br_min + $break_min;
                        $total_break_hr += $totalb_min;
                        $detail['break'] = floor($totalb_min / 60).'h '.($totalb_min -   floor($totalb_min / 60) * 60).'m';
                        }
                      //  $detail['company'] =  $company->name;
                        
                        $detail['company'] =  $company->name;
                        $detail['shift_start_time'] =  $company->shift_start_time;
                        $detail['shift_end_time'] =  $company->shift_end_time;
                        $detail['latitude'] =  $company->latitude;
                        $detail['longitude'] =  $company->longitude;
                        
                            $configure[]  = $detail;
                              
                        
                    }  
                        
                    // dd($day);   
                     
                     
                        
                    $i++;
                    
                    }
                    
                    if(isset($shift_end)){
                    if(isset($shift_start)){    
                    $shift_end1  = new Carbon($shift_end);
                    $shift_start1    = new Carbon($shift_start);
                    
                    
                    $shift_hr = $shift_start1->diff($shift_end1)->format('%H');
                    $shift_min = $shift_start1->diff($shift_end1)->format('%I');
                    
                    $shift_hr_mins = $shift_hr*60;
                   // $totals_min = $shift_hr_mins + $shift_min;
                    $total_working_hr = floor($total_work_hr / 60).'h '.($total_work_hr -   floor($total_work_hr / 60) * 60).'m';
                    $total_break_hr = floor($total_break_hr / 60).'h '.($total_break_hr -   floor($total_break_hr / 60) * 60).'m';
                    
                    }
                    }
                    
                  
                    
                // dd($total_break_hr);
                    
                  //  $report['total_working_hr'] = $working_days*$total_working_hr;
                
                   $report['all_punch']  = $configure;
                    $data[] = $report;
                   
                    
                           
            }
               
           // dd($data); 
           $user = User::where('id', $id)->select('id', 'name', 'unique_id')->first(); 
            
            return view('admin.customer.single_day', compact('data', 'user', 'total_working_hr', 'total_break_hr'));  
            
            
        }  catch (Exception $exception) {
           // dd($exception);
            return back();
        }
        
        
    }
    
    
    public function attendance(Request $request, $id = null){
        
        try{
            
            if(isset($request->from_date)){
                $from_date = $request->from_date;
                $to_date = $request->to_date;
            } else {
                $from_date = date('Y-m-d', strtotime('-29 days'));
                $to_date = date('Y-m-d');
            }
            
            
             $posts = Attendance::latest()->where('user_id', $id)->whereRaw('date_format(created_at,"%Y-%m-%d")'.">='".$from_date . "'")
            ->whereRaw('date_format(created_at,"%Y-%m-%d")'."<='".$to_date . "'")->get()->groupBy(function($item)
            {
              return $item->created_at->format('d-M-y');
            });
          
            $data = [];
            $today = 0;
            
            foreach($posts as $post){
                
            $total_work_hr = 0;
            $total_break_hr = 0;
            $totalb_min = 0;
            $br_min = 0;
            $hr_min = 0;
            $working_hr = 0;
            $working_min = 0;
                    
                    $date = date('Y-m-d', strtotime($post[0]->created_at));
                    $report['date'] = date('d M, Y', strtotime($post[0]->created_at));
                    $report['day'] = date('Y-m-d', strtotime($post[0]->created_at));
                    
                    $one_day = Attendance::where('user_id', $id)->whereRaw('date_format(created_at,"%Y-%m-%d")'."='".$date . "'")->get();
                    
                    $i = 0;
                    $configure = array();
                    $total_working_hr = 0;
                    foreach($one_day as $day){
                      
                    if($i == 0 || $i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14 || $i == 16 || $i == 18 || $i == 20 || $i == 22 || $i == 24) {
                       
                        $dt = new DateTime($day->created_at);
                        $tz = new \DateTimeZone('Asia/Kolkata'); 
                        $dt->setTimezone($tz);
                        $punch_in = $dt->format('Y-m-d H:i:s');
                        $company = Company::where('id', $day->company_id)->select('name', 'shift_start_time', 'shift_end_time', 'latitude', 'longitude')->first();
                        
                        
                        
                    } else {
                        
                        $day_start = date('Y-m-d', strtotime($day->created_at));
                        if(isset($company)){
                        $current_day = $day_start.' '.$company->shift_start_time.':00';
                        $current_day_end = $day_start.' '.$company->shift_end_time.':00';
                        } else {
                            $current_day = date('Y-m-d H:i:s', strtotime($day->created_at));
                        }
                        
                        if($i == 1){
                        $shift_start = date('Y-m-d H:i:s', strtotime($current_day));
                        $shift_end = date('Y-m-d H:i:s', strtotime($current_day_end));
                        
                        $shift_start_time = new Carbon($shift_start);
                        
                        $break_hr = $shift_start_time->diff($punch_in)->format('%H');
                        $break_min = $shift_start_time->diff($punch_in)->format('%I');
                        
                        } else {
                            
                            $shift_end = date('Y-m-d H:i:s', strtotime($current_day_end));
                        if(isset($punch_out)) {   
                        $punch_in_in  = new Carbon($punch_in);
                        $punch_out_out    = new Carbon($punch_out);
                            
                        $break_hr = $punch_out_out->diff($punch_in_in)->format('%H');
                        $break_min = $punch_out_out->diff($punch_in)->format('%I');
                        }
                            
                        }
                        
                        
                        $dt = new DateTime($day->created_at);
                        $tz = new \DateTimeZone('Asia/Kolkata'); 
                        $dt->setTimezone($tz);
                        $punch_out = $dt->format('Y-m-d H:i:s');
                        
                       // $detail['in'] = date('H:i:s', strtotime($punch_in));
                       // $detail['out'] = date('H:i:s', strtotime($punch_out));
                        
                        $start  = new Carbon($punch_in);
                        $end    = new Carbon($punch_out);
                        
                        $working_hr = $start->diff($end)->format('%H');
                        $working_min = $start->diff($end)->format('%I');
                        
                        $hr_min = $working_hr*60;
                        $total_min = $hr_min + $working_min;
                        $total_work_hr += $total_min;
                       // $detail['duration'] = floor($total_min / 60).':'.($total_min -   floor($total_min / 60) * 60);
                    if(isset($break_hr)){    
                        $br_min = $break_hr*60;
                        $totalb_min = $br_min + $break_min;
                        $total_break_hr += $totalb_min;
                    }
                       // $detail['break'] = floor($totalb_min / 60).':'.($totalb_min -   floor($totalb_min / 60) * 60);
                        
                      //  $detail['company'] =  $company->name;
                          //  $configure[]  = $detail;
                        
                    }  
                        
                    $report['company'] =  $company->name;
                    $report['shift_start_time'] =  $company->shift_start_time;
                    $report['shift_end_time'] =  $company->shift_end_time;
                    $report['latitude'] =  $company->latitude;
                    $report['longitude'] =  $company->longitude;
                    
                    $i++;
                    
                    }
                    
                    if(isset($shift_end)){
                    if(isset($shift_start)){    
                    $shift_end1  = new Carbon($shift_end);
                    $shift_start1    = new Carbon($shift_start);
                    
                    
                    $shift_hr = $shift_start1->diff($shift_end1)->format('%H');
                    $shift_min = $shift_start1->diff($shift_end1)->format('%I');
                    
                    $shift_hr_mins = $shift_hr*60;
                    $totals_min = $shift_hr_mins + $shift_min;
                    $total_working_hr = floor($totals_min / 60).'.'.($totals_min -   floor($totals_min / 60) * 60);
                    }
                    }
                    
                    $datediff = strtotime($request->to_date) - strtotime($request->from_date);
                    
                    $working_days = round($datediff / (60 * 60 * 24));
                    
                    $report['total_working_hr'] = floor($total_work_hr / 60).'h '.($total_work_hr -   floor($total_work_hr / 60) * 60).'m';
                    $report['total_break_hr'] = floor($total_break_hr / 60).'h '.($total_break_hr -   floor($total_break_hr / 60) * 60).'m';
                
                  // $report['all_punch']  = $configure;
                    $data[] = $report;
                   
                           
            }
               //$data = $data;
            $user = User::where('id', $id)->select('id', 'name', 'unique_id')->first();       
           // dd($data);
           
          //dd($request);
               
            return view('admin.customer.single_reports', compact('data', 'user', 'request'));        
            
            
            
        }  catch (Exception $exception) {
           // dd($exception);
            return back();
        }
        
    }
    
    public function allot_emp(Request $request){
        try{
            $inputs = $request->all(); 
            $validator = (new User)->validate_allot($inputs);
            if ($validator->fails()) {
                return redirect()->route('allotment')
                ->withInput()->withErrors($validator);
            }
            foreach($request->worker as $worker){
                User::where('id', $worker)
                ->update([
                     'company_id' =>  $request->company_id,
                ]);
            }
            return back()->with('allot_sub', lang('messages.created', lang('comment_sub')));
        }  catch (Exception $exception) {
           // dd($exception);
            return back();
        }
    }
    
    public function reports(){
        
        try{
            
           // $workers = User::where('user_type', 2)->where('status', 1)->select('name', 'profile_image', 'unique_id')->paginate(20)
            
         
         return view('admin.customer.reports');
            
        }  catch (Exception $exception) {
           // dd($exception);
            return back();
        }
        
    }
    
    
    
    public function RemoveAll(Request $request){
        try{
                User::where('status', 1)->update([
                     'company_id' =>  null,
                ]);
                
                $data= 'deleted';
            return $data;
        }  catch (Exception $exception) {
           // dd($exception);
            return back();
        }
    }
    
    public function RemoveSelected(Request $request){
        
        foreach ($request->emp_id as $key => $value) {
            
            User::where('id', $value)
          ->update([
            'company_id' =>  null,
      ]);
            
        }
        
        $message = 'successfully';
        
        return $message;
    }
    
    public function getCompanyEmp(Request $request){
        
        $company_id = $request->main_id;
        
        if($company_id == 0){
            $alloted_users = User::join('companies', 'companies.id', 'users.company_id')
              ->where('users.status', 1)
              ->where('companies.status', 1)
              ->select('users.id', 'users.name', 'users.unique_id', 'users.mobile', 'users.email', 'companies.id as company_id', 'companies.name as company')
              ->get();
        } else {
            
            $alloted_users = User::join('companies', 'companies.id', 'users.company_id')
              ->where('users.status', 1)
              ->where('users.company_id', $company_id)
              ->where('companies.status', 1)
              ->select('users.id', 'users.name', 'users.unique_id', 'users.mobile', 'users.email', 'companies.id as company_id', 'companies.name as company')
              ->get();
        }
        
        // $tableList ='';
        // $tableList .='<tr>    
        //                 <th> </th> 
        //                 <th style="text-align:left;">ID</th> 
        //                 <th style="text-align:left;">Worker Name</th> 
        //                 <th style="text-align:left;">Email</th> 
        //                 <th style="text-align:left;">Mobile</th> 
        //                 </tr>';
        // foreach($alloted_users as $alloted_user){
            
        //     $tableList .='<tr>
        //                                 <td><input type="checkbox" class="unallot_id" name="unallot_id[]" value="'.$alloted_user->id.'></td>
        //                                 <td>'.$alloted_user->unique_id.'</td>
        //                                 <td>'.$alloted_user->name.'</td>
        //                                 <td>'.$alloted_user->email.'</td>
        //                                 <td>'.$alloted_user->mobile.'</td>
        //                             </tr>';  
            
        // }
       // dd($tableList);
        //return $tableList;
        
        return view('admin.customer.table', compact('alloted_users'));
        
    }

    public function getState(Request $request)
    {
      $main_id = $request->main_id;
      $category = \DB::table('states')->where('country_id', $main_id)->select('name', 'id')->get();
      $subcategoryList='';
      $subcategoryList .= '<option value="">select</option>';
      foreach($category as $key => $subcategory)
      $subcategoryList .= '<option value="' . $subcategory->id . '">'. $subcategory->name .'</option>';
      return $subcategoryList; 
    }

    public function getCity(Request $request)
    {
      $main_id = $request->main_id;
      $category = \DB::table('cities')->where('state_id', $main_id)->select('name', 'id')->get();
      $subcategoryList='';
      $subcategoryList .= '<option value="">select</option>';
      foreach($category as $key => $subcategory)
      $subcategoryList .= '<option value="' . $subcategory->id . '">'. $subcategory->name .'</option>';
      return $subcategoryList; 
    }


    


    public function store( Request $request ){

        $request['unique_id'] = mt_rand(100000,999999);
        $inputs = $request->all(); 

        $validator = (new User)->validate($inputs);
        if ($validator->fails()) {
            return redirect()->route('customer.create')
            ->withInput()->withErrors($validator);
        }            
        
        try{

            $pwd = $inputs['password'];
            $password = \Hash::make($inputs['password']);
            unset($inputs['password']);
            $inputs = $inputs + ['password' => $password];
            // Generating API key

            $name = $request->first_name .' '. $request->last_name;
            $remember_token = $this->generateTokenKey();
            $inputs = $inputs + [
                                  'remember_token'  => $remember_token,
                                  'name'  => $name,
                                  'created_by'  => authUserId()
                                ];

            $user_id = (new User)->store($inputs);  
            $useremail = $request->email;

            // Mail::send('user_register',['name' => $name,'email'=> $request->email, 
            //     'password'=>$pwd], function ($message) use ($request, $useremail, $name, $pwd){
            //     $message->from('no-reply@gmail.com', 'Chelsea Construction Company');
            //     $message->to( $useremail);
            //     $message->subject("account successfully created");
            // }); 
            $data['name'] = $name;
            $data['mobile'] = $request->mobile;
            $data['password'] = $pwd;


            \Mail::send('email.user_register', $data, function($message) use ($useremail){
                $message->from('no-reply@chelsea.com');
                $message->to($useremail);
                $message->subject('Chelsea - account successfully created');
            }); 

        
            return view('admin.customer.index')
                ->with('success', lang('messages.created', lang('Worker')));
          
          
        }
        catch (Exception $exception) {
         //   dd($exception);
            return redirect()->route('customer.create')
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

 
    public function update(Request $request, $id = null)
    {
        $result = User::find($id);
        $user_type = $result->user_type;

        if (!$result) {

            return redirect()->route('customer.index')
                ->with('error', lang('messages.invalid_id', string_manip(lang('customer.customer'))));
        }

        $inputs = $request->all();
        $validator = (new User)->validate_update($inputs, $id);
        if ($validator->fails()) {
            return redirect()->route('customer.edit',[$id])
            ->withInput()->withErrors($validator);
        } 

        try {
             
             $name = $request->first_name .' '. $request->last_name;
             $inputs = $inputs + [
                'name'  => $name,
                'updated_by'=> authUserId()
              ];
          
            (new User)->store($inputs, $id); 

          return redirect()->route('customer')
                ->with('success', lang('messages.updated', lang('customer.customer')));
      
        } catch (\Exception $exception) {

        //  dd($exception);

            return redirect()->route('customer.edit',[$id])
                ->with('error', lang('messages.server_error'));
 
        }
    }
    
    public function employee_attendance_list(Request $request, $id = null){
        
        try{
            $posts = Attendance::latest()->get()->groupBy(function($item)
            {
              return $item->created_at->format('d-M-y');
            });
            
           // dd( $posts);
            
            $user = User::where('id', $id)->select('name', 'mobile', 'unique_id')->first();
            
            
            return view('admin.customer.attendance', compact('user', 'posts', 'id'));
            
        } catch (\Exception $exception) {

        //  dd($exception);

            return redirect()->route('customer.edit',[$id])
                ->with('error', lang('messages.server_error'));
 
        }
        
    }

    private function generateTokenKey() {
        return md5(uniqid(rand(), true));
    }

    public function edit($id = null) {
        $result = User::find($id);
        if (!$result) {
            abort(404);
        }
        
        $countries = Country::select('id', 'name')->get();
        $state_list = \DB::table('states')->where('country_id', $result->country_id)->get();
        $city_list = \DB::table('cities')->where('state_id', $result->state_id)->get();
   

       if(((\Auth::user()->user_type)) == 1){
         return view('admin.customer.create', compact('result', 'countries', 'state_list', 'city_list'));
      } else {
        echo "404";
      }

    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new User)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new User)->find($id);
             if($result->status == 1) {
                 $response = ['status' => 0, 'message' => lang('user.user_in_use')];
             }
             else {
                 (new User)->tempDelete($id);
                 $response = ['status' => 1, 'message' => lang('messages.deleted', lang('user.user'))];
             }
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    
    public function getUserDetail() {
        try {
            if(\Auth::check()) {

                $user =User::where('id',\Auth::user()->id)->first();
                if( $user){
                    
                    return apiResponse(true, 200 , null, [], $user);
                }
                return apiResponse(false, 404, lang('messages.not_found', lang('user.user')));
            }
            else {
                return apiResponse(false, 404, lang('auth.customer_not_accessible'));
            }
        }
        catch (Exception $exception) {
            \DB::rollBack();
            return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

 
    public function changePwd(Request $request)
    {
        try {
            $id=\Auth::user()->id;
            \DB::beginTransaction();
            /* FIND WHETHER THE USER EXISTS OR NOT */
            $user = User::find($id);
            if(!$user) {
                return apiResponse(false, 404, lang('messages.not_found', lang('user.user')));
            }
            $inputs = $request->all();
            $rules = [
                    'password' => 'required',
                    'new_password'=>'required|min:6'
                    ];
            $validator=\Validator::make($inputs, $rules);
            if ($validator->fails()) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
      
                if (!\Hash::check($inputs['password'], \Auth::user()->password) ){
                    return apiResponse(false, 406,lang('user.password_not_match'));
                }

                $password = \Hash::make($inputs['new_password']);
                unset($inputs['password']);
                $inputs = $inputs + ['password' => $password];
                
                (new User)->store($inputs, $id);
                \DB::commit();
                return apiResponse(true, 200, lang('messages.updated', lang('user.user')));
           
        }
        catch (Exception $exception) {
            \DB::rollBack();
            return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

 
    public function customerPaginate(Request $request, $id, $pageNumber = null)
    {

        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);

            $data = (new User)->getCustomer($inputs, $start, $perPage);
            $totalGameMaster = (new User)->totalCustomer($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new User)->getCustomer($inputs, $start, $perPage, $id);
            $totalGameMaster = (new User)->totalCustomer();
            $total = $totalGameMaster->total;
        }

        return view('admin.customer.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }
    
    
    
    public function workerPaginate(Request $request, $id, $pageNumber = null)
    {

        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);

            $data = (new User)->getCustomer1($inputs, $start, $perPage);
            $totalGameMaster = (new User)->totalCustomer1($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new User)->getCustomer1($inputs, $start, $perPage, $id);
            $totalGameMaster = (new User)->totalCustomer1();
            $total = $totalGameMaster->total;
        }

        return view('admin.customer.load_data1', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    // Dealer Pagination Start

     public function customerPaginate_dealer(Request $request, $id, $pageNumber = null)
    {

        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);

            $data = (new Dealer)->getCustomer($inputs, $start, $perPage);
            $totalGameMaster = (new Dealer)->totalCustomer($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new Dealer)->getCustomer($inputs, $start, $perPage, $id);
            $totalGameMaster = (new Dealer)->totalCustomer();
            $total = $totalGameMaster->total;
        }

        return view('admin.customer.load_data1', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    // Dealer Pagination End


    // Data Entry Pagination Start

     public function customerPaginate_data_entry(Request $request, $id, $pageNumber = null)
    {

        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);

            $data = (new User)->getAdmin($inputs, $start, $perPage);
            $totalGameMaster = (new User)->totalAdmin($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new User)->getAdmin($inputs, $start, $perPage, $id);
            $totalGameMaster = (new User)->totalAdmin();
            $total = $totalGameMaster->total;
        }

        return view('admin.customer.load_data1', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    // Data Entry Pagination End



    /**
     * code for toggle - financial year status
     * @param null $id
     * @return string
     */

    public function customerToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = User::find($id);
            //dd($game);



        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Order')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
 

        // return json response
        return json_encode($response);
    }

    /**
     * Method is used to update status of group enable/disable
     *
     * @return \Illuminate\Http\Response
     */
    public function customerAction(Request $request)
    {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            // return redirect()->route('customer.index')
             return view('admin.customer.index')->with('error', lang('messages.atleast_one', string_manip(lang('customer.customer'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        User::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('customer.index')
            ->with('success', lang('messages.updated', lang('game_master.game')));
    }
    
    
    public function workerAction(Request $request)
    {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            // return redirect()->route('customer.index')
             return view('admin.customer.reports')->with('error', lang('messages.atleast_one', string_manip(lang('worker'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        User::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('reports')
            ->with('success', lang('messages.updated', lang('game_master.game')));
    }


    public function customerAction_data_entry(Request $request)
    {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            // return redirect()->route('customer.index')
             return view('admin.customer.admin')->with('error', lang('messages.atleast_one', string_manip(lang('customer.customer'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        User::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('admin_users')
            ->with('success', lang('messages.updated', lang('game_master.game')));
    }
    

     public function customerRecord(request $request){

    try {
     
      $inputs = $request->all();
      $validator = (new User)->recordvalidate($inputs);
          if( $validator->fails() ) {
              return back()->withErrors($validator)->withInput();
          }
          $to = date('Y-m-d', strtotime($request['to']));
          $from = date('Y-m-d', strtotime($request['from']));

         // $data['orders'] =  User::whereRaw('date_format(users.created_at,"%Y-%m-%d")'.">='".$from . "'")
         //    ->whereRaw('date_format(users.created_at,"%Y-%m-%d")'."<='".$to . "'")->select('name', 'email', 'mobile')->get();
         // $pdf = \PDF::loadView('pdf.user', $data);
         //  return $pdf->download('user.pdf'); 

          $users =  User::whereRaw('date_format(users.created_at,"%Y-%m-%d")'.">='".$from . "'")
            ->whereRaw('date_format(users.created_at,"%Y-%m-%d")'."<='".$to . "'")->select('name', 'email', 'mobile', 'status', 'created_at')->get();

          \Excel::create('users', function($excel) use($users) {
            $excel->sheet('customer', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Email',
                'Mobile',
                'Status',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                $value->email,
                $value->mobile,
                $value->status  == 1 ? 'Active' : 'Inactive',
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

        }
        catch (Exception $exception) {
           // dd($exception);
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }

  }


  public function export_users(){
     
     try{
          $users = User::Orderby('created_at', 'desc')->where('id', '!=', 1)->get();
        

            \Excel::create('users', function($excel) use($users) {
            $excel->sheet('customer', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Email',
                'Mobile',
                'Status',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                $value->email,
                $value->mobile,
                $value->status  == 1 ? 'Active' : 'Inactive',
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }


 public function export_tax(){
     
     try{
          $users = Tax::Orderby('created_at', 'desc')->get();
        

            \Excel::create('tax', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Value',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                $value->value,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }

 public function export_brand(){
 
     try{
          $users = Brand::Orderby('created_at', 'desc')->get();
        

            \Excel::create('brand', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }


 }

public function export_size(){
 
     try{
          $users = Size::Orderby('created_at', 'desc')->get();
        

            \Excel::create('size', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Size',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->size,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }


public function export_category(){
 
     try{
          $users = Category::Orderby('created_at', 'desc')->get();
        

            \Excel::create('category', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }
 


public function export_style(){
 
     try{
          $users = Style::Orderby('created_at', 'desc')->get();
        

            \Excel::create('style', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->style,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }

 

public function export_order(){
 
     try{
          $users = \DB::table('orders')
            ->join('order_statuses', 'order_statuses.id' ,'=', 'orders.current_status')
            ->join('users', 'users.id' ,'=', 'orders.user_id')
            ->select('orders.id','orders.user_id', 'orders.order_nr', 'orders.total_price', 'orders.wallet_paid',
             'orders.payment_method','orders.current_status', 'orders.status',
            'order_statuses.type as current_status','users.name as user_name', 'orders.created_at')
            ->Orderby('orders.created_at', 'desc')
            ->get();
        

            \Excel::create('orders', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Order No.',
                'Price',
                'Status',
                'Payment Method',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->user_name,
                $value->order_nr,
                $value->total_price,
                $value->current_status,
                $value->payment_method,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }



public function export_manufacture(){
 
     try{
          $users = Manufacture::Orderby('created_at', 'desc')->get();
        

            \Excel::create('manufacture', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }



public function export_reserve(){
 
     try{

          $users= \DB::table('reserves')
          ->join('products', 'reserves.product_id', '=','products.id')
          ->select('products.name as product','reserves.*')
          ->get();
        

            \Excel::create('reserve', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Product',
                'Email',
                'Phone',
                'Reserve Id',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                $value->product,
                $value->email,
                $value->mobile,
                $value->reserve_id,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }



public function export_color(){
 
     try{
          $users = Color::Orderby('created_at', 'desc')->get();
        

            \Excel::create('color', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->name,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }



 public function export_enquiry(){
     
     try{
          $users = Contact::Orderby('created_at', 'desc')->get();
        

            \Excel::create('enquiry', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Name',
                'Email',
                'Mobile',
                'Subject',
                'Message',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->first_name,
                $value->email,
                $value->phone,
                $value->subject,
                $value->message,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

 }

public function exportSubscribe(){

   try{
          $users = Subscriber::Orderby('created_at', 'desc')->get();
        

            \Excel::create('subscribe', function($excel) use($users) {
            $excel->sheet('contact', function($sheet) use($users) {
                $excelData = [];
                $excelData[] = [
                'Email',
                'Created At',
                ];
                foreach ($users as $key => $value) {
                $excelData[] = [
                $value->email,
                date("M d Y", strtotime($value->created_at)),
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');

     } catch(Exception $exc){
     // dd($exc);

       $response = ['status' => 0, 'message' => lang('messages.server_error')];

     }

}



   
}