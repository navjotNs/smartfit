<?php

namespace App\Http\Controllers;
/**
 * :: ArticleMaster Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller{
 
    public function  index() {
        return view('admin.project.index');
    }
  
    public function create() {
        return view('admin.project.create');
    }


    public function store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            $validator = (new Project)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            $slug_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['title'])));

            if(isset($inputs['image']) or !empty($inputs['image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('image'))  {
                    $file = $request->file('image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = null;
            }
            unset($inputs['image']);
            $inputs['image'] = $image;

            if(isset($inputs['banner']) or !empty($inputs['banner'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('banner'))  {
                    $file = $request->file('banner') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = null;
            }
            unset($inputs['banner']);
            $inputs['banner'] = $image;

            if(isset($inputs['gallery1']) or !empty($inputs['gallery1'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery1'))  {
                    $file = $request->file('gallery1') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = null;
            }
            unset($inputs['gallery1']);
            $inputs['gallery1'] = $image;

            if(isset($inputs['gallery2']) or !empty($inputs['gallery2'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery2'))  {
                    $file = $request->file('gallery2') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = null;
            }
            unset($inputs['gallery2']);
            $inputs['gallery2'] = $image;

            if(isset($inputs['gallery3']) or !empty($inputs['gallery3'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery3'))  {
                    $file = $request->file('gallery3') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = null;
            }
            unset($inputs['gallery3']);
            $inputs['gallery3'] = $image;

            if(isset($inputs['gallery4']) or !empty($inputs['gallery4'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery4'))  {
                    $file = $request->file('gallery4') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = null;
            }
            unset($inputs['gallery4']);
            $inputs['gallery4'] = $image;


            $inputs = $inputs + [
                    'created_by' => Auth::id(),
                    'url' =>  $slug_name,
                ];  
            
            (new Project)->store($inputs);
            return redirect()->route('projects.index')
                ->with('success', 'Place successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('projects.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Project)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {

            if(isset($inputs['image']) or !empty($inputs['image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('image'))  {
                    $file = $request->file('image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->image;
            }
            unset($inputs['image']);
            $inputs['image'] = $image;


            if(isset($inputs['banner']) or !empty($inputs['banner'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('banner'))  {
                    $file = $request->file('banner') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->banner;
            }
            unset($inputs['banner']);
            $inputs['banner'] = $image;

            if(isset($inputs['gallery1']) or !empty($inputs['gallery1'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery1'))  {
                    $file = $request->file('gallery1') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->gallery1;
            }
            unset($inputs['gallery1']);
            $inputs['gallery1'] = $image;

            if(isset($inputs['gallery2']) or !empty($inputs['gallery2'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery2'))  {
                    $file = $request->file('gallery2') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->gallery2;
            }
            unset($inputs['gallery2']);
            $inputs['gallery2'] = $image;

            if(isset($inputs['gallery3']) or !empty($inputs['gallery3'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery3'))  {
                    $file = $request->file('gallery3') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->gallery3;
            }
            unset($inputs['gallery3']);
            $inputs['gallery3'] = $image;

            if(isset($inputs['gallery4']) or !empty($inputs['gallery4'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('gallery4'))  {
                    $file = $request->file('gallery4') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            }
            else{
                $image = $result->gallery4;
            }
            unset($inputs['gallery4']);
            $inputs['gallery4'] = $image;

            $inputs = $inputs + [
                'updated_by' => Auth::id(),
            ];  

            (new Project)->store($inputs, $id);

            return redirect()->route('projects.index')
                ->with('success', 'Place successfully updated');
        } catch (\Exception $exception) {
           // dd($exception);
            return redirect()->route('projects.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

    public function edit($id = null) {
        try {
        $result = (new Project)->find($id);
        if (!$result) {
            abort(401);
        }
        $parent_cat = $result->category_id;
        $Categorys = Category::where('status', 1)->where('parent_id', NULL)->select('name', 'id')->get();
        $category_list_2 = Category::where('status', 1)->where('parent_id', $parent_cat)->get();
        
        return view('admin.project.create', compact('result', 'Categorys', 'parent_cat', 
            'category_list_2'));
        } catch (\Exception $exception) {
            return back();
        }
    }


    public function Paginate(Request $request, $pageNumber = null) {

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

            $data = (new Project)->getArticle($inputs, $start, $perPage);
            $totalGameMaster = (new Project)->totalArticle($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new Project)->getArticle($inputs, $start, $perPage);
            $totalGameMaster = (new Project)->totalArticle();
            $total = $totalGameMaster->total;
        }

        return view('admin.project.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = Project::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Construction Site')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function Action(Request $request) {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('projects.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Construction Site'))));
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

        Project::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('projects.index')
            ->with('success', lang('messages.updated', lang('Construction Site')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Project)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
   
            (new Project)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Construction Site'))];
             
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    

}
