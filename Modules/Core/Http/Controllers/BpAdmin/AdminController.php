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
use Modules\Core\Entities\Bp_post;
use App\Admin;
use App\User;

class AdminController extends Controller
{
	public function __construct()
    {
       $this->middleware('admin');
    }

    public function index()
    {
    	$post = Bp_post::where('post_type','post')->paginate(13);
    	$allUser=Admin::get()->count();

        $latestUser= User::get();
        return view('/bp-admin/home', array('post' => $post , 'allUser' => $allUser, 'latestUser' => $latestUser ));
    }



}
