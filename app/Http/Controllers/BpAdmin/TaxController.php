<?php
/**
 * Created by Beyond Plus <bplusmyanmar@hotmail.com>
 * User: Beyond Plus
 * Date: D/M/Y
 * Time: MM:HH PM
 */
namespace Beyondplus\Http\Controllers\BpAdmin;
use Illuminate\Http\Request;

use Beyondplus\Http\Requests;
use Illuminate\Routing\Controller;
use Beyondplus\Models\Bp_tax;


class TaxController extends Controller
{
    public function __construct()
    {
       $this->middleware('admins');
    }
    
	public function index(){

		$tax = Bp_tax::orderBy('tax_name')->paginate(13);
		//return view('bp-admin.tax.index')->with(compact('tax'));
        return view('bp-admin.tax.index', array('tax' => $tax));
	}

	public function create(){
        $taxes= Bp_tax::lists('tax_name','tax_id');
        return view('bp-admin.tax.add', array('taxes' => $taxes));
	}

	public function store(Request $request){
        // $this->validate($request, [
        // 'title' => 'required',
        // 'description' => 'required'
        // ]);

        $inputs = $request->all();
        $inputs['tax_link'] = str_replace(' ', '-', strtolower($request->input('tax_name')));
        if ($request->file('tax_icon') && $request->file('tax_icon')->isValid()) {
            $destinationPath = uploadPath();
            $extension = $request->file('tax_icon')->getClientOriginalExtension(); // getting image extension
            // $fileName = 'catmk'.md5(microtime().rand()).'.'.$extension; // renameing image
            $fileName = $request->file('tax_icon')->getClientOriginalName();
            $request->file('tax_icon')->move($destinationPath, $fileName); // uploading file to given path
            if($request->file('pictures') !=null){
                $inputs['tax_icon'] = $fileName;
            }
        }

      
		Bp_tax::create($inputs);
        return redirect()->to('bp-admin/tax');
	}

	public function edit($id)
    {
        try {
            $tax = Bp_tax::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Category Not Found';
        }
        $taxes= Bp_tax::lists('tax_name','tax_id');
        return view('bp-admin.tax.edit', array('tax' => $tax, 'taxes' => $taxes));
    }


    public function update($id, Request $request)
    {
        $inputs = $request->all();
     //   $inputs = $request->except('_token', '_method');
        $inputs['tax_link'] = str_replace(' ', '-', strtolower($request->input('tax_name')));
        if ($request->file('tax_icon') && $request->file('tax_icon')->isValid()) {
            $destinationPath = uploadPath();
            $extension = $request->file('tax_icon')->getClientOriginalExtension(); // getting image extension
            $fileName = 'catmk'.md5(microtime().rand()).'.'.$extension; // renameing image
            $request->file('tax_icon')->move($destinationPath, $fileName); // uploading file to given path
            $inputs['tax_icon'] = $fileName;
        }

        Bp_tax::findOrFail($id)->update($inputs);
        return redirect()->to('bp-admin/tax');
    }

    public function destroy($id)
    {
        Bp_tax::find($id)->delete();
        return redirect()->back();
    }
   
}
