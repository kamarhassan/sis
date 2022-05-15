<?php

namespace App\Traits;

trait Nb_to_Word
{
    function convert_nb_to_word($num)
    {
        $f = new \NumberFormatter(get_Default_language(), \NumberFormatter::SPELLOUT);

       return $word = $f->format($num);

    }
}
