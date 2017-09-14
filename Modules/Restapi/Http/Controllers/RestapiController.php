<?php

namespace Modules\Restapi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Restapi\Entities\Bp_post;
use Modules\Restapi\Entities\Bp_menu;
use Modules\Restapi\Entities\Bp_slider;

class RestapiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');
        isset($per_page)? : $per_page = 10;
        return bp_post::limit($per_page)->get();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function menu(Request $request)
    {
        return bp_menu::where('parent_id','>',0)->with('Post')->limit(10)->get();
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function contact(Request $request)
    {

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function slider()
    {
        return bp_slider::limit(10)->get();
    }

}
