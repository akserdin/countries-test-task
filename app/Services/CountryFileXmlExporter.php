<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


use DOMDocument;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CountryFileXmlExporter extends CountryFileExporter
{
    /**
     * @return StreamedResponse
     */
    public function exportAll(): StreamedResponse
    {
        $fileName = 'countries.xml';

        return response()->streamDownload(function() {
            $xml = new DOMDocument();

            $xml->encoding = 'utf-8';
            $xml->formatOutput = true;
            $xml->xmlVersion = '1.0';
            $root = $xml->createElement('root');
            $xml->appendChild($root);

            $this->countries->each(function($c) use($xml, $root) {
                $el = $xml->createElement('element');

                $capital = $xml->createElement('capital', $c->capital);
                $country = $xml->createElement('country', $c->name);

                $el->appendChild($capital);
                $el->appendChild($country);
                $root->appendChild($el);
            });

            echo $xml->saveXML();

        }, $fileName);
    }
}
