<x-layout title="Séries">

    <a href="{{ route('series.create')}}" class="btn btn-dark mb-2">Adicionar</a>

    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endisset

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->nome }}

                <span class="d-flex">

                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                        E
                    </a>

                    <form action="{{route('series.destroy', $serie->id)}}" method="post" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            X
                        </button>
                    </form>

                </span>

            </li>
        @endforeach
    </ul>

    @{{ nome }} {{-- @ para o blade não fazer parte, ignorar estas chaves e devolver como texto --}}

    <script>
        const series = {{ json_encode($series) }}; // faz um parse, para htmlspecialchars e deixa de ser válido para o JS, inspecionar página para ver o resultado
        const series = {{ Js::from($series) }} // O próprio Laravel disponibiliza esta alternativa correta para um parse JS. Pega valor do PHP, faz um JSON ENCODE e encapsula em uma chamada JSON PARSE e isso vai trazer o resultado esperado.
    </script>

</x-layout>