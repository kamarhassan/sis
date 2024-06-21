<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/10/2022
 * Time: 1:23 PM
 */

namespace App\Repository\Cours;


use App\Models\Cours;
use App\Models\Currency;
use App\Models\StudentsRegistration;


class CoursRepository implements CoursInterface
{

   public function all_cours()
   {

      // TODO: Implement all_cours() method.
      $array_of_data = [
         'courss.id',
         'courss.status as status',
         'admins.name as teacher',
         'courss.startDate',
         'courss.endDate',
         'courss.act_StartDa',
         'courss.act_EndDa',
         'courss.startTime',
         'courss.endTime',
         'courss.categorie_id',
         'categories.name as category_name',
         'levels.level',
         'grades.grade',

      ];
      return Cours::join('categories', 'categorie_id', '=', 'categories.id')
         ->join('grades', 'grade_id', '=', 'grades.id')
         ->join('levels', 'level_id', '=', 'levels.id')
         ->JOIN('admins', 'teacher_id', '=', 'admins.id')
         ->where('year', current_school_year()['year'])
         ->orderBy('courss.id', 'asc')
         ->get($array_of_data);
   }

   public function store_cours($request, $teacher_id)
   {
      $teacher_can_add_std = 0;
      if ($request->has('teacher_can_add_std')) {
         $teacher_can_add_std = 1;
      }

      // TODO: Implement all_cours() method.

      $saved = Cours::create([
         'startDate' => $request->start_date,
         'categorie_id' => $request->main_categories,
         'endDate' => $request->end_date,
         'maxStd' => $request->max_std_number,
         'status' => $request->status,
         'teacher_id' => $teacher_id,
         // 'teacherFee' => $request->teacher_fee,
         'duration' => $request->duration,
         'total_hours' => $request->total_hours,
         'currencies_id' => $request->cours_currency,
        'description' => '',
         'startTime' => $request->start_time,
         'endTime' => $request->end_time,
         'days' => Cours::save_day_of_week($request->days),
         'act_StartDa' => $request->ac_start_date,
         'act_EndDa' => $request->ac_end_date,
         'year' => current_school_year()['year'],
//            'grade_id' => Grade::GetIdByName($request->grade),
//            'level_id' => Level::GetIdByName($request->level),
         'teacher_can_add_students' => $teacher_can_add_std,
//            'categories_id' => $request->categories,
         'institue_information_id' => $request->institue_informations,

      ]);
      // dd($saved->id);
      return $saved->id;
   }


   public function update_cours($request, $teacher_id, $cours_id)
   {

      $cours = Cours::find($cours_id);
      if (!$cours)
         return false;

      $teacher_can_add_std = 0;
      if ($request->has('teacher_can_add_std')) {
         $teacher_can_add_std = 1;
      }

      $cours_updated = $cours->update([
         'startDate' => $request->start_date,
         'categorie_id' => $request->main_categories,
         'endDate' => $request->end_date,
         'maxStd' => $request->max_std_number,
         'status' => $request->status,
         'teacher_id' => $teacher_id,
         // 'teacherFee' => $request->teacher_fee,
         'duration' => $request->duration,
         'total_hours' => $request->total_hours,
         'currencies_id' => $request->cours_currency,
         // 'description' => $request->description,
         'startTime' => $request->start_time,
         'endTime' => $request->end_time,
         'days' => Cours::save_day_of_week($request->days),
         'act_StartDa' => $request->ac_start_date,
         'act_EndDa' => $request->ac_end_date,
         'year' => current_school_year()['year'],
//            'grade_id' => Grade::GetIdByName($request->grade),
//            'level_id' => Level::GetIdByName($request->level),
         'teacher_can_add_students' => $teacher_can_add_std,
//            'categories_id' => $request->categories,
         'institue_information_id' => $request->institue_informations,

      ]);
      return $cours_updated;
   }


   public function open_and_postopen_cours($limit = null)
   {
      $cours = Cours::wherehas('fee')->where('year', last_school_year()['year'])->where('status', '1')->orWhere('status', '2')
         ->with('category_grade_level', 'teacher_name')->get();
      if ($limit != null)
          $cours->take($limit) ;

      return $cours;
   }


   public function cours_fee_currency($cours_currency_id)
   {

      //  $cours_fee = CoursFee::where('cours_id', $cours_id)->get();
      //   $cours_fee->count();
      //  if ($cours_fee->count()==0)
      //     return false;
      $cours_curency = Currency::find($cours_currency_id);
      if ($cours_curency)
         return $cours_curency;
      return false;
   }

   public function cours_theacher_name($cours)
   {
      if (!$cours)
         return false;
      return $theacher_name = $cours->teacher_name;
   }

   public function is_defined($id)
   {
      $cours = Cours::find($id);
      if (!$cours)
         return false;
      return $cours;
   }

   public function count_students_in_cours($cours_id)
   {
      return StudentsRegistration::where('cours_id', $cours_id)->get()->count();
   }

   public function cours_of_teacher_with_registartion_students($teacher_id)
   {

      $cours_of_teacher = Cours::where('teacher_id', $teacher_id)
         ->where('year', current_school_year()['year'])->with('category_grade_level')->get();

      if ($cours_of_teacher)
         return $cours_of_teacher;
      return false;
   }

   public function cours_of_teacher_super_admin_loged(array $teacher_id)
   {
      $cours_of_teacher = Cours::whereIn('teacher_id', $teacher_id)
         ->where('year', current_school_year()['year'])->with('category_grade_level')->get();
      if ($cours_of_teacher)
         return $cours_of_teacher;
      return false;
   }

   public function cours_for_export()
   {


      // return $this->   cours_fee_currency(13);


      $array_of_data = [
         'courss.id as  id',
         'courss.status   as status',
         'admins.name  as teacher',
         'courss.act_StartDa as  start_date',
         'courss.act_EndDa  as end_date',
         'levels.level as level',
         'grades.grade as grade',
         'cours_fees.id as cours_fees_id',
         'fee_types.fee as fee_type',
         'currencies.id as currencies_id',
         'currencies.symbol as currencies_symbol',
         'currencies.abbr as currencies_abbr',
         'cours_fees.id as cours_fees_id',

      ];
      return $collect = Cours::join('grades', 'grade_id', '=', 'grades.id')
         ->join('levels', 'level_id', '=', 'levels.id')
         ->JOIN('admins', 'teacher_id', '=', 'admins.id')
         ->JOIN('cours_fees', 'courss.id', '=', 'cours_fees.cours_id')
         ->JOIN('fee_types', 'fee_types_id', '=', 'fee_types.id')
         ->JOIN('currencies', 'cours_fees.currencies_id', '=', 'currencies.id')
         ->where('year', current_school_year()['year'])
         ->where('courss.status', '1')
         ->orWhere('courss.status', '2')
         ->orderBy('courss.id', 'asc')
         ->get($array_of_data);


      return array_values($collect);
      //  return  array_values ($collect->groupBy('id')->all());


      return Cours::where('status', '1')
         ->orWhere('status', '2')
         ->with('grade', 'teacher_name', 'level', 'fee_with_type_currency')->get();
   }


   public function cours_of_teacher($teacher_id)
   {
      return Cours::where('teacher_id', $teacher_id)->get();
   }
}// end of class
