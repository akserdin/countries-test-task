<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Enums;


use ReflectionClass;

class Enum
{
    /**
     * @return array
     */
    public static function list(): array
    {
        $currentClass = new ReflectionClass(static::class);

        return $currentClass->getConstants();
    }

}
