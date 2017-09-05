<?php

namespace Modules\Core\Http\Controllers\BpAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function __construct()
    {
      $this->middleware('adminRole');
    }

    public function index(){
      return view('backend/index');
    }
    
    public function search(){
      return view('backend/search');
    }
}
