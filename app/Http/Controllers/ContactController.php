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
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller{
 
    public function  index() {
        return view('admin.contact.index');
    }
  
    public function create() {
        return view('admin.contact.create');
    }

    public function store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            $validator = (new Contact)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            
            $inputs = $inputs + [
                    'created_by' => Auth::id(),
                ];  
            
            (new Contact)->store($inputs);
            return redirect()->route('contact.index')
                ->with('success', 'Contact successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('contact.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Contact)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {

            $inputs = $inputs + [
                'updated_by' => Auth::id(),
            ];  

            (new Contact)->store($inputs, $id);

            return redirect()->route('contact.index')
                ->with('success', 'Contact successfully updated');
        } catch (\Exception $exception) {
            return redirect()->route('contact.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

    public function edit($id = null) {
        try {
        $result = (new Contact)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.contact.create', compact('result'));
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

            $data = (new Contact)->getFaq($inputs, $start, $perPage);
            $totalGameMaster = (new Contact)->totalContact($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new Contact)->getContact($inputs, $start, $perPage);
            $totalGameMaster = (new Contact)->totalContact();
            $total = $totalGameMaster->total;
        }

        return view('admin.contact.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = Contact::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Contact Site')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function Action(Request $request) {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('contact.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Contact Site'))));
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

        Contact::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('faqs.index')
            ->with('success', lang('messages.updated', lang('Contact Site')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new Contact)->find($id);
        if (!$result) {
            abort(401);
        }
        try {
            (new Contact)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Contact Site'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    

}
