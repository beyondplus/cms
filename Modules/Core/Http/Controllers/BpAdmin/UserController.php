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
use App\User;
use Modules\Core\Utils\Limit;
use Modules\Core\Services\UserService;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request){
        $per_page = $request->input('per_page',Limit::NORMAL );
        $query = $this->service->users($per_page);
        return $query;
    }

    public function create(){
        $user = User::orderBy('id', 'DESC')->get();
        return view('bp-admin.user.add')->with(compact('user'));
    }

    public function store(Request $request){
        // $this->validate($request, [
        // 'title' => 'required',
        // 'description' => 'required'
        // ]);

        $inputs = $request->all();
        $inputs['api_token'] = str_random(60);
        $inputs['password'] = bcrypt($request->input('password'));
        return User::create($inputs);
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Product Not Found';
        }

        return $user;
    }


    public function update($id, Request $request)
    {
        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->input('password'));
        $user = User::findOrFail($id)->update($inputs);
        return count($user);
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return count($user);
    }



}
