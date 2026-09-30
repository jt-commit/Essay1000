<?php
use App\Http\Controllers\{
    AuthController,
    RedacaoController,
    CorrecaoController,
    DebateController,
    ConfiguracaoController,
    TemaController,
    DesafioController
};
use App\Services\GeminiService;
use Illuminate\Support\Facades\Route;

// Autenticação (sem login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rotas protegidas (precisa estar logado)
Route::middleware('auth')->group(function () {

    Route::get('/', fn () => view('index'))->name('index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('redacoes', RedacaoController::class)
        ->parameters(['redacoes' => 'redacao'])
        ->except(['edit']);

    Route::get('/redacoes/{redacao}/correcao', [CorrecaoController::class, 'show'])->name('correcao.show');

    Route::get('/redacoes/{redacao}/debate', [DebateController::class, 'show'])->name('debate.show');
    Route::post('/redacoes/{redacao}/debate', [DebateController::class, 'store'])->name('debate.store');

    Route::get('/configuracao', [ConfiguracaoController::class, 'index'])->name('configuracao');
    Route::post('/configuracao/tema', [ConfiguracaoController::class, 'salvarTema'])->name('configuracao.tema');
    Route::post('/configuracao/fonte', [ConfiguracaoController::class, 'salvarFonte'])->name('configuracao.fonte');

    Route::resource('temas', TemaController::class);

    Route::get('/desafio', [DesafioController::class, 'create'])->name('desafio.create');
    Route::post('/desafio', [DesafioController::class, 'store'])->name('desafio.store');

    Route::get('/gerar-tema', function (GeminiService $gemini) {
        $resultado = $gemini->perguntar(
            "Gere apenas um tema original compatível com o ENEM. Não explique. Não coloque aspas. Retorne somente o tema."
        );

        if (isset($resultado['error'])) {
            return response('Erro ao gerar o tema.', 500);
        }

        return $resultado['candidates'][0]['content']['parts'][0]['text'];
    })->name('gerar-tema');
});