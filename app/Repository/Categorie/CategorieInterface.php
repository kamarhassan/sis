<?php

namespace App\Repository\Categorie;

interface CategorieInterface
{

    public function all_categorie_id_name();
    public function all_categorie_id_name_by_ids(array $id);
    public function all_categorie($limit = null);
}
