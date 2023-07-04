<?php

namespace App\Console\Commands;

use App\Helpers\APIClient;
use App\Models\City;
use App\Models\Province;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InsertAddressFromRajaOngkir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-address-from-raja-ongkir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert Provinces & Cities Data to Database From Raja Ongkir (Restore Data)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create Instance for API Request
        $apiClient = new APIClient();

        // Truncate records
        City::query()->delete();
        Province::query()->delete();

        /**
         * Get API Province from Raja Ongkir
         * 
         */
        $getProvince = $apiClient
            ->setUrl('starter', 'province')
            ->setParams(['key' => env('RAJA_ONGKIR_KEY')])
            ->fetchData();

        // Build & Insert Data to Database
        $transformedToProvincesModel = array_map(function ($row) {
            return [
                'id' => $row['province_id'],
                'name' => $row['province'],
            ];
        }, $getProvince['rajaongkir']['results']);

        Province::insert($transformedToProvincesModel);

        /**
         * Get API City from Raja Ongkir
         * 
         */
        $getCity = $apiClient
            ->setUrl('starter', 'city')
            ->setParams(['key' => env('RAJA_ONGKIR_KEY')])
            ->fetchData();
        
        // Build & Insert Data to Database
        $transformedToCitiesModel = array_map(function ($row) {
            return [
                'id' => $row['city_id'],
                'province_id' => $row['province_id'],
                'name' => $row['city_name'],
                'type' => $row['type'],
                'postal_code' => $row['postal_code'],
            ];
        }, $getCity['rajaongkir']['results']);

        City::insert($transformedToCitiesModel);
    }
}
