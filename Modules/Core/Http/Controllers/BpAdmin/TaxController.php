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
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Bp_tax;
use Modules\Core\Utils\Limit;
use Modules\Core\Services\TaxService;
use Modules\Core\Transformers\TaxTransformer;


class TaxController extends Controller
{
    protected $service;
    public function __construct(TaxService $service)
    {   
        $this->middleware('auth');
        $this->service = $service;
        $this->transformer = new TaxTransformer;
    }

    public function index(Request $request){     
        $per_page = $request->input('per_page',Limit::NORMAL );
        $query = $this->service->taxonomy($per_page);
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

    public function store(Request $request){
        // $this->validate($request, [
        // 'tax_name' => 'required'
        // ]);
        $inputs = $request->except('tax_id');
        $inputs['tax_link'] = str_replace(' ', '-', strtolower($request->input('tax_name')));
        try {
            $query = Bp_tax::create($inputs);
            return response(['success' =>  sizeof($query) ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Category Not Found';
        }       
    }

    public function update($id, Request $request)
    {
        $inputs = $request->all();
     //   $inputs = $request->except('_token', '_method');
        $inputs['tax_link'] = str_replace(' ', '-', strtolower($request->input('tax_name')));
        Bp_tax::findOrFail($id)->update($inputs);
        return json_encode(['success' => '1']);
    }

    public function destroy($id)
    {
        try {
            Bp_tax::destroy($id);
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return 'Category Not Found';
        }
        
    }

}
