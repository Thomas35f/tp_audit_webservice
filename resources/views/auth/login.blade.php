<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if ($errors->any())
        <h4 class="text-center text-red-600 font-bold my-4">MAUVAIS IDENTIFIANTS</h4>
        <img src="{{ asset('images/femme.jpg') }}">
    @endif

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Hash Type -->
        <div class="mt-4 flex flex-row gap-4 items-center">
            <input type="radio" name="hashAlgorithm" id="hashAlgorithm_sha1" value="sha1" required> SHA-1
            <input type="radio" name="hashAlgorithm" id="hashAlgorithm_sha256" value="sha256" required> SHA-256
            <input type="radio" name="hashAlgorithm" id="hashAlgorithm_md5" value="md5" required> MD5
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            <x-primary-button class="ml-3" onclick="hashPassword()">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script>
        function hashPassword() {
            var password = document.getElementById('password').value;
            var hashAlgorithm = document.querySelector('input[name="hashAlgorithm"]:checked').value;

            switch (hashAlgorithm) {
                case 'sha1':
                    password = CryptoJS.SHA1(password).toString();
                    break;
                case 'sha256':
                    password = CryptoJS.SHA256(password).toString();
                    break;
                case 'md5':
                    password = CryptoJS.MD5(password).toString();
                    break;
            }

            document.getElementById('password').value = password;

            // console.log(password)

            document.getElementById('loginForm').submit();
        }
    </script>
</x-guest-layout>
