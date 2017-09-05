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
use Modules\Core\Entities\Bp_media;
use Modules\Core\Utils\Limit;
use Modules\Core\Services\MediaService;
use Auth;

class MediaController extends Controller
{
    protected $service;

    public function __construct(MediaService $service)
    {   
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request){
        $per_page = $request->input('per_page',Limit::NORMAL );
        $query = $this->service->search($request->except('per_page'), $per_page);
        
        if (isset($query)) return  $query;
        return  json_encode([]);

    }


    public function imageUpload(Request $request){
        // $this->validate($request, [
        //     'media_link' => 'required|mimes:jpg,jpeg,bmp,png,mp4,mp3,webm'
        //     ]);
       // if ($request->file('media_link') && $request->file('media_link')->isValid()) {
            $destinationPath = public_path().'/uploads';
            $extension = $request->file('media_link')->getClientOriginalExtension(); // getting image extension
            $fileName = 'mediamk'.md5(microtime().rand()).'.'.$extension; // renameing image
            $request->file('media_link')->move($destinationPath, $fileName); // uploading file to given path
            return ['media' => $fileName];
        // }

        // return ['media' => ''];
    }

    public function store(Request $request){
        $this->validate($request, [
        'media_name' => 'required',
        'media_link' => 'required'
        ]);
        $inputs = $request->all();
        $inputs['staff_id'] = Auth::user()->id;
        Bp_media::create($inputs);
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
        'media_name' => 'required',
        'media_link' => 'required'
        ]);
        $inputs = $request->all();
        Bp_media::findOrFail($id)->update($inputs);
    }

    public function destroy($id)
    {
        Bp_media::find($id)->delete();
    }

}
