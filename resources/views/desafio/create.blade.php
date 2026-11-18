{{-- View Laravel equivalente a desafio.php; a geração usa a rota gerar-tema. --}}
@extends('layouts.app')
@section('content')

    {{-- Painel original com escolhas de duração do desafio. --}}
    <section id="explicacao" class="a bd fd ed" data-tema-url="{{ route('gerar-tema') }}">
        <h1 id="titl3" class="a">Boas-vindas ao Modo Desafio</h1>
        <p id="ex1" class="a">Este modo simula uma redação do ENEM. O tema é escolhido pela IA e você pode definir um limite de tempo.</p>
        <p id="ex2" class="a">Escolha uma duração: fácil (3 horas), médio (1 hora), difícil (30 minutos) ou sem cronômetro.</p>

        <button type="button" id="fa" class="a bf" onclick="ModoFacil()">Modo Fácil</button>
        <button type="button" id="me" class="a bf" onclick="ModoMedio()">Modo Médio</button>
        <button type="button" id="di" class="a bf" onclick="ModoDificil()">Modo Difícil</button>
        <button type="button" id="se" class="a bf" onclick="SemTempo()">Sem Cronômetro</button>
    </section>

    {{-- Estado de carregamento usado enquanto a rota Laravel consulta a IA. --}}
    <section id="espera" class="a bd ed fd" aria-live="polite">
        <h1 id="ex5" class="a e">Preparando seu desafio...</h1>
        <p id="ex4" class="a e">Selecionando um tema. Esta ação pode levar alguns instantes.</p>
    </section>

    {{-- Formulário mantém nomes e IDs usados pela gravação e pelo CSS legado. --}}
    <form action="{{ route('desafio.store') }}" method="POST" id="form-desafio">
        @csrf
        <div id="criaredacao" class="a" style="display: none;">
            <textarea readonly id="resultado" name="tema" class="a cf fn" aria-label="Tema do desafio"></textarea>
            <div id="cronometro" class="a fd" aria-live="off"></div>

            {{-- Etapa de introdução. --}}
            <div id="introducao" class="a">
                <p class="titulo a cf">Introdução</p>
                <p class="frase a cf">Transforme as suas ideias em uma nota 1000</p>
                <textarea id="texto1" name="introducao" required></textarea>
                <button type="button" id="cr1" class="a bf" onclick="mostrarEtapa('desenvolvimento')">Concluir Introdução</button>
            </div>

            {{-- Etapa de desenvolvimento. --}}
            <div id="desenvolvimento" class="a" style="display: none;">
                <p class="titulo a cf">Desenvolvimento</p>
                <p class="frase a cf">Transforme as suas ideias em uma nota 1000</p>
                <textarea id="texto2" name="desenvolvimento" required></textarea>
                <button type="button" id="cr2" class="a bf" onclick="mostrarEtapa('conclusao')">Concluir Desenvolvimento</button>
                <button type="button" id="cr3" class="a bf" onclick="mostrarEtapa('introducao')">Voltar para Introdução</button>
            </div>

            {{-- Etapa de conclusão e indicador de envio. --}}
            <div id="conclusao" class="a" style="display: none;">
                <p class="titulo a cf">Conclusão</p>
                <p class="frase a cf">Transforme as suas ideias em uma nota 1000</p>
                <textarea id="texto3" name="conclusao" required></textarea>
                <button type="submit" id="cr" class="a bf" onclick="carregar(event)">Criar Redação</button>
                <button type="button" id="cr4" class="a bf" onclick="mostrarEtapa('desenvolvimento')">Voltar para Desenvolvimento</button>
                <img src="{{ asset('assets/carregando.gif') }}" id="carregando" class="a" alt="Carregando...">
            </div>
        </div>
    </form>

@endsection

{{-- Script do desafio: mantém gerarTema() e os nomes de funções usados nos onclick. --}}
@push('scripts')
<script>
let intervaloDesafio = null;

// Faz o pedido pela rota Laravel de geração de tema, sem recarregar a página.
async function gerarTema() {
    const urlTema = document.getElementById('explicacao').dataset.temaUrl;
    const resposta = await fetch(urlTema);
    if (!resposta.ok) {
        throw new Error('Não foi possível gerar o tema agora. Tente novamente.');
    }
    return (await resposta.text()).trim();
}

// Mantém as quatro escolhas originais; tempo é aplicado apenas nesta sessão.
function ModoFacil() { ConfigurarDesafio(10800); }
function ModoMedio() { ConfigurarDesafio(3600); }
function ModoDificil() { ConfigurarDesafio(1800); }
function SemTempo() { ConfigurarDesafio(0); }

async function ConfigurarDesafio(segundos) {
    document.getElementById('explicacao').style.display = 'none';
    document.getElementById('espera').style.display = 'block';

    try {
        const tema = await gerarTema();
        document.getElementById('resultado').value = tema;
        document.getElementById('espera').style.display = 'none';
        document.getElementById('criaredacao').style.display = 'block';
        document.getElementById('introducao').style.display = 'block';
        if (segundos > 0) iniciarCronometro(segundos);
    } catch (erro) {
        document.getElementById('ex4').textContent = erro.message;
    }
}

// Valida cada parte antes de avançar e permite voltar sem apagar texto.
function mostrarEtapa(etapa) {
    const ids = ['introducao', 'desenvolvimento', 'conclusao'];
    const atual = ids.find(id => document.getElementById(id).style.display !== 'none');
    const indexAtual = ids.indexOf(atual);
    const indexDestino = ids.indexOf(etapa);

    if (indexDestino > indexAtual) {
        const campoAtual = document.querySelector(`#${atual} textarea`);
        if (!campoAtual.value.trim()) {
            alert(`Preencha ${atual} antes de continuar.`);
            campoAtual.focus();
            return;
        }
    }

    ids.forEach(id => { document.getElementById(id).style.display = 'none'; });
    document.getElementById(etapa).style.display = 'block';
}

// Atualiza a contagem regressiva sem alterar o modelo de dados Laravel.
function iniciarCronometro(segundos) {
    const relogio = document.getElementById('cronometro');
    const atualizar = () => {
        const horas = String(Math.floor(segundos / 3600)).padStart(2, '0');
        const minutos = String(Math.floor((segundos % 3600) / 60)).padStart(2, '0');
        const restantes = String(segundos % 60).padStart(2, '0');
        relogio.textContent = `${horas}:${minutos}:${restantes}`;
        if (segundos <= 0) {
            clearInterval(intervaloDesafio);
            const completo = ['texto1', 'texto2', 'texto3']
                .every(id => document.getElementById(id).value.trim());
            if (completo) {
                document.getElementById('form-desafio').requestSubmit();
            } else {
                alert('O tempo acabou. Preencha as etapas restantes para enviar a redação.');
            }
            return;
        }
        segundos -= 1;
    };

    atualizar();
    intervaloDesafio = setInterval(atualizar, 1000);
}

// Exibe o indicador original somente quando o formulário válido for enviado.
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