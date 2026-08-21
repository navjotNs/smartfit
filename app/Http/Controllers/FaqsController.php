<?php

namespace App\Http\Controllers;
/**
 * :: FaqMaster Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller{
 
    public function  index() {
        return view('admin.faq.index');
    }
  
    public function create() {
        return view('admin.faq.create');
    }

    public function store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            $validator = (new Faq)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            
            $inputs = $inputs + [
                    'created_by' => Auth::id(),
                ];  
            
            (new Faq)->store($inputs);
            return redirect()->route('faqs.index')
                ->with('success', 'Faq successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('faqs.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Faq)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {


            $inputs = $inputs + [
                'updated_by' => Auth::id(),
            ];  

            (new Faq)->store($inputs, $id);

            return redirect()->route('faqs.index')
                ->with('success', 'Faq successfully updated');
        } catch (\Exception $exception) {
            return redirect()->route('faqs.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

    public function edit($id = null) {
        try {
        $result = (new Faq)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.faq.create', compact('result'));
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

            $data = (new Faq)->getFaq($inputs, $start, $perPage);
            $totalGameMaster = (new Faq)->totalFaq($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new Faq)->getFaq($inputs, $start, $perPage);
            $totalGameMaster = (new Faq)->totalFaq();
            $total = $totalGameMaster->total;
        }

        return view('admin.faq.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = Faq::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Faq Site')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function Action(Request $request) {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('faqs.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Faq Site'))));
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

        Faq::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('faqs.index')
            ->with('success', lang('messages.updated', lang('Faq Site')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new Faq)->find($id);
        if (!$result) {
            abort(401);
        }
        try {
            (new Faq)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Faq Site'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    

}
