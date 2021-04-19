<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

abstract class CountryFileExporter
{
    /** @var Collection */
    protected $countries;

    /**
     * @param Collection $countries
     */
    public function setCountries(Collection $countries)
    {
        $this->countries = $countries;
    }

    abstract public function exportAll(): StreamedResponse;
}
