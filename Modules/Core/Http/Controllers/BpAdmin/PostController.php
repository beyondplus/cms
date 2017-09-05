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
use Modules\Core\Entities\Bp_tax;
use Modules\Core\Entities\Bp_lanugages;
use Modules\Core\Entities\Bp_post;
use Modules\Core\Entities\Bp_relationship;
use Modules\Core\Models\User;
use Modules\Core\Utils\Limit;
use Modules\Core\Services\PostService;
use Modules\Core\Transformers\PostTransformer;
use Auth;

class PostController extends Controller
{
    var $categories;
    protected $service;
    public function __construct(PostService $service)
    {   
        $this->middleware('auth');
        $this->service = $service;
        $this->transformer = new PostTransformer;
        $this->categories=  Bp_tax::where('tax_type','category')->get();
    }

    public function index(Request $request){
        $per_page = $request->input('per_page',Limit::NORMAL );
        $query = $this->service->post($per_page);
        return $this->transformer->transform($query);
    }

    public function create(){
        $categories= Bp_tax::where('tax_type','category')->all();
       return view('bp-admin.post.add', array('categories' => $this->categories));

    }

    public function imageUpload(Request $request){
        // $this->validate($request, [
        //     'featured_img' => 'required|mimes:jpg,jpeg,bmp,png,mp4,mp3,webm'
        //     ]);
       // if ($request->file('featured_img') && $request->file('featured_img')->isValid()) {
            $destinationPath = public_path().'/uploads';
            $extension = $request->file('featured_img')->getClientOriginalExtension(); // getting image extension
            $fileName = 'postmk'.md5(microtime().rand()).'.'.$extension; // renameing image
            $request->file('featured_img')->move($destinationPath, $fileName); // uploading file to given path
            return ['media' => $fileName];
        // }

        // return ['media' => ''];
    }


    public function show($id){
        $query = $this->service->detail($id);
        return $this->transformer->transformDetail($query);
    }

    public function store(Request $request){
        // $this->validate($request, [
        // 'title' => 'required',
        // 'description' => 'required'
        // ]);
        $inputs = $request->all();
        $inputs['post_link'] = str_replace(' ', '-', strtolower($request->input('title')));
        $inputs['post_type'] = 'post';
        $inputs['staff_id'] = Auth::user()->id;
        Bp_post::create($inputs);

        $update_id = Bp_post::orderBy('id', 'desc')->first();
        $categories  = $request->get('categories');
        for( $i=0; $i<sizeof($categories); $i++){
            $cat['term_id'] = $categories[$i];
            $cat['post_id'] = $update_id->id;
            $cat['type']    = 'cat';
            Bp_relationship::create($cat);
        }

        return response()->json(['success' => 1]);
    }

    public function edit($id)
    {
        try {
            $post = Bp_post::findOrFail($id);
            $term_cat = Bp_relationship::where('post_id',$id)->where('type','cat')->lists('term_id')->toArray();
            //$term_cat = Bp_relationship::where('post_id',$id)->where('type','cat')->get();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Post Not Found';
        }
        return view('bp-admin.post.edit', array('post' => $post, 'categories' => $this->categories , 'term_cat' => $term_cat));

    }

    public function update($id, Request $request)
    {
        $inputs = $request->all();
        $inputs['post_link'] = str_replace(' ', '-', strtolower($request->input('title')));

        Bp_post::findOrFail($id)->update($inputs);

        $categories  = $request->get('categories');
        //Deleteing Term
        if(sizeof($categories)>0){
            Bp_relationship::where('post_id',$id)->where('type','cat')->delete();
        }
        //Recreating New Term
        for( $i=0; $i<sizeof($categories); $i++){
            $cat['term_id'] = $categories[$i];
            $cat['post_id'] = $id;
            $cat['type']    = 'cat';
            Bp_relationship::create($cat);
        }
        return response()->json(['success' => 1]);
    }

    public function destroy($id)
    {
        Bp_post::find($id)->delete();
        return response()->json(['success' => 1]);
    }

}
