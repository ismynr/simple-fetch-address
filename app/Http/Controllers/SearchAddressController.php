<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SearchAddressController extends Controller
{
    public function provinces(Request $request) {
        try {
            $id = $request->query('id');
            $data = ($id) 
                ? Province::find($id)
                : Province::all();

            if (!$data) {
                throw new ModelNotFoundException();
            }

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
                ? City::find($id)
                : City::all();

            if (!$data) {
                throw new ModelNotFoundException();
            }

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
