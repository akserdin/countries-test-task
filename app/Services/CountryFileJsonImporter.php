<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


class CountryFileJsonImporter extends CountryFileImporter
{
    public function updateDatabase()
    {
        $content = $this->file->getContent();
        $items = json_decode($content, true);

        foreach ($items as $data) {
            $this->storeCountry($data['country'], $data['capital']);
        }
    }
}
