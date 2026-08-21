<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    // use SoftDeletes;
    protected $table = 'contents';
   
    protected $fillable = [
        'about', 'specialization', 'home_about', 'home_about_image', 'landing_image', 'twitter', 'instagram', 
        'facebook', 'youtube', 'doctor_image', 'patient_image', 'linkedin', 'created_at', 'updated_at'
    ];

    public function validate($inputs, $id = null){
        //$rules['name'] = 'required|unique:categories';
        return \Validator::make($inputs, $rules);
    }


    public function store($inputs, $id = null) {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }



}
