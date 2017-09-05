<?php
/**
 * Created by Beyond Plus <bplusmyanmar@hotmail.com>
 * User: Beyond Plus
 * Date: D/M/Y
 * Time: MM:HH PM
 */
namespace Modules\Core\Http\Controllers\Front;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Entities\Bp_post;
use Modules\Core\Entities\Bp_tax;
use Modules\Core\Entities\Bp_menu;
use Modules\Core\Entities\Bp_relationship;
use Modules\Core\Entities\Bp_options;
use Modules\Core\Entities\User;
use Modules\Core\Entities\Comments;
use App\Http\Requests\PriorityRequest;
use DB;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(){
        $this->themes = Bp_options::where('option_name','theme')->first();
        $this->categories = Bp_tax::where('tax_type','category')->get()->all($arrayName = array('tax_name'));
        $this->post_link = Bp_post::select('post_link','id')->get();
    }

    public function t(){
        return $t = "theme::".$this->themes->option_value.".";
    }

    public function template($query, $templateName) {
        if($query === null){
            abort(404);
        } else {
            $view = ($query->post_template != "default") ? $query->post_template : $templateName; 
                if(view()->exists($this->t().$view)) {
                    $view = $this->t().$view;
                } else {
                    $view = $this->t().$templateName;
                }
            return $view;
        }

        
    }

    public function index(){
        return view($this->t().'index', ['title' => 'home' ,  'categories' => $this->categories,'post_link'=>$this->post_link ]);
    }

    public function menu($name) {
        $query = Bp_menu::where('menu_link',$name)->first();
        if(count($query) > 0){
            $bp_post = Bp_post::where('id',$query->post_id)->first();
              
            $view = $this->template($bp_post, 'single');
            return view($view, ['title' => 'home', 'post' => $bp_post,'post_link'=>$this->post_link ]);

        } else {
           return  $this->detail($name);
        }
    }

    public function detail($name) {
        $bp_post = Bp_post::where('post_link', $name)->first();
        
        $view = $this->template($bp_post, 'single');
        return view($view, ['title' => 'home', 'post' => $bp_post,'post_link'=>$this->post_link ]);
    }

    public function cat($name){
        $bp_cat=Bp_tax::where('tax_type','category')->get();
        $cat_id=Bp_tax::select('tax_id')->where('tax_type','category')->where('category_link',$name)->get()->first();
        if($cat_id === null){
            abort(404);
        } else {
            $term=Bp_relationship::select('post_id')->where('term_id', $cat_id->category_id)->get();
            return view($this->t().'term', ['title' => 'home','bp_cat' => $bp_cat,'post_link'=>$this->post_link , 'term' => $term]);
        }

    }

    // To Do Comment and Search

    // public function comment(Request $request){
    //    $this->middleware('auth');
    //    Qanda::where('que_id','=', $request->input('que_id'))->increment('comment_count', 1);
    //    $inputs = $request->all();
    //    $inputs['customer_id'] = Auth::user()->id;
    //    Comments::create($inputs);
    //     return 1;
    // }

    // public function search($q){
    //     $product= Product::where('name','=',$q)->paginate(10);
    //     return view('front.courses' ,$arrayName = array('courses' =>  $product,'mainCategories'=>$this->mainCategories , 'brands' => $this->brands ));
    // }


}
?>
