<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


use Symfony\Component\HttpFoundation\StreamedResponse;

class CountryFileJsonExporter extends CountryFileExporter
{
    /**
     * @return StreamedResponse
     */
    public function exportAll(): StreamedResponse
    {
        $fileName = 'countries.json';

        return response()->streamDownload(function() {
            echo json_encode($this->countries->map(function($c) {
                return [
                    'country' => $c->name,
                    'capital' => $c->capital
                ];
            })->toArray());
        }, $fileName);
    }
}
