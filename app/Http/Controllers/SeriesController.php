<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];

        // Passando array de dados
        //return view('listar-series', ['series' => $series]);

        // Passando um compact - utilizado quando o nome e variável são iguais
        //return view('listar-series',compact('series'));

        // Passando um with
        return view('listar-series')->with('series', $series);
    }
}
