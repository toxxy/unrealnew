<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\actuators;

class ActuatorsController extends Controller
{
    //
    public function index(){

    }

    //para agregar un nuevo dato de actuador
    public function store(Request $request){
        $actuator = actuators::create($request->all());
        return response()->json($actuator,201);
    }

    //para mostrar las actividades pendientes...
    public function show(Request $request){
        $status = $request->query('status');
        if($status) {
            $actuator =actuators::where('status',$status)->get();
        }
        else{
            $actuator = response()->json([
                'unit' => 'nothing',
            'device' => 'nothing',
            'action' => 'nothing',
            'status' => 'nothing'
            ]);
        }
        return response()->json($actuator);
    }

    public function markAsDone($id){
        $actuator = actuators::find($id);
        if(!$actuator){
            return response()->json([
                'message' => 'Actuator not found'
            ], 404);
        }
        $actuator->status = 'c';
        $actuator->save();

        return response()->json([
            'message' => 'Actuator marked as completed',
            'id' => $id,
            'status' => $actuator->status
        ]);
    }
}
