<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


class CountryFileCsvImporter extends CountryFileImporter
{

    public function updateDatabase()
    {
        $content = $this->file->getContent();
        $rows = str_getcsv($content, "\n");

        foreach ($rows as $i => $row) {

            /** Skip headers */
            if ($i === 0) {
                continue;
            }

            $data = str_getcsv($row, ',');
            $this->storeCountry($data[0], $data[1]);
        }
    }
}
