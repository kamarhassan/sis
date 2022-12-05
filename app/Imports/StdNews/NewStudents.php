<?php

namespace App\Imports\StdNews;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;


use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NewStudents implements ToModel,WithHeadingRow
{

    use Importable;
    public function model(array $row)
    {

// dd($row);

        return new User([  
            'segel'             => $row[0],
            'segel_place'       => $row[1], //badel segel place id
            'birthday_place'    => $row[2], //badel segel place id
            'birthday'          => $row[3],
            'phonenumber'       => $row[4],
            'email'             => $row[5],
            'lastname'          => $row[6],
            'midname'           => $row[7],
            'firstname'         => $row[8],
            'name'              => $row[8] . " " . $row[7]  . " " . $row[6],
            'password'          => Hash::make('1234'),



        ]);
    }
}
