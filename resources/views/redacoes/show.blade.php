@extends('layouts.app')
@section('content')

{{--
    View: redacoes/show.blade.php
    Função: Mostra os detalhes completos de UMA redação específica —
    tema, introdução, desenvolvimento, conclusão, e a nota da correção
    (se já tiver sido feita). Também oferece um link pra contestar a nota
    via debate com a IA, e um link de volta pra lista de redações.
--}}


<h1>{{$redacao->RED_TEMA }}</h1>

<div class="Corpo da redação">
<p>Introdução: {{$redacao->RED_INTRODUCAO}}</p>
<P>Desenvolvimento: {{$redacao->RED_DESENVOLVIMENTO}}</P>
<p>Conclusão: {{$redacao->RED_CONCLUSAO}}</p>
</div>
@if($correcao)

<div class="nota">
  <p>Nota: {{$correcao->COR_NOTA}} /1000</p>
</div>
<a href="{{route('debate.show', $redacao)}}">Constestar Nota</a>
@else
<p>Correção ainda não disponivel</p>
@endif

<a href="{{ route('redacoes.index')}}">Voltar</a>



@endsection