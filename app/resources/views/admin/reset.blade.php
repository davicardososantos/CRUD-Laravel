@extends('layouts.admin')


@section('content')
    <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">
        <div class="login-box">
            <h1 class="text-3xl font-bold mb-3">Alterar Senha:</h1>
            @if ($errors->has('perfil'))
                <div class="alert alert-danger">
                    {{ $errors->first('perfil') }}
                </div>
            @endif
            <form method="POST" action="{{ route('perfil.post') }}">
                @csrf
                <div class="form-group">
                    <label for="password_old" class="block text-gray-700 font-medium mb-2">Senha Atual</label>
                    <input type="password" name="password_old" id="password_old" placeholder="Sua senha atual" required class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400">
                </div>
                <div class="form-group">
                    <label for="password_new" class="block text-gray-700 font-medium mb-2">Nova Senha</label>
                    <input type="password" name="password_new" id="password_new" placeholder="Sua nova senha" required class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400">
                </div>
                <button class="mt-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" type="submit">Salvar</button>
            </form>
        </div>
    </div>
@endsection
