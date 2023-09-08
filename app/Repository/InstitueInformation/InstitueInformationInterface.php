<?php

namespace App\Repository\InstitueInformation;

interface InstitueInformationInterface 
{
    public function InstitueInformation();
    public function InstitueInformation_by_id($id);
    public function InstitueInformation_by_ids(array $id);
    public function DeleteByID($id);
    public function store($request);
    public function edit($request);
  

}
