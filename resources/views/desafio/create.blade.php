{{--
    View: desafio/create.blade.php
    Função: Tela do "Modo Desafio" — o usuário gera um tema aleatório
    via IA (clicando num botão que busca a rota /gerar-tema sem
    recarregar a página) e depois escreve a redação normalmente,
    enviando pro DesafioController@store.
--}}
@extends('layouts.app')
@section('content')

    <h1>Modo Desafio</h1>

    {{-- Botão que busca um tema gerado pela IA, sem enviar o formulário --}}
    <button type="button" onclick="gerarTema()">Gerar Tema</button>

    <form action="{{ route('desafio.store') }}" method="POST">
        @csrf

        {{-- Campo somente leitura, preenchido pelo JavaScript depois de gerar o tema --}}
        <input type="text" id="campo-tema" name="tema" placeholder="Clique em 'Gerar Tema'" readonly required>

        {{-- Campos de texto da redação, mesmo padrão da tela de nova redação --}}
        <textarea name="introducao" rows="10" placeholder="Introdução" required></textarea>
        <textarea name="desenvolvimento" rows="15" placeholder="Desenvolvimento" required></textarea>
        <textarea name="conclusao" rows="5" placeholder="Conclusão" required></textarea>

        <button type="submit">Enviar Redação</button>
    </form>

@endsection

{{-- Script específico dessa página, empurrado pra pilha 'scripts' do layout --}}
@push('scripts')
<script>
// Busca um tema gerado pela IA na rota /gerar-tema, sem recarregar a página,
// e coloca o resultado dentro do campo de tema do formulário.
function gerarTema() {
    fetch('/gerar-tema')
        .then(response => response.text())
        .then(tema => {
            document.getElementById('campo-tema').value = tema;
        });
}
</script>
@endpush