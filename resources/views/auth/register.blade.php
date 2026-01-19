<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Register</h1>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <input name="name" type="text" required autofocus placeholder="Full Name" value="{{ old('name') }}"
                class="w-full p-3 border border-gray-300 rounded-lg">
            <x-input-error :messages="$errors->get('name')" class="text-sm text-red-600" />

            <!-- Email -->
            <input name="email" type="email" required placeholder="Email" value="{{ old('email') }}"
                class="w-full p-3 border border-gray-300 rounded-lg">
            <x-input-error :messages="$errors->get('email')" class="text-sm text-red-600" />

            <!-- Password -->
            <input name="password" type="password" required placeholder="Password"
                class="w-full p-3 border border-gray-300 rounded-lg">
            <x-input-error :messages="$errors->get('password')" class="text-sm text-red-600" />

            <!-- Confirm Password -->
            <input name="password_confirmation" type="password" required placeholder="Confirm Password"
                class="w-full p-3 border border-gray-300 rounded-lg">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm text-red-600" />

            <!-- Submit -->
            <button type="submit" class="w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700 mt-2">
                Register
            </button>

            <!-- Login Link -->
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                    Already have an account? Login
                </a>
            </div>
        </form>
    </div>
</body>

</html>