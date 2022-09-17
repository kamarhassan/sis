<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeTypeRequest;
use App\Repository\Fee_Type\Fee_TypeInterface;

use Illuminate\Http\Request;

class FeetypeController extends Controller
{

    protected $fee_type;

    public function __construct(Fee_TypeInterface $fee_type)
    {
        $this->fee_type = $fee_type;
    }

    public  function index()
    {
        $fee_type = $this->fee_type->get_all();
        return view('admin.setup.feetype.index', compact('fee_type'));
    }

    public  function store(FeeTypeRequest $request)
    {
        try {
            $store_dee_type = $this->fee_type->store_fee_type($request);
            if ($store_dee_type) {

                return   response()->json(['status' => 'success', 'message' => __('site.fee type created successfully!')]);
            } else {

                return   response()->json(['status' => 'error', 'message' => __('site.failed to create fee type')]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public  function delete($fee_types_id)
    {
        try {
            $it_used = $this->fee_type->it_is_used($fee_types_id);
            if (!$it_used)
                return "not used";  // can delete it 
            return "used"; // can't delete it 
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
