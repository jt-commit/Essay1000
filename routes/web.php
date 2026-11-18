<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\CorrecaoController;
use App\Http\Controllers\DebateController;
use App\Http\Controllers\DesafioController;
use App\Http\Controllers\RedacaoController;
use App\Http\Controllers\TemaController;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Route;

// ==========================================
// ROTAS PÚBLICAS
// ==========================================

// Home Page do Essay1000
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ==========================================
// ROTAS PROTEGIDAS (PRECISA ESTAR LOGADO)
// ==========================================

Route::middleware('auth')->group(function () {

    // Painel principal do usuário
    Route::get('/index', fn () => view('index'))->name('index');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Redações
    Route::resource('redacoes', RedacaoController::class)
        ->parameters(['redacoes' => 'redacao'])
        ->except(['edit']);

    // Correção
    Route::get('/redacoes/{redacao}/correcao', [CorrecaoController::class, 'show'])
        ->name('correcao.show');

    // Debate
    Route::get('/redacoes/{redacao}/debate', [DebateController::class, 'show'])
        ->name('debate.show');

    Route::post('/redacoes/{redacao}/debate', [DebateController::class, 'store'])
        ->name('debate.store');

    // Configurações
    Route::get('/configuracao', [ConfiguracaoController::class, 'index'])
        ->name('configuracao');

    Route::post('/configuracao/tema', [ConfiguracaoController::class, 'salvarTema'])
        ->name('configuracao.tema');

    Route::post('/configuracao/fonte', [ConfiguracaoController::class, 'salvarFonte'])
        ->name('configuracao.fonte');

    // Temas
    Route::resource('temas', TemaController::class);

    // Desafios
    Route::get('/desafio', [DesafioController::class, 'create'])
        ->name('desafio.create');

    Route::post('/desafio', [DesafioController::class, 'store'])
        ->name('desafio.store');

    // Gerar tema com Gemini
    Route::get('/gerar-tema', function (GeminiService $gemini) {

        $resultado = $gemini->perguntar(
            'Gere apenas um tema original compatível com o ENEM. Não explique. Não coloque aspas. Retorne somente o tema.'
        );

        if (isset($resultado['error'])) {
            return response('Erro ao gerar o tema.', 500);
        }

        return $resultado['candidates'][0]['content']['parts'][0]['text'];

    })->name('gerar-tema');

});
