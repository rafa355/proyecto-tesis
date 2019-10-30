<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OA;

class OAsController extends Controller
{
    public function index()
    {
        $records = OA::with('lom_general', 'lom_clasificacion', 'lom_educativo', 'lom_tecnica')->get();

        return response()->json([
            'success' => true,
            'records' => $records,
        ]);
        
    }
}
