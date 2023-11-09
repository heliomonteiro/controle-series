<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
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
        //$series = Serie::query()->orderBy('nome')->get(); //nao precisa mais disso, pois , foi adicionado no scopo da model a ordenação
        $series = Serie::all(); // com escopo global
        //$series = Serie::active()->get(); //com escopo local
        //$series = Serie::with(['temporadas'])->get(); // ou incluir o with no model para trazer os relacionamentos

dd($series);
        // Facades DB - Fornece acesso direto ao BD - Não funciona created_at e updated_at
        //$series = DB::select('select * from series');

        // Passando array de dados
        //return view('listar-series', ['series' => $series]);

        // Passando um compact - utilizado quando o nome e variável são iguais
        //return view('listar-series',compact('series'));

        //$mensagemSucesso = $request->session()->get('mensagem.sucesso');
        //$request->session()->forget('mensagem.sucesso');                  // desnecessário com o uso do flash message

        //utilizando o helper de sessões
        $mensagemSucesso = session('mensagem.sucesso');

        // Passando um with
        return view('series.index')->with('series', $series)->with('mensagemSucesso',$mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        //Validação sem FORM REQUEST
        //$request->validate([
        //   'nome' => ['required','min:3']
        //]);

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

        $serie = Serie::create($request->all());
        //session(['mensagem.sucesso' => 'Série adicionada com sucesso']); //helper de session não remove da sessão em seguida, portanto usar o flash
        //$request->session()->flash('mensagem.sucesso',"Série '{$serie->nome}' adicionada com sucesso");

        //return redirect('/series');
        //return redirect()->route('series.index');

        //return to_route('series.index'); // no laravel 9
        return to_route('series.index')
            ->with('mensagem.sucesso',"Série '{$serie->nome}' adicionada com sucesso"); // no laravel 9
    }

    //public function destroy(Request $request)
    //public function destroy(int $id) // facilidade do laravel receber o parametro como uma variavel ou por tras dos panos converter em um model como abaixo
    //public function destroy(Serie $series, Request $request)
    public function destroy(Serie $series)
    {

        //$serie = Serie::find($request->series);
        //$serie = Serie::find($id);

        //dd($series);

        //dd($request->series);
        //Serie::destroy($request->serie);
        //Serie::destroy($series->id);
        $series->delete();
        //$request->session()->put('mensagem.sucesso','Série removida com sucesso'); // insere a mensgem na session
        //$request->session()->flash('mensagem.sucesso',"Série '{$series->nome}' removida com sucesso"); // insere a mensagem na session, porém, será esquecida automaticamente durando apenas para uma request (ideal para mensagens rapidas de operações)

        //return to_route('series.index');
        return to_route('series.index')
            ->with('mensagem.sucesso',"Série '{$series->nome}' removida com sucesso"); //melhor opcao, with também envia flash message. Com isso descartamos a necessidade da request
    }

    public function edit (Serie $series)
    {
        dd($series->temporadas);
        return view('series.edit')->with('serie',$series);
    }

    public function update (Serie $series, SeriesFormRequest $request)
    {
        //Validação sem FORM REQUEST
        //$request->validate([
        //   'nome' => ['required','min:3']
        //]);

        //$series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso',"Série '$series->nome' atualizada com sucesso");
    }

}
