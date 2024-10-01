<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $sensorData = SensorData::create($request->all());
        return response()->json($sensorData, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
      // Crear una consulta inicial para SensorData
            // Crear una consulta inicial para SensorData
        $query = SensorData::query();

        // Filtrar por los parámetros si están presentes
        if ($request->has('sensor')) {
            $query->where('sensor', 'like', '%'.$request->query('sensor').'%');
        }

        if ($request->has('device')) {
            $query->where('device', $request->query('device'));
        }

        if ($request->has('unit')) {
            $query->where('unit', $request->query('unit'));
        }

        // Ordenar los resultados por 'created_at' de más reciente a más antiguo
        $sensorData = $query->orderBy('created_at', 'desc')->get();

        // Retornar la respuesta en formato JSON
        return response()->json($sensorData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
