<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class FillNewExport implements FromCollection
{


    protected $cours;

    /**
     * CoursController constructor.
     * @param $cours
     */
    public function __construct($cours)
    {
        $this->cours = $cours;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {  
        return $this->cours;
    }
}
