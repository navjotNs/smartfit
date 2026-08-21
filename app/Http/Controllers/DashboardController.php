<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class DashboardController extends Controller {
  
    public function index() {
        $user = (new User)->totaluser_ent();
        $user_id =  Auth::id();
        $currentMonth = date('m');
        $newusers = \DB::table("users")
        ->where('user_type', 2)
        ->count();
        $articles = \DB::table("articles")->where('status', 1)->count();
        $categories = \DB::table("categories")->where('status', 1)->count();
        $faqs = \DB::table("faqs")->where('status', 1)->count();
        $contact_enquiry = \DB::table("contact_enquiry")->count();

        return view('admin.dashboard', compact('contact_enquiry', 'articles', 'categories', 'faqs'));
    }  


}
