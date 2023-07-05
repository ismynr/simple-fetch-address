<?php 
namespace App\Domains\SearchProvider;

interface SearchProviderInterface {

    /**
     * Get data all provinces
     *
     * @return array
     */
    public function getAllProvinces(): array;

    /**
     * Get single data province by id
     *
     * @param string $id
     * @return object
     */
    public function getSingleProvince($id): object|null;

    /**
     * Get data all cities
     *
     * @return array
     */
    public function getAllCities(): array;

    /**
     * Get single data city
     *
     * @param string $id
     * @return object
     */
    public function getSingleCity($id): object|null;
}