<?php 
namespace App\Http\Infrastructure\SearchProvider;

use App\Domains\SearchProvider\SearchProviderInterface;
use App\Models\City;
use App\Models\Province;

class DatabaseProvider implements SearchProviderInterface {
    /**
     * @inheritDoc
     */
    public function getAllProvinces(): array
    {
        return Province::all()->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getSingleProvince($id): object|null
    {
        return Province::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function getAllCities(): array
    {
        return City::all()->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getSingleCity($id): object|null
    {
        return City::findOrFail($id);
    }
}