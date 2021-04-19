<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    /** @var string */
    protected $model;

    public function getQueryBuilder(): Builder
    {
        return $this->model::query();
    }
}
