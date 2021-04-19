<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


class CountryFileXmlImporter extends CountryFileImporter
{
    public function updateDatabase()
    {
        $content = $this->file->getContent();
        $xmlObj = simplexml_load_string($content);

        foreach ($xmlObj->element as $xmlItem) {
            $this->storeCountry($xmlItem->country, $xmlItem->capital);
        }
    }

}
