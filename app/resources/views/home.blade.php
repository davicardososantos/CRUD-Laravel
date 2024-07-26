@extends('layouts.app')

@section('title', 'Pesquisa')

@section('content')
    @if (session('success'))
        <!-- Alert Success -->
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 flex"
            role="alert">
            <svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                <path fill="currentColor"
                    d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                </path>
            </svg>
            <span class="text-green-800 block sm:inline">{{ session('success') }}</span>
        </div>
        <!-- End Alert Success -->
    @endif

    <form action="/survey" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nome</label>
            <input type="text" id="name" name="name"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
        </div>
        <div class="mb-4">
            <label for="age" class="block text-gray-700 font-medium mb-2">Idade</label>
            <input type="number" id="age" name="age"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
        </div>
        <div class="mb-4">
            <label for="gender" class="block text-gray-700 font-medium mb-2">Sexo</label>
            <select id="gender" name="gender"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                <option value="">Selecione o sexo</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Qual ​​é a sua cor favorita?</label>
            <div class="flex flex-wrap -mx-2">
                <div class="px-2 w-1/3">
                    <label for="color-red" class="block text-gray-700 font-medium mb-2">
                        <input type="radio" id="color-red" name="color" value="Vermelho" class="mr-2">Vermelho
                    </label>
                </div>
                <div class="px-2 w-1/3">
                    <label for="color-blue" class="block text-gray-700 font-medium mb-2">
                        <input type="radio" id="color-blue" name="color" value="Azul" class="mr-2">Azul
                    </label>
                </div>
                <div class="px-2 w-1/3">
                    <label for="color-green" class="block text-gray-700 font-medium mb-2">
                        <input type="radio" id="color-green" name="color" value="Verde" class="mr-2">Verde
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Qual ​​é o seu animal favorito?</label>
            <div class="flex flex-wrap -mx-2">
                <div class="px-2 w-1/3">
                    <label for="animal-cat" class="block text-gray-700 font-medium mb-2">
                        <input type="checkbox" id="animal-cat" name="animal[]" value="Gato" class="mr-2">Gato
                    </label>
                </div>
                <div class="px-2 w-1/3">
                    <label for="animal-dog" class="block text-gray-700 font-medium mb-2">
                        <input type="checkbox" id="animal-dog" name="animal-dog" value="Cachorro" class="mr-2">Cachorro
                    </label>
                </div>
                <div class="px-2 w-1/3">
                    <label for="animal-bird" class="block text-gray-700 font-medium mb-2">
                        <input type="checkbox" id="animal-bird" name="animal[]" value="Pássaro" class="mr-2">Pássaro
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-medium mb-2">Mensagem</label>
            <textarea id="message" name="message"
                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" rows="5"></textarea>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Enviar</button>
        </div>

    </form>
@endsection
