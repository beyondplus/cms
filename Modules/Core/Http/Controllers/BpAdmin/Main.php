<?php
/**
 * Created by Beyond Plus <bplusmyanmar@hotmail.com>
 * User: Beyond Plus
 * Date: D/M/Y
 * Time: MM:HH PM
 */
namespace Modules\Core\Http\Controllers\BpAdmin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class Main extends Controller
{
    public function login_admin_post(Request $request)
    {
    	$admin = auth()->guard('admin');
    	if($admin->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
    	{
    		return redirect()->intended('bp-admin');
    	} else {
    		return 'information access denied';
    	}
    }

    public function logout()
    {
    auth()->guard('web')->logout();
    return redirect('/');
    }

}
