<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    // Fetch provinces
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => config('app.rajaongkir_api_key')
        ])->get('https://api.rajaongkir.com/starter/province');

        return response()->json($response->json());
    }

    // Fetch cities based on province
    public function getCities(Request $request)
    {
        $provinceId = $request->query('province');

        $response = Http::withHeaders([
            'key' => config('app.rajaongkir_api_key')
        ])->get('https://api.rajaongkir.com/starter/city?province='.$provinceId);

        return response()->json($response->json());
    }

    // Fetch cost based on origin, destination, weight, and courier
    public function getCost(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $courier = $request->input('courier');


        $response = Http::withHeaders([

            'key' => config('app.rajaongkir_api_key')
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return response()->json($response->json());
        }
}

