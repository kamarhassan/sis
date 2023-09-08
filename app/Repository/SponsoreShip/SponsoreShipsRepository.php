<?php

namespace App\Repository\SponsoreShip;

use App\Models\Sponsorship;

class SponsoreShipsRepository implements SponsoreShipsInterface
{
    public function CreateNewSponsorShip($sponsor_id,$cours_id,$type,$fee_sponsored,$discount,$percent,$note)
    {
        return Sponsorship::create([
            'sponsor_id' =>  $sponsor_id,
            'cours_id' => $cours_id,
            'type' => $type,
            'fee_sponsored' => $fee_sponsored,
            'discount' => $discount,
            'percent' => $percent,
            'note' => $note,
        ]);
    }
    public function calculate_discount_fee_required($fee_required,  $discount, $percentage)
    {
        $new_fee_required_after_discount = $fee_required;


        foreach ($new_fee_required_after_discount as $key_fee_required => $feerequired) {
            // $new_fee_required_after_discount[]
            foreach ($discount as $key_discount => $value) {
                if ($value != null && $feerequired['id'] == $key_discount) {
                    $new_fee_required_after_discount[$key_fee_required]['fee_value'] -= $value;
                }
            }
        }
        return         $new_fee_required_after_discount;


        // return ['new_fee_required_after_discount' => $new_fee_required_after_discount, 'fee_required' => $fee_required, 'discount' => $discount, 'percentage' => $percentage];
    }
}
