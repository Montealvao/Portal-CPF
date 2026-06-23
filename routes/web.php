<?php

use App\Http\Controllers\Admin\CpfAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PessoaAdminController;
use App\Http\Controllers\Admin\RelatorioController;
use App\Http\Controllers\Consultante\DashboardConsultanteController;
use App\Http\Controllers\Consultante\PessoaConsultanteController;
use App\Http\Controllers\Consultante\CpfConsultanteController;

/* ============================================================
   Autenticação
   ============================================================ */
Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

/* ============================================================
   Área do Administrador
   ============================================================ */
Route::middleware(['auth', 'perfil:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])
            ->name('dashboard');

        // Pessoas
        Route::get('/pessoas',                [PessoaAdminController::class, 'index'])  ->name('pessoas.index');
        Route::get('/pessoas/nova',           [PessoaAdminController::class, 'create']) ->name('pessoas.create');
        Route::post('/pessoas',               [PessoaAdminController::class, 'store'])  ->name('pessoas.store');
        Route::get('/pessoas/{id}/editar',    [PessoaAdminController::class, 'edit'])   ->name('pessoas.edit');
        Route::put('/pessoas/{id}',           [PessoaAdminController::class, 'update']) ->name('pessoas.update');
        Route::get('/pessoas/{id}/excluir',   [PessoaAdminController::class, 'delete']) ->name('pessoas.delete');
        Route::delete('/pessoas/{id}',        [PessoaAdminController::class, 'destroy'])->name('pessoas.destroy');

        // CPFs
        Route::get('/cpfs',                   [CpfAdminController::class, 'index'])  ->name('cpfs.index');
        Route::get('/cpfs/novo',              [CpfAdminController::class, 'create']) ->name('cpfs.create');
        Route::post('/cpfs',                  [CpfAdminController::class, 'store'])  ->name('cpfs.store');
        Route::get('/cpfs/{id}/editar',       [CpfAdminController::class, 'edit'])   ->name('cpfs.edit');
        Route::put('/cpfs/{id}',              [CpfAdminController::class, 'update']) ->name('cpfs.update');
        Route::get('/cpfs/{id}/excluir',      [CpfAdminController::class, 'delete']) ->name('cpfs.delete');
        Route::delete('/cpfs/{id}',           [CpfAdminController::class, 'destroy'])->name('cpfs.destroy');

        // Relatórios
        Route::get('/relatorios', [RelatorioController::class, 'index'])
            ->name('relatorios');
    });

/* ============================================================
   Área do Consultante
   ============================================================ */
Route::middleware(['auth', 'perfil:consultante'])
    ->prefix('consultante')
    ->name('consultante.')
    ->group(function () {

        Route::get('/dashboard', [DashboardConsultanteController::class, 'index'])
            ->name('dashboard');

        Route::get('/pessoas',    [PessoaConsultanteController::class, 'index'])
            ->name('pessoas');

        Route::get('/buscar-cpf', [CpfConsultanteController::class, 'buscar'])
            ->name('buscar-cpf');

        Route::get('/ficha/{id}', [PessoaConsultanteController::class, 'ficha'])
            ->name('ficha');
    });
