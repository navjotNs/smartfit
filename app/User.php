<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_type', 'first_name', 'last_name', 'name', 'mobile', 'email', 'gender', 'mobile', 'unique_id' ,'password', 'profile_image', 'company_id', 'city_id', 'state_id', 
        'country_id', 'date_of_birth', 'status', 'api_key', 'access_token', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'deleted_by', 'updated_by'
    ];

    public function validateLoginUser1($inputs, $id = null) {
        $rules['email'] = 'required';
        $rules['password'] = 'required|min:6';
        return \Validator::make($inputs, $rules);
    }

    public function validate($inputs, $id = null) {
        $rules['first_name'] = 'required|string|max:100|regex:/^[a-zA-Z ]+$/';
        $rules['last_name'] = 'required|string|max:100|regex:/^[a-zA-Z ]+$/';
        $rules['email'] = 'required|email|max:100|unique:users';
        $rules['mobile'] = 'required|digits:10|unique:users';
        $rules['password'] = 'required|min:6';
        $rules['user_type'] = 'required';
        $rules['country_id'] = 'required';
 
        return \Validator::make($inputs, $rules);
    }
    
    public function validate_allot($inputs) {
        $rules['worker'] = 'required';
        $rules['company_id'] = 'required';
 
        return \Validator::make($inputs, $rules);
    }
    

    public function validatePassword($inputs, $id = null){   
        $rules['password']          = 'required';
        $rules['new_password']      = 'required|same:confirm_password|min:6';
        $rules['confirm_password']  = 'required';
        return \Validator::make($inputs, $rules);
    }

    public function recordvalidate($inputs) {
        $rules = [
            'from'  => 'required|date',
            'to'    => 'required|date|after:from',
        ];
        return \Validator::make($inputs, $rules);
    }

    public function validate_front($inputs, $id = null){

        $rules['first_name'] = 'required|string|max:100|regex:/^[a-zA-Z ]+$/';
        $rules['last_name']  = 'required|string|max:100|regex:/^[a-zA-Z ]+$/';
        $rules['email']      = 'required|email|max:100|unique:users';
        $rules['mobile']     = 'required|digits:10|unique:users';
        $rules['password']   = 'required|min:6';

        return \Validator::make($inputs, $rules);
    }



    public function validate_update_profile($inputs, $id = null)
    {

        $rules['name'] = 'required|string|max:100|regex:/^[a-zA-Z ]+$/';
        $rules['email'] = 'required|email|max:100|unique:users,id,'. $id;
        $rules['mobile'] = 'required|digits:10|unique:users,id,'. $id;
   

        return \Validator::make($inputs, $rules);
    }
    

    public function validateChangePassword($inputs, $id = null) {
        $rules['old_password'] = 'required|min:6';
        $rules['password'] = 'required|min:6';
        return \Validator::make($inputs, $rules);
    }


    public function store($input, $id = null)
    {
        if ($id) {
            return $this->find($id)->update($input);
        } else {
            return $this->create($input)->id;
        }
    } 


    public function validateLoginUser($inputs, $id = null)
    {
        $rules['username'] = 'required';
        $rules['password'] = 'required';
        return \Validator::make($inputs, $rules);
    }

    public function password_validate($inputs, $id = null)
    {
        $rules['old_password'] = 'required';
        $rules['new_password'] = 'required|min:6|max:20|confirmed';
        
        return \Validator::make($inputs, $rules);
    }
    
    public function validateConfirmPassword($inputs, $id = null)
    {   
         $rules['password']          = 'required|same:confirm_password';
         $rules['confirm_password']  = 'required';
        return \Validator::make($inputs, $rules);
    }

      public function validate_password_forgot($inputs, $id = null)
    {   
         $rules['new_password']          = 'required|same:confirm_password';
        $rules['confirm_password']  = 'required';
        return \Validator::make($inputs, $rules);
    }

    public function validateForgotPasswordEmail($inputs, $id = null)
    {   
         $rules['email']          = 'required';
        return \Validator::make($inputs, $rules);
    }

    public function getCustomer($search = null, $skip, $perPage) {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search
         $fields = [
                'users.id',
                'users.name',
                'users.email',
                'users.user_type', 
                'users.mobile', 
                'users.unique_id',
                'users.created_by', 
                'users.status',
                'users.profile_image',
                'companies.name as company'
            ];
         $sortBy = [
             'name' => 'name',
         ];
         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }
         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }
          if (is_array($search) && count($search) > 0) {
            $f1 = (array_key_exists('email', $search)) ? " AND (users.email Like '%" .
                addslashes($search['email']) . "%')" : "";
              
            $f2 = (array_key_exists('mobile', $search)) ? " AND (users.mobile Like '%" .
                addslashes($search['mobile']) . "%')" : "";

            $f3 = (array_key_exists('status', $search)) ? " AND (users.status = '" .
                addslashes($search['status']) . "')" : "";
           $f4 = (array_key_exists('name', $search)) ? " AND (users.name LIKE '%" .
                addslashes(trim($search['name'])) . "%')" : "";  
            $filter .= $f1 . $f2 . $f3 . $f4;
        }
         return $this
            ->leftjoin('companies', 'companies.id' ,'=', 'users.company_id')
            ->whereRaw($filter)
            ->where('user_type', 2)
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)->get($fields);
    }


    public function totalCustomer($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         return $this->select(\DB::raw('count(*) as total'))
                    ->where('user_type', 2)
                    ->whereRaw($filter)
                    ->first();
    }
    
    public function totalCustomer1($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         return $this->select(\DB::raw('count(*) as total'))
                    ->where('user_type', 2)
                    ->whereRaw($filter)
                    ->first();
    }
    
    public function getCustomer1($search = null, $skip, $perPage) {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search
         $fields = [
                'users.id',
                'users.name',
                'users.email',
                'users.user_type', 
                'users.mobile', 
                'users.unique_id',
                'users.created_by', 
                'users.status',
                'users.profile_image',
                'companies.name as company'
            ];
         $sortBy = [
             'name' => 'name',
         ];
         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }
         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }
          if (is_array($search) && count($search) > 0) {
            $f1 = (array_key_exists('email', $search)) ? " AND (users.email Like '%" .
                addslashes($search['email']) . "%')" : "";
              
            $f2 = (array_key_exists('mobile', $search)) ? " AND (users.mobile Like '%" .
                addslashes($search['mobile']) . "%')" : "";

            $f3 = (array_key_exists('status', $search)) ? " AND (users.status = '" .
                addslashes($search['status']) . "')" : "";
           $f4 = (array_key_exists('name', $search)) ? " AND (users.name LIKE '%" .
                addslashes(trim($search['name'])) . "%')" : "";  
            $filter .= $f1 . $f2 . $f3 . $f4;
        }
         return $this
            ->leftjoin('companies', 'companies.id' ,'=', 'users.company_id')
            ->whereRaw($filter)
            ->where('user_type', 2)
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)->get($fields);
    }



    public function updatePassword($password){
        return $this->where('id', authUserId())->update(['password' => $password]);
    } 


    public function getVendor(){
        $result = $this->where('status', 1)->where('user_type', 3)->pluck('name', 'id')->toArray();
        return ['' => '-Select Vendor-'] + $result;
    }
    
 

    public function totaluser_ent($search = null){
        $filter = 1; // if no search add where
         // when search
        if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
        }
        return $this->select(\DB::raw('count(*) as total'))
             ->where('user_type', 2)->whereRaw($filter)->first();
    }






}
