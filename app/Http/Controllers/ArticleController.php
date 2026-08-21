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
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller{
 
    public function  index() {
        return view('admin.article.index');
    }
  
    public function create() {
        return view('admin.article.create');
    }


    public function store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            $validator = (new Article)->validate($inputs);
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

            if(isset($inputs['img_service']) or !empty($inputs['img_service'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('img_service'))  {
                    $file = $request->file('img_service') ;
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
            unset($inputs['img_service']);
            $inputs['img_service'] = $image;

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

            $inputs = $inputs + [
                    'created_by' => Auth::id(),
                    'url' =>  $slug_name,
                ];  
            
            (new Article)->store($inputs);
            return redirect()->route('article.index')
                ->with('success', 'Service successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('article.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Article)->find($id);
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

            if(isset($inputs['img_service']) or !empty($inputs['img_service'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('img_service'))  {
                    $file = $request->file('img_service') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/images/';
                $image = $fname.$fileName;
            } else {
                $image = $result->img_service;
            }
            unset($inputs['img_service']);
            $inputs['img_service'] = $image;

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



            $inputs = $inputs + [
                'updated_by' => Auth::id(),
            ];  

            (new Article)->store($inputs, $id);

            return redirect()->route('article.index')
                ->with('success', 'Service successfully updated');
        } catch (\Exception $exception) {
            dd($exception);
            return redirect()->route('article.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

    public function edit($id = null) {
        try {
        $result = (new Article)->find($id);
        if (!$result) {
            abort(401);
        }
        $parent_cat = $result->category_id;
        $Categorys = Category::where('status', 1)->where('parent_id', NULL)->select('name', 'id')->get();
        $category_list_2 = Category::where('status', 1)->where('parent_id', $parent_cat)->get();
        
        return view('admin.article.create', compact('result', 'Categorys', 'parent_cat', 
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

            $data = (new Article)->getArticle($inputs, $start, $perPage);
            $totalGameMaster = (new Article)->totalArticle($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new Article)->getArticle($inputs, $start, $perPage);
            $totalGameMaster = (new Article)->totalArticle();
            $total = $totalGameMaster->total;
        }

        return view('admin.article.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = Article::find($id);
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
            return redirect()->route('article.index')
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

        Article::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('article.index')
            ->with('success', lang('messages.updated', lang('Construction Site')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Article)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
   
            (new Article)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Construction Site'))];
             
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    

}
