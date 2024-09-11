<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Generacion;
use App\Models\Informacion;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $usuarios = User::all();
        $informacions = Informacion::all();
        $inscripcions = Inscripcion::all();
        $areas = Area::all();
        $generacions = Generacion::all();
        return view('index',['usuarios'=>$usuarios,'informacions'=>$informacions, 
                            'inscripcions'=>$inscripcions, 'areas'=>$areas, 
                            'generacions'=>$generacions]);
        
    }
}
