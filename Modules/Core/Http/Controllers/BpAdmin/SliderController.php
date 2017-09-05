<?php

/**
 * Created by Beyond Plus <bplusmyanmar@hotmail.com>
 * User: Beyond Plus
 * Date: D/M/Y
 * Time: MM:HH PM
 */
namespace Modules\Core\Http\Controllers\BpAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Core\Entities\Bp_slider;
use Modules\Core\Utils\Limit;
use Modules\Core\Services\SliderService;
use Auth;

class sliderController extends Controller
{
    protected $service;

    public function __construct(SliderService $service)
    {   
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request){
        $per_page = $request->input('per_page',Limit::NORMAL );
        $query = $this->service->search($request->except('per_page'),$per_page);
        if(sizeof($query)>0){
            return  $query;
         } else {
             return  json_encode([]);
        }

    }


    public function imageUpload(Request $request){
        // $this->validate($request, [
        //     'slider_link' => 'required|mimes:jpg,jpeg,bmp,png,mp4,mp3,webm'
        //     ]);
       // if ($request->file('slider_link') && $request->file('slider_link')->isValid()) {
            $destinationPath = public_path().'/uploads';
            $extension = $request->file('slider_link')->getClientOriginalExtension(); // getting image extension
            $fileName = 'slidermk'.md5(microtime().rand()).'.'.$extension; // renameing image
            $request->file('slider_link')->move($destinationPath, $fileName); // uploading file to given path
            return ['slider' => $fileName];
        // }

        // return ['slider' => ''];
    }

    public function store(Request $request){
        $this->validate($request, [
        'slider_name' => 'required',
        'slider_link' => 'required'
        ]);
        $inputs = $request->all();
        if($inputs['slider_description']) {
            $inputs['slider_description'] = '';
        }
        $inputs['staff_id'] = Auth::user()->id;
        Bp_slider::create($inputs);
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
        'slider_name' => 'required',
        'slider_link' => 'required'
        ]);
        $inputs = $request->all();
        if($inputs['slider_description']) {
            $inputs['slider_description'] = '';
        }
        
        Bp_slider::findOrFail($id)->update($inputs);
    }

    public function destroy($id)
    {
        Bp_slider::find($id)->delete();
    }

}
