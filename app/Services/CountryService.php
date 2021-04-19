<?php
/*
 * Created by Dmytro Zolotar. on 19/04/2021.
 * Copyright (c) 2021. All rights reserved.
 */

namespace App\Services;


use App\Enums\SupportedExtensionsEnum;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CountryService
{
    /**
     * @param array $data
     */
    public function addCountry(array $data)
    {
        Country::create($data);
    }

    /**
     * @param Country $country
     * @param $data
     */
    public function updateCountry(Country $country, $data)
    {
        $country->update($data);
    }

    /**
     * @param Country $country
     */
    public function removeCountry(Country $country)
    {
        $country->delete();
    }

    /**
     * @param string $format
     * @return StreamedResponse
     */
    public function exportCountries(string $format): StreamedResponse
    {
        $exporter = $this->getCountryFileExporter($format);
        $repository = new CountryRepository();

        $exporter->setCountries($repository->list());

        return $exporter->exportAll();
    }

    /**
     * @param UploadedFile $file
     * @throws \Exception
     */
    public function importFile(UploadedFile $file)
    {
        $this->getCountryFileImporter($file)->updateDatabase();
    }

    /**
     * @param UploadedFile $file
     * @return CountryFileImporter
     * @throws \Exception
     */
    private function getCountryFileImporter(UploadedFile $file): CountryFileImporter
    {
        $ext = $file->getClientOriginalExtension();

        if ($ext === SupportedExtensionsEnum::EXTENSION_JSON) {
            return new CountryFileJsonImporter($file);
        }

        if ($ext === SupportedExtensionsEnum::EXTENSION_CSV) {
            return new CountryFileCsvImporter($file);
        }

        if ($ext === SupportedExtensionsEnum::EXTENSION_XML) {
            return new CountryFileXmlImporter($file);
        }

        throw new \Exception(trans('system.importer-not-found', ['ext' => $ext]));
    }

    /**
     * @param string $format
     * @return CountryFileExporter
     * @throws \Exception
     */
    private function getCountryFileExporter(string $format): CountryFileExporter
    {
        if ($format === SupportedExtensionsEnum::EXTENSION_CSV) {
            return new CountryFileCsvExporter();
        }

        if ($format === SupportedExtensionsEnum::EXTENSION_JSON) {
            return new CountryFileJsonExporter();
        }

        if ($format === SupportedExtensionsEnum::EXTENSION_XML) {
            return new CountryFileXmlExporter();
        }

        throw new \Exception(trans('system.exporter-not-found', ['format' => $format]));
    }

}
