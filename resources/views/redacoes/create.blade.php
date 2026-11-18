{{--
    Formulário convertido de novaredacao.php.
    Os IDs originais são mantidos porque style.css e o JavaScript das etapas
    dependem deles; action, CSRF e valores antigos pertencem à integração Laravel.
--}}
@extends('layouts.app')
@section('content')

    @if ($errors->any())
        <p class="erro-login">{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('redacoes.store') }}" method="POST" id="form-redacao">
        @csrf

        {{-- Etapa original de escolha do tema (#caixa3). --}}
        <div id="caixa3" class="a folha">
            <h1 id="criartema" class="a cf">Escreva seu Tema Abaixo</h1>

            <textarea id="tema" name="tema" class="a tf" minlength="2" required>{{ old('tema') }}</textarea>

            <img src="{{ asset('assets/lapis.png') }}" id="lapis" class="a" onclick="comecar()" alt="Continuar">

            <button type="button" class="a avancar-tema bf" onclick="comecar()">Avançar</button>
        </div>

        {{-- Etapas originais de redação; #cr é o botão final "Criar". --}}
        <div id="criaredacao" class="a folha">

            {{-- Resultado mantém visível o tema confirmado antes de iniciar. --}}
            <textarea id="resultado" class="a cf fn" readonly>{{ old('tema') }}</textarea>

            {{-- Introdução original com validação antes de avançar. --}}
            <div id="introducao" class="a">
                <p class="titulo a cf">Introdução</p>
                <p class="frase a cf">Transforme as suas ideias em uma nota 1000</p>
                <textarea id="texto1" class="tf" name="introducao" placeholder="# escreva uma introdução que apresente seu tema e sua tese." required>{{ old('introducao') }}</textarea>
                <div class="acoes-etapa acoes-etapa-finalizar">
                    <button type="button" id="cr1" class="bf" onclick="mostrarEtapa('desenvolvimento')">Concluir Introdução</button>
                </div>
            </div>

            {{-- Desenvolvimento original, com ações de avançar e retornar. --}}
            <div id="desenvolvimento" class="a">
                <p class="titulo a cf">Desenvolvimento</p>
                <p class="frase a cf">Transforme as suas ideias em uma nota 1000</p>
                <textarea id="texto2" class="tf" name="desenvolvimento" placeholder="# desenvolva seus argumentos e comprove a tese apresentada." required>{{ old('desenvolvimento') }}</textarea>
                <div class="acoes-etapa">
                    <button type="button" id="cr3" class="bf" onclick="mostrarEtapa('introducao')">Voltar para Introdução</button>
                    <button type="button" id="cr2" class="bf" onclick="mostrarEtapa('conclusao')">Concluir Desenvolvimento</button>
                </div>
            </div>

            {{-- Conclusão original e indicador de envio. --}}
            <div id="conclusao" class="a">
                <p class="titulo a cf">Conclusão</p>
                <p class="frase a cf">Transforme as suas ideias em uma nota 1000</p>
                <textarea id="texto3" class="tf" name="conclusao" placeholder="# conclua com uma proposta de intervenção para o tema." required>{{ old('conclusao') }}</textarea>
                <div class="acoes-etapa">
                    <button type="button" id="cr4" class="bf" onclick="mostrarEtapa('desenvolvimento')">Voltar para Desenvolvimento</button>
                    <button type="submit" id="cr" class="bf" onclick="carregar(event)">Criar Redação</button>
                </div>
                <img src="{{ asset('assets/carregando.gif') }}" id="carregando" class="a" alt="Carregando...">
            </div>

        </div>

    </form>

@endsection

@push('scripts')
<script>
// Valida o tema e alterna da estrutura original #caixa3 para #criaredacao.
function comecar() {
    const campoTema = document.getElementById('tema');
    if (campoTema.value.trim().length < 2) {
        alert('Escreva um tema antes de continuar.');
        campoTema.focus();
        return;
    }

    document.getElementById('resultado').value = campoTema.value.trim();

    document.getElementById('caixa3').style.display = 'none';
    document.getElementById('criaredacao').style.display = 'block';
}

// Valida o texto atual antes de avançar; voltar continua permitido sem validação.
function mostrarEtapa(etapa) {
    const etapaAtual = ['introducao', 'desenvolvimento', 'conclusao']
        .find(id => document.getElementById(id).style.display !== 'none');
    const proximaEtapa = ['introducao', 'desenvolvimento', 'conclusao'].indexOf(etapa);
    const etapaAtualIndex = ['introducao', 'desenvolvimento', 'conclusao'].indexOf(etapaAtual);

    if (proximaEtapa > etapaAtualIndex) {
        const textoAtual = document.querySelector(`#${etapaAtual} textarea`);
        if (!textoAtual.value.trim()) {
            alert(`Preencha ${etapaAtual} antes de continuar.`);
            textoAtual.focus();
            return;
        }
    }

    document.getElementById('introducao').style.display = 'none';
    document.getElementById('desenvolvimento').style.display = 'none';
    document.getElementById('conclusao').style.display = 'none';

    document.getElementById(etapa).style.display = 'block';
}

// Mostra o indicador original enquanto o formulário Laravel é enviado.
function carregar(event) {
    const conclusao = document.getElementById('texto3');
    if (!conclusao.value.trim()) {
        event.preventDefault();
        alert('Escreva a conclusão antes de continuar.');
        conclusao.focus();
        return;
    }

    document.getElementById('cr').style.display = 'none';
    document.getElementById('carregando').style.display = 'block';
}
</script>
@endpush