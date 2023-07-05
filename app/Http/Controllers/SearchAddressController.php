<?php

namespace App\Http\Controllers;

use App\Domains\SearchProvider\SearchProviderInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SearchAddressController extends Controller
{
    private $searchProvider;

    public function __construct(SearchProviderInterface $searchProviderInterface)
    {
        $this->searchProvider = $searchProviderInterface;
    }

    public function provinces(Request $request) {
        try {
            $id = $request->query('id');
            $data = ($id) 
                ? $this->searchProvider->getSingleProvince($id)
                : $this->searchProvider->getAllProvinces();

            return response()->json([
                'error' => false,
                'message' => 'Success',
                'data' => $data
            ], 200);

        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'error' => true,
                'message' => 'Data Not Found'
            ], 404);
        } catch (Exception $ex2) {
            return response()->json([
                'error' => true,
                'message' => $ex2->getMessage()
            ], 500);
        }
    }

    public function cities(Request $request) {
        try {
            $id = $request->query('id');
            $data = ($id) 
                ? $this->searchProvider->getSingleCity($id)
                : $this->searchProvider->getAllCities();

            return response()->json([
                'error' => false,
                'message' => 'Success',
                'data' => $data
            ], 200);

        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'error' => true,
                'message' => 'Data Not Found'
            ], 404);
        } catch (Exception $ex2) {
            return response()->json([
                'error' => true,
                'message' => $ex2->getMessage()
            ], 500);
        }
    }
}
