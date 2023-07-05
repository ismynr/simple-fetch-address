<?php 
namespace App\Http\Infrastructure\SearchProvider;

use App\Domains\SearchProvider\SearchProviderInterface;
use App\Helpers\APIClient;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Log;

class ApiDataProvider implements SearchProviderInterface {
    protected $apiClient;
    
    /**
     * Constructor
     * 
     */
    public function __construct(APIClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @inheritDoc
     */
    public function getAllProvinces(): array
    {
        $getProvince = $this->apiClient
            ->setUrl('starter', 'province')
            ->setParams(['key' => env('RAJA_ONGKIR_KEY')])
            ->fetchData();

        return array_map(function ($row) {
            return [
                'id' => $row['province_id'],
                'name' => $row['province'],
            ];
        }, $getProvince['rajaongkir']['results']);
    }

    /**
     * @inheritDoc
     */
    public function getSingleProvince($id): object|null
    {
        $getCity = $this->apiClient
            ->setUrl('starter', 'province')
            ->setParams([
                'key' => env('RAJA_ONGKIR_KEY'),
                'id' => $id
            ])
            ->fetchData();
    
        $result = $getCity['rajaongkir']['results'];
        $province = new Province();
        $province->setAttribute('id', $result['province_id']);
        $province->setAttribute('name', $result['province']);
        return $province;
    }

    /**
     * @inheritDoc
     */
    public function getAllCities(): array
    {
        $getCity = $this->apiClient
            ->setUrl('starter', 'city')
            ->setParams(['key' => env('RAJA_ONGKIR_KEY')])
            ->fetchData();

        return array_map(function ($row) {
            return [
                'id' => $row['city_id'],
                'province_id' => $row['province_id'],
                'name' => $row['city_name'],
                'type' => $row['type'],
                'postal_code' => $row['postal_code'],
            ];
        }, $getCity['rajaongkir']['results']);
    }

    /**
     * @inheritDoc
     */
    public function getSingleCity($id): object|null
    {
        $getCity = $this->apiClient
            ->setUrl('starter', 'city')
            ->setParams([
                'key' => env('RAJA_ONGKIR_KEY'),
                'id' => $id
            ])
            ->fetchData();
        
        $result = $getCity['rajaongkir']['results'];
        $city = new City();
        $city->setAttribute('id', $result['city_id']);
        $city->setAttribute('province_id', $result['province_id']);
        $city->setAttribute('name', $result['city_name']);
        $city->setAttribute('type', $result['type']);
        $city->setAttribute('postal_code', $result['postal_code']);
        return $city;
    }
}