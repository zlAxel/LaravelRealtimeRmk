<x-guest-layout>
    <div class="mt-2 mb-4 font-bold text-center text-xl text-gray-600">
        {{ __('¿Olvidaste tu contraseña?') }}
    </div>
    <div class="my-4 text-center text-sm text-gray-600">
        {{ __('Danos el correo de tu cuenta registrada, y te envíaremos un correo para que la recuperes.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button>
                {{ __('Recuperar') }}
            </x-primary-button>

            <a class="text-sm underline" href="{{ route('login') }}">Regresar</a>
        </div>
    </form>
</x-guest-layout>
