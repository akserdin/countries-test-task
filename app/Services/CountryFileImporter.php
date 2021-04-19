<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


use App\Models\Country;
use Illuminate\Http\UploadedFile;

abstract class CountryFileImporter
{
    protected $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    abstract public function updateDatabase();

    protected function storeCountry(string $countryName, string $countryCapital)
    {
        Country::updateOrCreate([
            'name' => $countryName,
            'capital' => $countryCapital
        ]);
    }
}
