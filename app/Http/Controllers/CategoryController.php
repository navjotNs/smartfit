<?php

namespace App\Http\Controllers;
/**
 * :: CategoryMaster Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{
 
    public function  index() {
        return view('admin.category.index');
    }
  
    public function create() {
        $ParentCategory = (new Category)->getParentCategoryService();
        return view('admin.category.create', compact('ParentCategory'));
    }
    
    public function getSubcategory(Request $request) {
      $main_id = $request->main_id;
      $category = \DB::table('categories')->where('parent_id', $main_id)->where('status', 1)->where('status', 1)->get();
      $subcategoryList='';
      $subcategoryList .= '<option value="">select</option>';
      foreach($category as $key => $subcategory)
      $subcategoryList .= '<option value="' . $subcategory->id . '">'. $subcategory->name .'</option>';
      return $subcategoryList; 
    }

    public function store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            $validator = (new Category)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            $slug_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $inputs = $inputs + [
                    'created_by' => Auth::id(),
                    'url' =>  $slug_name,
                ];  
            
            (new Category)->store($inputs);
            return redirect()->route('category.index')
                ->with('success', 'Category successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('category.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null)
    {
        $result = (new Category)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {


            $inputs = $inputs + [
                'updated_by' => Auth::id(),
            ];  

            (new Category)->store($inputs, $id);

            return redirect()->route('category.index')
                ->with('success', 'Category successfully updated');
        } catch (\Exception $exception) {
            return redirect()->route('category.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

    public function edit($id = null) {
        try {
        $result = (new Category)->find($id);
        if (!$result) {
            abort(401);
        }
        $ParentCategory = (new Category)->getParentCategoryService();
        
        return view('admin.category.create', compact('result', 'ParentCategory'));
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

            $data = (new Category)->getCategory($inputs, $start, $perPage);
            $totalGameMaster = (new Category)->totalCategory($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new Category)->getCategory($inputs, $start, $perPage);
            $totalGameMaster = (new Category)->totalCategory();
            $total = $totalGameMaster->total;
        }

        return view('admin.category.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = Category::find($id);
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
            return redirect()->route('category.index')
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

        Category::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('category.index')
            ->with('success', lang('messages.updated', lang('Construction Site')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Category)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
   
            (new Category)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Construction Site'))];
             
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    

}
