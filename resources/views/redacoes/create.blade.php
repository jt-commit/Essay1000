{{--
    View: redacoes/create.blade.php
    Função: Formulário de nova redação em formato de assistente por
    etapas — primeiro o tema, depois introdução, desenvolvimento e
    conclusão (uma de cada vez), navegando com botões avançar/retornar.
--}}
@extends('layouts.app')
@section('content')

    @if ($errors->any())
        <p class="erro-login">{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('redacoes.store') }}" method="POST" id="form-redacao">
        @csrf

        {{-- ETAPA 1: escolha do tema --}}
        <div id="caixa3" class="a folha">
            <h1 id="criartema" class="a titulo">Qual o tema da sua redação?</h1>

            <input type="text" id="tema" name="tema" class="a" value="{{ old('tema') }}"
                   placeholder="Digite o tema aqui" required>

            <img src="{{ asset('assets/lapis.png') }}" id="lapis" class="a" alt="Editar">

            <button type="button" id="cr" class="a" onclick="irParaRedacao()">Avançar</button>
        </div>

        {{-- ETAPA 2: introdução, desenvolvimento e conclusão --}}
        <div id="criaredacao" class="a folha">

            {{-- mostra o tema escolhido, só leitura, no topo --}}
            <textarea id="resultado" class="a" readonly>{{ old('tema') }}</textarea>

            {{-- Sub-etapa 2.1: Introdução --}}
            <div id="introducao" class="a">
                <textarea id="texto1" class="a" name="introducao" placeholder="Escreva sua introdução..." required>{{ old('introducao') }}</textarea>
                <button type="button" id="cr1" class="a" onclick="mostrarEtapa('desenvolvimento')">Avançar</button>
            </div>

            {{-- Sub-etapa 2.2: Desenvolvimento --}}
            <div id="desenvolvimento" class="a">
                <textarea id="texto2" class="a" name="desenvolvimento" placeholder="Escreva seu desenvolvimento..." required>{{ old('desenvolvimento') }}</textarea>
                <button type="button" id="cr3" class="a" onclick="mostrarEtapa('introducao')">Voltar</button>
                <button type="button" id="cr2" class="a" onclick="mostrarEtapa('conclusao')">Avançar</button>
            </div>

            {{-- Sub-etapa 2.3: Conclusão --}}
            <div id="conclusao" class="a">
                <textarea id="texto3" class="a" name="conclusao" placeholder="Escreva sua conclusão..." required>{{ old('conclusao') }}</textarea>
                <button type="button" id="cr4" class="a" onclick="mostrarEtapa('desenvolvimento')">Voltar</button>
                <button type="submit" class="a">Enviar Redação</button>
            </div>

        </div>

    </form>

@endsection

@push('scripts')
<script>
// Passa da etapa de escolha do tema pra etapa de escrever a redação
function irParaRedacao() {
    const tema = document.getElementById('tema').value.trim();
    if (!tema) {
        alert('Digite um tema antes de continuar.');
        return;
    }

    document.getElementById('resultado').value = tema;

    document.getElementById('caixa3').style.display = 'none';
    document.getElementById('criaredacao').style.display = 'block';

    mostrarEtapa('introducao');
}

// Alterna qual sub-etapa (introdução/desenvolvimento/conclusão) fica visível
function mostrarEtapa(etapa) {
    document.getElementById('introducao').style.display = 'none';
    document.getElementById('desenvolvimento').style.display = 'none';
    document.getElementById('conclusao').style.display = 'none';

    document.getElementById(etapa).style.display = 'block';
}
</script>
@endpush