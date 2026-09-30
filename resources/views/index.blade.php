@extends('layouts.app')

@section('content')

<div id="caixa4" class="a quadro">
	<a id="nr" class="a" href="{{ route('redacoes.create') }}" >
		Nova Redação
	</a>

	<a id="r" class="a" href="{{ route('redacoes.index') }}" >
		Redações
	</a>

	<a id="d" class="a" href="{{ route('desafio.create') }}" >
		Modo Desafio
	</a>

	<img src="{{ asset('assets/alfinete.png') }}" id="al1" class="a" alt="">
	<img src="{{ asset('assets/alfinete.png') }}" id="al2" class="a" alt="">
	<img src="{{ asset('assets/alfinete.png') }}" id="al3" class="a" alt="">
</div>

@endsection