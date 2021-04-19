<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CountryFileCsvExporter extends CountryFileExporter
{
    /**
     * @return StreamedResponse
     */
    public function exportAll(): StreamedResponse
    {
        $fileName = 'countries.csv';
        $headers = $this->getAttachmentHeaders($fileName);

        return new StreamedResponse(function() {
            $handle = fopen('php://output', 'w');
            /** CSV headers */
            fputcsv($handle, ['Country', 'Capital']);

            $this->countries->each(function($country) use($handle) {
                $values = [$country->name, $country->capital];
                fputcsv($handle, $values);
            });

            fclose($handle);

        }, Response::HTTP_OK, $headers);
    }

    /**
     * @param string $fileName
     * @return string[]
     */
    public function getAttachmentHeaders(string $fileName): array
    {
        return [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;filename="' . $fileName . '"'
        ];
    }
}
