<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //return $request->get('id');
        //return $request->getUri();
        //return $request->method();
        //return response('', 302, ['Location' => 'https://google.com']);
        //return redirect('https://google.com');

        $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];

        // Passando array de dados
        //return view('listar-series', ['series' => $series]);

        // Passando um compact - utilizado quando o nome e variável são iguais
        return view('listar-series',compact('series'));
    }
}
