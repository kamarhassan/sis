<?php

namespace App\Repository\InstitueInformation;

use App\Models\InstitueInformation;

class InstitueInformationRepository implements InstitueInformationInterface
{
    public function InstitueInformation()
    {
        // return  $institue_informations = [
        //     ['id' => 1, 'name' => 'institue 1'],
        //     ['id' => 2, 'name' => 'institue 2'],
        //     ['id' => 3, 'name' => 'institue 3'],
        //     ['id' => 4, 'name' => 'institue 4'],
        //     ['id' => 5, 'name' => 'institue 5'],
        //     ['id' => 6, 'name' => 'institue 6'],
        //     ['id' => 7, 'name' => 'institue 7'],
        // ];



        return InstitueInformation::get();
    }


    public function InstitueInformation_by_ids(array $ids)
    {
        // $collect = collect(

        //     ['id' => 1, 'name' => 'institue 1'],
        //     ['id' => 2, 'name' => 'institue 2'],
        //     ['id' => 3, 'name' => 'institue 3'],
        //     ['id' => 4, 'name' => 'institue 4'],
        //     ['id' => 5, 'name' => 'institue 5'],
        //     ['id' => 6, 'name' => 'institue 6'],
        //     ['id' => 7, 'name' => 'institue 7'],

        // );
        // $t = $collect->whereIn('id', [$ids])->all();

        return InstitueInformation::whereIn('id', $ids)->get();
        // $collection = collect([
        //     ['id' => 1, 'name' => 'institue 1'],
        //     ['id' => 2, 'name' => 'institue 2'],
        //     ['id' => 3, 'name' => 'institue 3'],
        //     ['id' => 4, 'name' => 'institue 4'],
        //     ['id' => 5, 'name' => 'institue 5'],
        //     ['id' => 6, 'name' => 'institue 6'],
        //     ['id' => 7, 'name' => 'institue 7'],
        // ]);

        // $filtered = $collection->whereIn('id', $ids);

        // return  $filtered->all();

        // return $t;
    }

    public function DeleteByID($id)
    {
        return InstitueInformation::find($id)->delete();
    }
    public function InstitueInformation_by_id($id)
    {
        return InstitueInformation::find($id);
    }
    public function store($request)
    {
       return  InstitueInformation::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'city' => $request->city,
            'building' => $request->building
        ]);
    }
    public function edit($request)
    {
       return  InstitueInformation::find($request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'city' => $request->city,
            'building' => $request->building
        ]);
    }




}
