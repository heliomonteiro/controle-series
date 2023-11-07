<x-layout title="Nova Séries">

    <x-series.form :action="route('series.store')" :nome="old('nome')" :update="false" />
</x-layout>