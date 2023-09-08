<?php

namespace App\Repository\SponsoreShip;

interface SponsoreShipsInterface
{
    public function CreateNewSponsorShip($sponsor_id,$cours_id,$type,$fee_sponsored,$discount,$percent,$note);
    public function calculate_discount_fee_required($fee_required,$discount,$percentage);
}
