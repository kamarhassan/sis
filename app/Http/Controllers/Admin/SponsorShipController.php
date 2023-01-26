<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;
// use function PHPUnit\Framework\isNull;
use App\Http\Requests\GetStudentsForSponsore;
use App\Http\Requests\SponsorFee\PerStudents;
use App\Models\CoursFee;
use App\Models\Sponsorship;
use App\Models\StudentsRegistration;

class SponsorShipController extends Controller

{
    public function index()
    {
        $sponore = Sponsor::get();

        return view('admin.sponsor-std.index', compact('sponore'));
    }

    public function get_sponsor_ships_to_get_students(GetStudentsForSponsore $request)
    {

        try {

            $sponore = Sponsor::find($request->sponsor);
            $sponsor_id = null;
            if (!$sponore) {
                $message = __('site.this sponsore not defined');
                $status = 'error';
                $route = "#";
                $sponsore_ship = "";
            } else {
                $array_of_data = [
                    'sponsorships.id as sponsorships_id', 'courss.id as cours_id', 'courss.act_EndDa as end_date', 'courss.act_StartDa as start_date',
                    'levels.level as level', 'grades.grade as grade', 'admins.name as teacher', 'sponsor_id'
                ];
                $sponsore_ship = Sponsorship::where('sponsor_id', $request->sponsor)
                    ->whereNull('is_updated')
                    ->join('courss', 'courss.id', '=', 'sponsorships.cours_id')
                    ->join('grades', 'courss.grade_id', '=', 'grades.id')
                    ->join('levels', 'courss.level_id', '=', 'levels.id')
                    ->JOIN('admins', 'courss.teacher_id', '=', 'admins.id')
                    ->select($array_of_data)
                    ->get();
                if ($sponsore_ship->count() > 0) {
                    $message = __('site.this sponsore not defined');
                    $status = 'success';
                    $route = "#";
                    $sponsor_id =       $request->sponsor;
                    // return $sponsore_ship;
                } else {
                    $message = __('site.this sponsore not defined');
                    $status = 'error';
                    $route = route('admin.edit.sponsor.fee.for.students');
                    $sponsore_ship = "";
                }
            }
            return response()->json([
                'message' => $message,
                'status' => $status,
                'route' => $route,
                'sponsor_id' =>  $sponsor_id,
                'sponsore_ship' => $sponsore_ship

            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }




    public function get_students_for_sponsor(Request $request)
    {
        //  return $request;
        // return $request->sponsor_ships;
        $sponsore_ship_id = explode(',', $request->sponsor_ships)[1];
        $sponsor_id = Sponsorship::find($sponsore_ship_id)['sponsor_id'];
        $std = StudentsRegistration::where('sponsorship_id', $sponsore_ship_id)->with('student')->get();

        $cours_id = explode(',', $request->sponsor_ships)[0];
        $cours_fee_total = CoursFee::where('cours_id',  $cours_id)->sum('value');
        $cours_fee_type = CoursFee::where('cours_id',  $cours_id)->with('fee_type')->get();
        if ($std->count() > 0) {
            // return $std;
            switch ($request->discount) {
                case 'same_discount':

                    $data = $this->dataset_students_sponsored_all_same_discount($std, $cours_fee_total);
                    $dataSet = $data['dataset'];
                    $discount_is = $request->discount;
                 
                    $first_row = $data['first_row'];
                  
                    $button =   ' <div id="btn_submit">
                            <a id="submit_btn"
                                onclick="submit(\'' . route('admin.create.same.sponsor.fee.for.students') . '\',\'update_or_new_sponsored\')"
                                class="btn text-success fa fa-pencil hover  hover-primary">
                                <span>' . __('site.save') . '</span>
                            </a>
                        </div>';
                    break;

                case 'diff_discount':
                    $dataSet = $this->dataset_students_sponsored_different_discount($std, $cours_fee_type);
                   
                    $discount_is = $request->discount;
                    $first_row = $this->get_fee_type($cours_fee_type);
                    $button = '<div id="btn_submit">
                                         <a id="submit_btn"
                                             onclick="submit(\'' . route('admin.create.sponsor.fee.for.students') . '\',\'update_or_new_sponsored\')"
                                             class="btn text-success fa fa-pencil hover  hover-primary">
                                             <span>' . __('site.save') . '</span>
                                         </a>
                                </div>';

                    break;

                default:
                    # code...
                    break;
            }
            $status = 'success';
        }
        return response()->json([
            'status' => $status,
            'cours_fee_total' => $cours_fee_total,
            'dataset' => $dataSet,
            'first_row' => $first_row,
            // 'route' => $route,
            'button' => $button,
            'discount_is' => $discount_is,
            'sponsor_id' => $sponsor_id,
            'cours_id' => $cours_id
        ]);
    }


    private function  dataset_students_sponsored_all_same_discount($std, $cours_fee_total)
    {

        // return $std;
        $dataset = [];
        $first_row = "<div id='first_row'> <div class='row' id='same_sponsore_all_std'>" .
            /**
             *  zero in field it represent same discount to all students 
             * 
             */
            "<div class='col-md-4'><label>" . __('site.percent') . "</label><input type='number' class='form-control' onchange='calculate_discount(0 ,{$cours_fee_total});' " .
            "  id='percent_0' name='percent_all_same_percent_' ></div>" .
            "<div class='col-md-4'><label>" . __('site.discount') . "</label><input type='number' class='form-control' onchange='calculate_percent(0 ,{$cours_fee_total});' " .
            " id='discount_0' name='discount_all_same_discount_'></div>" .
            "<div class='col-md-4'><label>" . __('site.remaining') . "</label><br><span class='text-warning' id='remaining_0'></span></div>" .
            "</div></div>";
        foreach ($std as $key => $value) {

            $dataset[] = [
                // 'register_id' => "<input type='number' id='registration_id{$value['id']}' name='registration_id_[{$value['id']  }]' >",
                'student_id' => $value['student'][0]['id'],
                'student_name' => $value['student'][0]['name'],
                'student_percent' => " "
                    . "<input type='hidden' id='registration_id{$value['id']}' value='{$value['id']}' name='registration_id_[{$value['id']}]' ></div>" .
                    " <span class='text-warning' id='percent_{$value['student'][0]['id']}_'></span>",
                'student_discount' => "<span class='text-warning' id='discount_{$value['student'][0]['id']}_'></span>",
                'remaining' => "  <span class='text-warning' id='remaining_{$value['student'][0]['id']}'></span>",
            ];
        }
        return ['dataset' => $dataset, 'first_row' => $first_row];
    }


    private function get_fee_type($cours_fee_type)
    {
        $array_fee_type = null;
        $array_fee_type  = '<div id="first_row"><div class="demo-checkbox">';
        $array_id_checkbox = [];
        foreach ($cours_fee_type as $key => $value_cours_fee) {

            $array_id_checkbox[] = $value_cours_fee['id'] . $value_cours_fee['value'];
            $array_fee_type .= '<input type="checkbox" name="fee_selected[]" id="cours_fee' . $value_cours_fee['id'] .'" class="chk-col-warning" value="' . $value_cours_fee['value']/*value of fee*/ . '_' . $value_cours_fee['id'] ./*id of fee*/ '" />';
            $array_fee_type .= '<label for="cours_fee' . $value_cours_fee['id'] .  '">' . $value_cours_fee['fee_type']['fee'] . ' - ' . $value_cours_fee['value'] . '</label>';
        }
        $array_fee_type  .= '<span class="text-danger" id="select_one_of_fee_' . $value_cours_fee['id'] . '" hidden>' . __('site.only select') . '</span></div></div>';
  return $array_fee_type;
    }

    private function  dataset_students_sponsored_different_discount($std, $cours_fee_type)
    {
        $dataset = [];
        $i = 0;
      
        foreach ($std as $key => $value) {
            // return $value;

            $dataset[] = [
                // 'register_id' => "<input type='number' id='registration_id{$value['id']}' name='registration_id_[{$value['id']  }]' >",
                'student_id' => $value['student'][0]['id'],
                'student_name' => $value['student'][0]['name'] . ' - ' . $value['id'],
                // 'fee_type' => '<div class="demo-checkbox">' . $array_fee_type . '</div>',
                // 'student_percent' => "<div class='row'><input type='number'  style='width:97%'   onchange='calculate_discount({$value['student'][0]['id']},{$value['cours_fee_total']});'   id='percent_{$value['student'][0]['id']}' name='percent[{$value['student'][0]['id']}]' > "
                'student_percent' => "<div class='row'><input type='number'  style='width:97%'   onchange='calculate_discount({$value['id']}," . json_encode($cours_fee_type) . ");'   id='percent_{$value['id']}' name='percent[{$value['id']}]' > "
                    . "<input type='hidden' id='registration_id{$value['id']}' value='{$value['id']}' name='registration_id_[{$value['id']}]' ></div> <span class='text-danger' id='percent_{$value['id']}_'></span>",
                'student_discount' => "<div class='row'><input type='number'  style='width:97%'   onchange='calculate_percent({$value['id']}," . json_encode($cours_fee_type) . ");' id='discount_{$value['id']}' name='discount[{$value['id']}]' > </div> <span class='text-danger' id='discount_{$value['id']}_'></span>",
                'remaining' => "  <span class='text-warning' id='remaining_{$value['id']}'></span>",
            ];
            // $array_fee_type = null;
        }
        return $dataset;
    }


    public function create_same_sponsore_fee_for_students(Request $request)
    {
        return $request;
    }
    public function create_sponsor_fee_for_students(PerStudents $request)
    {
        return $request;
        try {
            DB::beginTransaction();

            $discount        = $request->discount;
            $percent         = $request->percent;
            $registration_id = $request->registration_id_;
            $new_sponsor_ships = [];
            $status = '';
            if ((count($discount) == count($percent)) == count($registration_id)) {
                $temp = count($discount);
                foreach ($discount as $i => $value) {
                    $new_sponsor_ships[] = Sponsorship::create([
                        'sponsor_id' => $request->sponsor_id,
                        'cours_id' => $request->cours_id,
                        'discount' => $discount[$i],
                        'percent' => $percent[$i],
                    ]);
                }
                // return  $new_sponsor_ships;
                $new_sopnsor_ship_index = 0;
                foreach ($registration_id as $key => $value) {
                    $std =  StudentsRegistration::find($registration_id[$key]);
                    $discount_calcuated = $std['cours_fee_total'] * ($new_sponsor_ships[$new_sopnsor_ship_index]['percent'] / 100); //($new_sponsor_ships[$new_sopnsor_ship_index]['discount'] * 100) / $std['cours_fee_total'];
                    // cours_fees * (percent / 100)
                    $remaining = $std['cours_fee_total'] - $discount_calcuated;
                    $std_update =  $std->update(['remaining' =>  $remaining, 'sponsorship_id' => $new_sponsor_ships[$new_sopnsor_ship_index]->id]);
                    if (!$std_update) {
                        $status = 'error';
                        break;
                    }
                    $status = 'success';
                    $new_sopnsor_ship_index++;
                }
                DB::commit();
                return response()->json([
                    'message' => '$message',
                    'status' => $status,
                    'route' => '$route',
                    // 'sponsor_id' =>  $sponsor_id,
                    // 'sponsore_ship' => $sponsore_ship

                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }




    public function edit_sponsor_fee_for_students()
    {

        return view('admin.sponsor-std.edit-sponsor-fee-for-students');
    }
}
