<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        // Utilizando Models do próprio Laravel
        //$series = Serie::all();

        // query é um query builder ou criador de query do eloquent
        $series = Serie::query()->orderBy('nome')->get();

        // Facades DB - Fornece acesso direto ao BD - Não funciona created_at e updated_at
        //$series = DB::select('select * from series');

        // Passando array de dados
        //return view('listar-series', ['series' => $series]);

        // Passando um compact - utilizado quando o nome e variável são iguais
        //return view('listar-series',compact('series'));

        // Passando um with
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        //$nomeSerie = $request->input('nome');
        
        /*
        // Facades DB - Fornece acesso direto ao BD - Não funciona created_at e updated_at
        DB::insert('insert into series (nome) values (?)', [$nomeSerie]);
        */
        
        /*
        // Utilizando Models do próprio Laravel
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();
        */

        // MASS ASSIGNEMENT - Atribuição em massa de vários campos ao mesmo tempo
        //dd($request->all());
        //Serie::create(['nome' => 'Teste']);

        Serie::create($request->all());

        //return redirect('/series');
        //return redirect()->route('series.index');

        return to_route('series.index'); // no laravel 9
    }

}
