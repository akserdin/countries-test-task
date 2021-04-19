<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Repositories;


use App\Models\Country;
use Illuminate\Support\Collection;

class CountryRepository extends BaseRepository
{
    /**
     * CountryRepository constructor.
     */
    public function __construct()
    {
        $this->model = Country::class;
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->getQueryBuilder()
            ->orderBy('name')
            ->get();
    }
}
