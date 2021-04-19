<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportCountryRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Requests\UploadCountriesFileRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Repositories\CountryRepository;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class CountryController extends Controller
{
    /** @var CountryService */
    private $service;

    /** @var CountryRepository */
    private $repository;

    /**
     * CountryController constructor.
     * @param CountryService $service
     * @param CountryRepository $repository
     */
    public function __construct(CountryService $service, CountryRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Page with countries application
     *
     * @return View
     */
    public function app()
    {
        return view('index');
    }

    /**
     * Country list response
     *
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(
            CountryResource::collection($this->repository->list())
        );
    }

    /**
     * Upload file with country data and update database
     *
     * @param UploadCountriesFileRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function storeFile(UploadCountriesFileRequest $request): JsonResponse
    {
        $this->service->importFile($request->file('countries'));

        return response()->json('OK');
    }

    /**
     * Add new country to db
     *
     * @param StoreCountryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCountryRequest $request): JsonResponse
    {
        $this->service->addCountry($request->validated());

        return response()->json('OK');
    }

    /**
     * Update existing country in db
     *
     * @param UpdateCountryRequest $request
     * @param Country $country
     * @return JsonResponse
     */
    public function update(UpdateCountryRequest $request, Country $country): JsonResponse
    {
        $this->service->updateCountry($country, $request->validated());

        return response()->json('OK');
    }

    /**
     * Remove country from db
     *
     * @param Country $country
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        $this->service->removeCountry($country);

        return response()->json('OK');
    }

    public function export(ExportCountryRequest $request)
    {
        return $this->service->exportCountries($request->get('format'));
    }
}
