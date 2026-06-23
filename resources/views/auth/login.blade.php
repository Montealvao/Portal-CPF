@extends('layouts.app', ['hideSidebar' => true])

@section('title', 'Entrar')

@section('content')
<div class="login-wrapper">
    <div class="login-left">
        <div class="login-brand">
            <div class="brand-icon-lg">
                <i class="bi bi-shield-check"></i>
            </div>
            <h1 class="login-brand-title">Portal CPF</h1>
            <p class="login-brand-sub">Sistema de Consulta e Gerenciamento</p>
        </div>
        <ul class="login-features">
            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Consulta rápida de registros</li>
            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Gerenciamento de pessoas e CPFs</li>
            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Relatórios e exportações</li>
            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Dois perfis de acesso</li>
        </ul>
    </div>

    <div class="login-right">
        <div class="login-card">
            <div class="text-center mb-4">
                <h2 class="login-title">Bem-vindo</h2>
                <p class="text-muted">Selecione o perfil e faça login</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="perfil-selector mb-4">
                    <label class="perfil-option {{ old('perfil', 'admin') === 'admin' ? 'selected' : '' }}">
                        <input type="radio" name="perfil" value="admin"
                               {{ old('perfil', 'admin') === 'admin' ? 'checked' : '' }}>
                        <i class="bi bi-shield-fill"></i>
                        <span>Administrador</span>
                    </label>
                    <label class="perfil-option {{ old('perfil') === 'consultante' ? 'selected' : '' }}">
                        <input type="radio" name="perfil" value="consultante"
                               {{ old('perfil') === 'consultante' ? 'checked' : '' }}>
                        <i class="bi bi-person-fill"></i>
                        <span>Consultante</span>
                    </label>
                </div>

                <div class="mb-3">
                    <label for="usuario" class="form-label fw-semibold">Usuário</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control @error('usuario') is-invalid @enderror"
                               id="usuario" name="usuario" value="{{ old('usuario') }}"
                               placeholder="Digite seu usuário" autofocus required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="senha" class="form-label fw-semibold">Senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control @error('senha') is-invalid @enderror"
                               id="senha" name="senha" placeholder="Digite sua senha" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Acessar o Sistema
                </button>
            </form>

            <p class="text-center text-muted mt-4 mb-0" style="font-size:0.8rem;">
                <i class="bi bi-lock-fill me-1"></i>Acesso restrito a usuários autorizados
            </p>
        </div>
    </div>
</div>
@endsection
