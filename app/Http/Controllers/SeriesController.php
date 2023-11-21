<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $repository)
    {
        
    }

    public function index(Request $request)
    {
        $series = Series::all();

        //utilizando o helper de sessões
        $mensagemSucesso = session('mensagem.sucesso');

        // Passando um with
        return view('series.index')->with('series', $series)->with('mensagemSucesso',$mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    //public function store(SeriesFormRequest $request, SeriesRepository $repository)
    public function store(SeriesFormRequest $request)
    {
        //Validação sem FORM REQUEST
        //$request->validate([
        //   'nome' => ['required','min:3']
        //]);

        //DB::transaction( function() use ($request, &$serie) { // utilizar um return para não ser necessário criar variavel dentro e fora da transaction
        
        //try {
           //$serie = DB::transaction( function() use ($request) {

            //$serie = Series::create($request->all());

        //$serie = $repository->add($request);
        $serie = $this->repository->add($request);

            return to_route('series.index')
                ->with('mensagem.sucesso',"Série '{$serie->nome}' adicionada com sucesso"); // no laravel 9

       // } catch (\Throwable $e) {
            
        //}

    }

    public function destroy(Series $series)
    {
        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso',"Série '{$series->nome}' removida com sucesso"); //melhor opcao, with também envia flash message. Com isso descartamos a necessidade da request
    }

    public function edit (Series $series)
    {
        return view('series.edit')->with('serie',$series);
    }

    public function update (Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso',"Série '$series->nome' atualizada com sucesso");
    }

}
