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
use Modules\Core\Entities\Bp_category;
use Modules\Core\Entities\Bp_post;
use Modules\Core\Entities\User;
use Modules\Core\Utils\Limit;
use Modules\Core\Services\PostService;
use Modules\Core\Transformers\PostTransformer;
use Auth;

class PageController extends Controller
{

    protected $service;
    public function __construct(PostService $service)
    {   
        $this->middleware('auth');
        $this->service = $service;
        $this->transformer = new PostTransformer;
    }

    public function index(Request $request){
        $per_page = $request->input('per_page',Limit::NORMAL );
        $query = $this->service->page($per_page);
        return $this->transformer->transform($query);
    }

    public function search(Request $request){
        $query = $this->service->search($request->all());
        if(sizeof($query)>0){
            return  $query;
        } else {
            return  json_encode([]);
        }

    }

    public function create(){

        $categories= Bp_category::lists('category_name','category_id');
        return view('bp-admin.page.add', array('categories' => $categories));

    }

    public function store(Request $request){
        // $this->validate($request, [
        // 'title' => 'required',
        // 'description' => 'required'
        // ]);

        $inputs = $request->all();
        $inputs['post_type'] = 'page';
        $inputs['staff_id'] = Auth::user()->id;
        if ($request->file('category_icon') && $request->file('category_icon')->isValid()) {
            $destinationPath = uploadPath();
            $extension = $request->file('category_icon')->getClientOriginalExtension(); // getting image extension
            // $fileName = 'catmk'.md5(microtime().rand()).'.'.$extension; // renameing image
            $fileName = $request->file('category_icon')->getClientOriginalName();
            $request->file('category_icon')->move($destinationPath, $fileName); // uploading file to given path
            if($request->file('pictures') !=null){
                $inputs['category_icon'] = $fileName;
            }
        }


        Bp_post::create($inputs);
        return response()->json(['success' => 1]);
    }

    public function edit($id)
    {
        try {
            $page = Bp_post::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Category Not Found';
        }
        $categories= Bp_category::lists('category_name','category_id');
        return view('bp-admin.page.edit', array('page' => $page, 'categories' => $categories));

    }

    public function update($id, Request $request)
    {
        $inputs = $request->all();
     //   $inputs = $request->except('_token', '_method');
        $inputs['post_type'] = 'page';
        if ($request->file('category_icon') && $request->file('category_icon')->isValid()) {
            $destinationPath = uploadPath();
            $extension = $request->file('category_icon')->getClientOriginalExtension(); // getting image extension
            $fileName = 'catmk'.md5(microtime().rand()).'.'.$extension; // renameing image
            $request->file('category_icon')->move($destinationPath, $fileName); // uploading file to given path
            $inputs['category_icon'] = $fileName;
        }

        Bp_post::findOrFail($id)->update($inputs);
        return response()->json(['success' => 1]);
    }

    public function destroy($id)
    {
        Bp_post::find($id)->delete();
        return response()->json(['success' => 1]);
    }

}
