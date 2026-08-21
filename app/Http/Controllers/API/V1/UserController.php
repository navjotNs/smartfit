<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserDevice;
use App\Models\Company;
use App\Models\Attendance;
use ElfSundae\Laravel\Hashid\Facades\Hashid;
use App\Models\Notify;
use App\Models\SmsCode;
use App\Models\ForceUpdate;
use Auth;
use Ixudra\Curl\Facades\Curl;
use PDF;
use DateTime;
use Carbon\Carbon;


class UserController extends Controller
{
    
    public function changePassword(Request $request){
      try {
           
          if($request->api_token){
            $inputs = $request->all();
            $user = User::where('api_token', $request->api_token)->select('id', 'password')->first();
            $password = \Hash::make($inputs['password']);  
            $old_password = \Hash::make($inputs['old_password']);

            if (!\Hash::check($request->old_password, $user->password)){

            $message = "Old password not match";
            return apiResponseAppmsg(false, 200, $message, null, null);


            } else {
              $id = $user->id;
              unset($inputs['password']);
              $inputs = $inputs + ['password' => $password];
              (new User)->store($inputs, $id);

              $message = "Password successfully Changed";
              return apiResponseAppmsg(true, 200, $message, null, null);
           }  

          }

      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
    
    public function reports1(Request $request){
        try {
            
            $users = User::where('api_token', $request->api_token)->select('id', 'company_id')->first();
            if(!empty($users)){
                
            $date = date('Y-m-d');    
            
            $posts = Attendance::latest()->where('user_id', $users->id)->whereRaw('date_format(created_at,"%Y-%m-%d")'."='".$date . "'")->get()->groupBy(function($item)
            {
              return $item->created_at->format('d-M-y');
            });
            $data = [];
            $today = 0;
            foreach($posts as $post){
                    $report = get_emp_attendance($users->id, $post[0]->created_at);
                    
                    $slide['date'] = date('d M, Y', strtotime($post[0]->created_at));
                    $slide['work'] = $report[0];
                    $slide['break'] =  $report[2];
                    $today = $slide;                              
            }
            $data['today'] = $today;
            
            $weak_date = date('Y-m-d', strtotime('-6 days'));
            
            $posts = Attendance::latest()->where('user_id', $users->id)->whereRaw('date_format(created_at,"%Y-%m-%d")'.">='".$weak_date . "'")->get()->groupBy(function($item)
            {
              return $item->created_at->format('d-M-y');
            });
            $whr = 0;
            $wmin = 0;
            $bhr = 0;
            $bmin = 0;
            
            foreach($posts as $post){
                    $report = get_emp_attendance($users->id, $post[0]->created_at);
                    
                  //  $slide['date'] = date('d M, Y', strtotime($post[0]->created_at));
                  
                    $whr += $report[3];
                    $wmin += $report[4];
                    
                    $bhr +=  $report[5];
                    $bmin +=  $report[6];
                                                  
            }
            
            
            $hours = floor($wmin / 60).':'.($wmin -   floor($wmin / 60) * 60);
            
            dd($whr);
            
            
            return apiResponseApp(true, 200, null, null, $data);
            //dd($posts);
            
            
            }  
            
        }  catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
        }
        
    }
    
    public function reports(Request $request){
        try {
            
            $users = User::where('api_token', $request->api_token)->select('id', 'company_id')->first();
            if(!empty($users)){
                
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            
            $posts = Attendance::latest()->where('user_id', $users->id)->whereRaw('date_format(created_at,"%Y-%m-%d")'.">='".$from_date . "'")
            ->whereRaw('date_format(created_at,"%Y-%m-%d")'."<='".$to_date . "'")->get()->groupBy(function($item)
            {
              return $item->created_at->format('d-M-y');
            });
          
            $data = [];
            $today = 0;
            $total_work_hr = 0;
            $total_break_hr = 0;
            foreach($posts as $post){
                    
                    $date = date('Y-m-d', strtotime($post[0]->created_at));
                    $report['date'] = date('d M, Y', strtotime($post[0]->created_at));
                    
                    $one_day = Attendance::where('user_id', $users->id)->whereRaw('date_format(created_at,"%Y-%m-%d")'."='".$date . "'")->get();
                    
                    $i = 0;
                    $configure = array();
                    foreach($one_day as $day){
                      
                    if($i == 0 || $i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $i == 12 || $i == 14 || $i == 16 || $i == 18 || $i == 20 || $i == 22 || $i == 24) {
                       
                        $dt = new DateTime($day->created_at);
                        $tz = new \DateTimeZone('Asia/Kolkata'); 
                        $dt->setTimezone($tz);
                        $punch_in = $dt->format('Y-m-d H:i:s');
                        $company = Company::where('id', $day->company_id)->select('name', 'shift_start_time')->first();
                        
                        
                        
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
                            
                        $punch_in_in  = new Carbon($punch_in);
                        $punch_out_out    = new Carbon($punch_out);
                            
                        $break_hr = $punch_out_out->diff($punch_in_in)->format('%H');
                        $break_min = $punch_out_out->diff($punch_in)->format('%I');
                            
                        }
                        
                        
                        $dt = new DateTime($day->created_at);
                        $tz = new \DateTimeZone('Asia/Kolkata'); 
                        $dt->setTimezone($tz);
                        $punch_out = $dt->format('Y-m-d H:i:s');
                        
                        $detail['in'] = date('H:i:s', strtotime($punch_in));
                        $detail['out'] = date('H:i:s', strtotime($punch_out));
                        
                        $start  = new Carbon($punch_in);
                        $end    = new Carbon($punch_out);
                        
                        $working_hr = $start->diff($end)->format('%H');
                        $working_min = $start->diff($end)->format('%I');
                        
                        $hr_min = $working_hr*60;
                        $total_min = $hr_min + $working_min;
                        $total_work_hr += $total_min;
                        $detail['duration'] = floor($total_min / 60).':'.($total_min -   floor($total_min / 60) * 60);
                        
                        $br_min = $break_hr*60;
                        $totalb_min = $br_min + $break_min;
                        $total_break_hr += $totalb_min;
                        $detail['break'] = floor($totalb_min / 60).':'.($totalb_min -   floor($totalb_min / 60) * 60);
                        
                        $detail['company'] =  $company->name;
                            $configure[]  = $detail;
                        
                    }  
                        
                    // dd($day);   
                     
                     
                        
                    $i++;
                    
                    }
                    
                    if(isset($shift_end)){
                    $shift_end1  = new Carbon($shift_end);
                    $shift_start1    = new Carbon($shift_start);
                    
                    
                    $shift_hr = $shift_start1->diff($shift_end1)->format('%H');
                    $shift_min = $shift_start1->diff($shift_end1)->format('%I');
                    
                    $shift_hr_mins = $shift_hr*60;
                    $totals_min = $shift_hr_mins + $shift_min;
                    $total_working_hr = floor($totals_min / 60).'.'.($totals_min -   floor($totals_min / 60) * 60);
                    }
                    
                    $datediff = strtotime($request->to_date) - strtotime($request->from_date);
                    
                    $working_days = round($datediff / (60 * 60 * 24));
                    
                 //   dd($total_working_hr);
                    
                  //  $report['total_working_hr'] = $working_days*$total_working_hr;
                
                   $report['all_punch']  = $configure;
                    $data[] = $report;
                   
                    
                           
            }
               
            
               $total_working_hr = floor($total_work_hr / 60).':'.($total_work_hr -   floor($total_work_hr / 60) * 60);
               $total_break_hr = floor($total_break_hr / 60).':'.($total_break_hr -   floor($total_break_hr / 60) * 60);
                    
                    
            
            
            return apiResponseApp_br(true, 200, $total_working_hr, $total_break_hr, $data);
            //dd($posts);
            
            
            }  
            
        }  catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
        }
        
    }
 
    public function punch(Request $request){
      try{
        $users = User::where('api_token', $request->api_token)->select('id', 'company_id')->first();
        if(!empty($users)){  
        $company = Company::where('id', $users->company_id)->select('id')->first(); 
        if(!empty($company)) {
        Attendance::create([
              'longitude' => $request->longitude,
              'latitude' => $request->latitude,
              'user_id' => $users->id,
              'company_id' => $company->id,
        ]);
        
        $message = 'Punch successful marked';
         return apiResponseAppmsg(true, 200, $message, null, null);
        } else {
            
            $message = 'Construction Site not assign';
            return apiResponseAppmsg(false, 200, $message, null, null);
        }
        }
      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }
    
    
    public function punch_list(Request $request){
        try{
        $users = User::where('api_token', $request->api_token)->select('id')->first();
        if(!empty($users)){  
            
            $data = [];
            $ats = Attendance::whereDate('created_at', Carbon::today())->where('user_id', $users->id)->select('created_at')->get();
            if($ats){
            $i = 0;    
            foreach($ats as $at){
            
            if($i == 0){
                $slide['punch'] = 'in';
            }
            if($i == 2){
                $slide['punch'] = 'in';
            }
            if($i == 4){
                $slide['punch'] = 'in';
            }
            if($i == 6){
                $slide['punch'] = 'in';
            }
            if($i == 8){
                $slide['punch'] = 'in';
            }
            if($i == 10){
                $slide['punch'] = 'in';
            }
            if($i == 12){
                $slide['punch'] = 'in';
            }
            if($i == 14){
                $slide['punch'] = 'in';
            }
            if($i == 16){
                $slide['punch'] = 'in';
            }
            
            if($i == 1){
                $slide['punch'] = 'out';
            }
            if($i == 3){
                $slide['punch'] = 'out';
            }
            if($i == 5){
                $slide['punch'] = 'out';
            }
            if($i == 7){
                $slide['punch'] = 'out';
            }
            if($i == 9){
                $slide['punch'] = 'out';
            }
            if($i == 11){
                $slide['punch'] = 'out';
            }
            if($i == 13){
                $slide['punch'] = 'out';
            }
            if($i == 15){
                $slide['punch'] = 'out';
            }
            if($i == 17){
                $slide['punch'] = 'out';
            }
            
            $i++;
                
            $dt = new DateTime($at->created_at);
            $tz = new \DateTimeZone('Asia/Kolkata'); 
            $dt->setTimezone($tz);
            $slide['date_time'] = $dt->format('Y-m-d H:i:s');
            $data[] = $slide;
            
            }
            
            }
             return apiResponseApp(true, 200, null, null, $data);
            
        }
        
        } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
        
    }

    public function force_update(){

      try{
        $data['support'] = ForceUpdate::where('id', 1)->select('force_update', 'version')->first();
        return apiResponseApp(true, 200, null, null, $data);
      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }
    
    public function login(Request $request){
        try{
            
            $credentials = [
                'mobile' => $request->get('mobile'),
                'password' => $request->get('password'),
                'status' => 1
            ];
        
            if (Auth::attempt($credentials))  {
                
                $api_key = $this->generateApiKey();
       
                $user_data = User::where('mobile', $request->mobile)->first();
                
                if($user_data->api_token){
                    $api_key = $user_data->api_token;
                } else {
                  User::where('id', $user_data->id)
                    ->update([
                      'api_token'  => $api_key,
                  ]);
                }
                
                $data['name'] = $user_data->name; 
                $data['email'] = $user_data->email; 
                $data['mobile'] = $user_data->mobile; 
                $data['unique_id'] = $user_data->unique_id; 
                $data['date_of_birth'] = $user_data->date_of_birth;
                $data['gender'] = $user_data->gender;
                $data['api_token'] = $api_key; 
                $url = route('admin');
                if($user_data->profile_image){
                $data['profile_image'] = $url.$user_data->profile_image; 
                } else {
                   $data['profile_image'] = null; 
                }
                $company = Company::where('id', $user_data->company_id)->select('name', 'latitude', 'longitude')->first();
                if(!empty($company)){
                    $data['company'] = $company->name;
                    $data['latitude'] = $company->latitude;
                    $data['longitude'] = $company->longitude;
                } else {
                    $data['company'] = null;
                    $data['latitude'] = null;
                    $data['longitude'] = null;
                }
                
                 return apiResponseApp(true, 200, null, null, $data);
                
            } else {
                
                $message = 'Incorrect Credentials';
                
                return apiResponseAppmsg(true, 200, $message, null, null);
            }
   
        
        
       
      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
        
    }
    
    public function user_device(Request $request){
      try{
          $check = UserDevice::where('device_token', $request->device_token)->first();
          if($request->api_key){
              $user = User::where('api_key', $request->api_key)->select('id')->first();
              $user_id = $user->id;
          } else {
            $user_id = "";
          }

          if($check){
           if($user_id){
            UserDevice::where('id', $check->id)
            ->update([
              'user_id' => $user_id,
            ]);
           }
          } else{
            if($user_id){
              UserDevice::create([
              'device_token' => $request->device_token,
              'user_id' => $user_id,
              ]);
            } else {
              UserDevice::create([
              'device_token' => $request->device_token,
              ]);
            }
          }

        $message = "Device Token Successfully Saved";
        return apiResponseAppmsg(true, 200, $message, null, null);

      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }


    public function country(){
        $data = \DB::table('countries')->select('id', 'country_name as name')->get();
        return apiResponseApp(true, 200, null, null, $data);
    }
    

    

     /*create app key*/
    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }


   
      //Update Profile
    public function updateProfile(Request $request){
      try{   

          if($request->api_token){
           $user = User::where('api_token', $request->api_token)->select('id', 'profile_image')->first();
          if($user) {  

            $inputs = $request->all();

            if(isset($inputs['profile_image']) or !empty($inputs['profile_image']))
            {

                $image_name = rand(100000, 999999);
                $fileName = '';

                if($file = $request->hasFile('profile_image')) 
                {
                    $file = $request->file('profile_image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/user_images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/user_images/';
                $profile_images = $fname.$fileName;
       

            } else {
                $profile_images = $user->profile_image;
            }
            
           //  $name = $request->first_name.' '. $request->last_name;
             unset($inputs['profile_image']);

            $inputs = $inputs + [    
                                  'updated_by' => $user->id,
                                  'profile_image' => $profile_images,
                                 
                                  ];

            (new User)->store($inputs, $user->id);
            $url = route('admin'); 
            
             $u_data = User::where('id', $user->id)->select('id', 'name', 'email', 'gender', 'mobile', 'profile_image', 'unique_id', 'date_of_birth')->first();

             $data['id'] = $u_data->id;
             $data['name'] = $u_data->name;
             $data['email'] = $u_data->email;
             $data['mobile'] = $u_data->mobile;
             $data['date_of_birth'] = $u_data->date_of_birth;
             $data['unique_id'] = $u_data->unique_id;
             if($u_data->profile_image){
                  $data['profile_image'] = $url.$profile_images;
                } else {
                  $data['profile_image'] = $url.$profile_images;
              }
             $data['gender'] = $u_data->gender;

            return apiResponseApp(true, 200, null, null, $data);

            //return apiResponse(true, 200, lang('User added successfully'));

           }

          }

        } catch(Exception $e){
        
         // dd($e);
          // return apiResponse(false, 500, lang('messages.server_error'));
           return apiResponseApp(true, 200, null, null, $e);
        }


    }

    public function addDeviceToken(Request $request){
        try{    
            $inputs = $request->all();

            $token_exist = UserDevice::where('device_token', $inputs['device_token'])->first();
            if (isset($token_exist)) {
                (new UserDevice)->store($inputs, $token_exist['id']);
            }else{
                (new UserDevice)->store($inputs);
            }
            return apiResponse(true, 200, lang('User added successfully'));

        }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }




    public function profile(Request $request){

        try{

          if($request->api_key){
           $user = User::where('api_key', $request->api_key)->select('id', 'name', 'email', 'mobile', 'profile_image', 'gender')->first();
            $url = route('home'); 

            if($user){
            $data['id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['mobile'] = $user->mobile;
             if($user->profile_image){
                  $data['profile_image'] = $url.$user->profile_image;
                } else {
                  $data['profile_image'] =$user->profile_image;
              }
            $data['gender'] = $user->gender;

            return apiResponseApp(true, 200, null, null, $data); 
          }
          }

        } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }

    }





   

    

}
