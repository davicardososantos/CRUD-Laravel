@extends('layouts.app')

@section('title', 'Autenticar')
@section('style', 'shadow-md bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-md text-center')

@section('content')
    @if (session('error'))
        <!-- Alert Success -->
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 flex" role="alert">
            <svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                <path fill="currentColor"
                    d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                </path>
            </svg>
            <span class="text-red-800 block sm:inline">{{ session('error') }}</span>
        </div>
        <!-- End Alert Success -->
    @endif
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

    <div class="">
        <form action="{{ url('/verify') }}" method="POST" class="px-4">
            @csrf
            <div class="flex justify-center gap-2 mb-6">
                <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" name="digit1" maxlength="1" pattern="[0-9]" inputmode="numeric"
                    autocomplete="one-time-code" required>
                <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" name="digit2" maxlength="1" pattern="[0-9]" inputmode="numeric"
                    autocomplete="one-time-code" required>
                <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" name="digit3" maxlength="1" pattern="[0-9]" inputmode="numeric"
                    autocomplete="one-time-code" required>
                <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" name="digit4" maxlength="1" pattern="[0-9]" inputmode="numeric"
                    autocomplete="one-time-code" required>
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" type="submit">
                    Acessar
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input[type="text"]');

            inputs.forEach((input, index) => {
                input.addEventListener('input', (event) => {
                    if (event.target.value.length >= event.target.maxLength) {
                        const nextInput = inputs[index + 1];
                        if (nextInput) {
                            nextInput.focus();
                        }
                    }
                });
            });
        });
    </script>
@endsection
