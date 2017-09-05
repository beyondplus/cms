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
use Modules\Core\Entities\Bp_options;
use Modules\Core\Services\SettingsService;
use Modules\Core\Utils\Limit;

class SettingsController extends Controller
{
    public function __construct(SettingsService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request){
        $per_page = $request->input('per_page',Limit::SETTINGS );
        $query = $this->service->settings($per_page);
        return $query;
    }


    public function generaledit(Request $request)
    {
        $inputs = $request->except('_token', 'save');
        while ($output = current($inputs)) {
            Bp_options::where('option_name', key($inputs))->update(['option_value' => $inputs[key($inputs)]]);
            next($inputs);
        }
         return response()->json(['success' => $inputs]);
    }


}
