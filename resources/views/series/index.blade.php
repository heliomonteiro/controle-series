<x-layout title="Séries">

    <a href="/series/criar" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item">{{ $serie->nome }}</li>
        @endforeach
    </ul>

    @{{ nome }} {{-- @ para o blade não fazer parte, ignorar estas chaves e devolver como texto --}}

    <script>
        const series = {{ json_encode($series) }}; // faz um parse, para htmlspecialchars e deixa de ser válido para o JS, inspecionar página para ver o resultado
        const series = {{ Js::from($series) }} // O próprio Laravel disponibiliza esta alternativa correta para um parse JS. Pega valor do PHP, faz um JSON ENCODE e encapsula em uma chamada JSON PARSE e isso vai trazer o resultado esperado.
    </script>

</x-layout>