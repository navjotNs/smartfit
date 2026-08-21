<?php

namespace App\Http\Controllers\Front;
/**
 * :: Home Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Article;
use App\Models\Project;
use App\Models\Faq;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Content;
use SendGrid\Mail\Mail;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller{
 
    public function index() {
        $sliders = Slider::where('status', 1)->where('title', 'Home')->select('image')->get();
        if ($sliders->isEmpty()) {
            $sliders = [
                (object) ['image' => 'uploads/images/670544kitchen_02.webp'],
                (object) ['image' => 'uploads/images/712276kitchen_11.webp'],
                (object) ['image' => 'uploads/images/860430bath_15.webp'],
                (object) ['image' => 'assets/frontend/images/about_1.webp'],
            ];
        }
        $tours = Article::where('status', 1)->select('id', 'title', 'image', 'url')->orderBy('sort_order', 'ASC')->get();
        $projects = Project::where('status', 1)->select('id', 'title', 'image', 'url')->orderBy('sort_order', 'ASC')->get();
        $reviews = Review::where('status', 1)->select('name', 'description')->get();
        $content = Content::where('id', 1)->first();
        return view('frontend.pages.home', compact('sliders', 'tours', 'reviews', 'content', 'projects'));
    }


    public function contact(){
        $tours = Article::where('status', 1)->select('id', 'title', 'url')->get();
        $content = Content::where('id', 1)->first();
        $reviews = Review::where('status', 1)->select('name', 'description')->get();
        return view('frontend.pages.contact', compact('tours', 'content', 'reviews'));
    }

    public function services(){
        $tours = Article::where('status', 1)
            ->select('id', 'title', 'image', 'url', 'meta_description', 'description')
            ->orderBy('sort_order', 'ASC')
            ->get();
        $content = Content::where('id', 1)->first();
        $sliders = Slider::where('status', 1)->where('title', 'Service')->select('image')->get();
        if ($sliders->isEmpty()) {
            $sliders = [
                (object) ['image' => 'uploads/images/750707kitchen-service.jpg'],
                (object) ['image' => 'uploads/images/670544kitchen_02.webp'],
                (object) ['image' => 'uploads/images/235483laundry_12.webp'],
            ];
        }
        return view('frontend.pages.services', compact('content', 'sliders', 'tours'));
    }
    
    public function projects(){
        $tours = Project::where('status', 1)->select('id', 'title', 'image', 'url')->orderBy('sort_order', 'ASC')->get();
        $content = Content::where('id', 1)->first();
        $sliders = Slider::where('status', 1)->where('title', 'Projects')->select('image')->get();
        if ($sliders->isEmpty()) {
            $sliders = [
                (object) ['image' => 'uploads/images/670544kitchen_02.webp'],
                (object) ['image' => 'uploads/images/712276kitchen_11.webp'],
                (object) ['image' => 'uploads/images/860430bath_15.webp'],
            ];
        }
        return view('frontend.pages.projects', compact('content', 'sliders', 'tours'));
    }

    public function articleDetails($url = null){
        try{
            $article = Article::where('status', 1)->where('url', $url)->select('id', 'title', 'description', 'image', 'meta_description', 'banner')->first();
            $rel_articles = Article::where('status', 1)->select('id', 'url', 'title','image')->get();
            $tours = Article::where('status', 1)->select('id', 'title', 'url')->get();
            $top_lines = Article::where('status', 1)->select('title', 'url')->orderBy('id', 'desc')->get();
            $content = Content::where('id', 1)->first();
            $sliders = Slider::where('status', 1)->where('title', $article->title)->select('image')->get();
            return view('frontend.pages.article_detail', compact('article', 'rel_articles', 'top_lines', 'tours', 'content', 'sliders'));
        }  catch(\Exception $exception){
            //dd($exception);
            return back();
        }
    }
    
    public function projectDetails($url = null){
        try{
            $article = Project::where('status', 1)->where('url', $url)->select('id', 'title', 'description', 'image', 'meta_description')->first();
            $content = Content::where('id', 1)->first();
            $sliders = Slider::where('status', 1)->where('title', $article->title)->select('image')->get();
            return view('frontend.pages.project_detail', compact('article', 'content', 'sliders'));
        }  catch(\Exception $exception){
            dd($exception);
            return back();
        }
    }
    
    public function gallery() {
        $gallery = Gallery::where('status', 1)->select('image', 'title', 'id')->orderby('id', 'desc')->get();
        $tours = Article::where('status', 1)->select('id', 'title', 'url')->get();
        $content = Content::where('id', 1)->first();
        return view('frontend.pages.gallery', compact('gallery', 'tours', 'content'));
    }

    public function destinations(){
        $destinations = Article::where('status', 1)->select('id', 'title', 'url', 'image')->orderBy('sort_order', 'ASC')->get();
        $tours = Article::where('status', 1)->select('id', 'title', 'url')->get();
        $content = Content::where('id', 1)->first();  
        return view('frontend.pages.destinations', compact('destinations', 'tours', 'content'));
    }

    public function AboutUs(Request $request){
        $tours = Article::where('status', 1)->select('id', 'title', 'url')->get();
        $content = Content::where('id', 1)->first();    
        $top_lines = Article::where('status', 1)->select('title', 'url')->orderBy('id', 'desc')->get();    
        return view('frontend.pages.about_us', compact('top_lines', 'content', 'tours'));
    }

    public function kitchens(){
        $content = Content::where('id', 1)->first();
        $projects = Project::where('status', 1)->select('id', 'title', 'image', 'url')->orderBy('sort_order', 'ASC')->get();
        return view('frontend.pages.kitchens', compact('content', 'projects'));
    }

    public function joinery(){
        $content = Content::where('id', 1)->first();
        $tours = Article::where('status', 1)
            ->select('id', 'title', 'image', 'url', 'meta_description', 'description')
            ->orderBy('sort_order', 'ASC')
            ->get();
        return view('frontend.pages.joinery', compact('content', 'tours'));
    }

    public function buildersArchitects(){
        $content = Content::where('id', 1)->first();
        return view('frontend.pages.builders_architects', compact('content'));
    }

    public function ourProcess(){
        $content = Content::where('id', 1)->first();
        return view('frontend.pages.our_process', compact('content'));
    }

    public function Specialization(Request $request){
        \Session::start();
            $continue_as = \Session::get('continue_as');
            if(empty($continue_as)){
                $continue_as = 'patient';
            }
            if($continue_as == 'doctor'){
                $show = 1;
            } else {
                $show = 2;
            }
        $content = Content::where('id', 1)->first();
        $top_lines = Article::where('status', 1)->where('show_on_top', 1)->whereIn('show_to', array($show, 3))->select('title', 'url')->orderBy('id', 'desc')->get();    
        $categories = Category::where('status', 1)->where('parent_id', NULL)->whereIn('show_to', array($show, 3))->select('name', 'id', 'url')->get();
        return view('frontend.pages.specialization', compact('categories', 'top_lines', 'content'));
    }

    public function contactEnquiry(Request $request){
    try{
        $inputs = $request->all();
        $validator = (new Contact)->front_contact($inputs);
        if( $validator->fails() ) {
          return back()->withErrors($validator)->withInput();
        } 
        (new Contact)->store($inputs);
        
        $email = $inputs['email'];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['suburb'] = $request->suburb;
        $data['service'] = $request->service;
         
        // \Mail::send('email.enquiry', $data, function ($message) use ($email) {
        //     $message->from('developernavjot03@gmail.com', 'SmartFit Cabinets');
        //     $message->to('thakurnavjot03@gmail.com');
        //     $message->replyTo($email);
        //     $message->subject('Enquiry');
        // });

        $email = new Mail();
        $email->setFrom("info@smartfitcabinets.com.au", "SmartFit Cabinets");
        $email->setSubject("Enquiry");
        $email->addTo("info@smartfitcabinets.com.au");
        $email->addContent(
            "text/html",
            "Name: ".$request->name."<br>  Phone: ".$request->phone."<br> Email: ".$request->email."<br> Service: ".$request->service."<br> Suburb: ".$request->suburb.""
        );
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));       
        $response = $sendgrid->send($email);

      //  dd($response);

        return back()->with('enquiry_sub', lang('messages.created', lang('comment_sub')));
    } catch(Exception $exception) {
      //  dd($exception);
            return back();
    }

}
    
    function action1(Request $request) {
	    if($request->ajax()) {
	        $output = '';
	        $query = $request->get('query');
            \Session::start();
            $continue_as = \Session::get('continue_as');
            if(empty($continue_as)){
                $continue_as = 'patient';
            }
            if($continue_as == 'doctor'){
                $show = 1;
            } else {
                $show = 2;
            }
	        if($query != '') {
	        $data = \DB::table('articles')
            ->whereIn('show_to', array($show, 3))
	        ->where('title', 'like', '%'.$query.'%')
	        ->Orwhere('tags', 'like', '%'.$query.'%')
	        ->select('title', 'url')
	        ->orderBy('id', 'desc')
	        ->get();  
	        }
	        foreach($data as $row) {
	        $output .= '
	        <li>
	         <a href="'.route('articleDetails', $row->url).'">'.$row->title.'</a>
	        </li>
	        ';
	        }
	      $data = array(
	       'table_data'  => $output,
	      );
	      echo json_encode($data);
	    }
    }

}
