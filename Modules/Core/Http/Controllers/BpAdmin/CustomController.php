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
use Modules\Core\Entities\Bp_custom;
use Modules\Core\Utils\Limit;
use Modules\Core\Services\CustomService;

class CustomController extends Controller
{
    protected $service;
    public function __construct(CustomService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request){
        $per_page = $request->input('per_page',Limit::NORMAL );
        $query = $this->service->customs($per_page);
        return $query;
    }

    public function show($name){
        $query = Bp_custom::where('custom_link', $name)->first();
        if(count($query)) return  view('custom/'.$query->custom_blade);
    }

    public function create(){
        $custom = Bp_custom::latest('id')->get();
        return view('bp-admin.custom.add')->with(compact('custom'));
    }

    public function store(Request $request){
        // $this->validate($request, [
        // 'title' => 'required',
        // 'description' => 'required'
        // ]);

        $inputs = $request->all();
        return Bp_custom::create($inputs);
    }

    public function edit($id)
    {
        try {
            $custom = Bp_custom::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Product Not Found';
        }

        return $custom;
    }


    public function update($id, Request $request)
    {
        $inputs = $request->all();
        $custom = Bp_custom::findOrFail($id)->update($inputs);
        return count($custom);
    }

    public function destroy($id)
    {
        $custom = Bp_custom::find($id)->delete();
        return count($custom);
    }



}
