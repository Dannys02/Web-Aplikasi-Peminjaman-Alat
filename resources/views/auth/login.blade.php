<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="w-96">
        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-8 text-center">Login</h1>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <!-- Email -->
            <input
                name="email"
                type="email"
                required
                placeholder="Email"
                class="w-full p-3 border rounded-lg"
            >
            
            <!-- Password -->
            <input
                name="password"
                type="password"
                required
                placeholder="Password"
                class="w-full p-3 border rounded-lg"
            >

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm">Remember me</label>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                Login
            </button>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
            <div class="text-center">
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                    Forgot password?
                </a>
            </div>
            @endif
        </form>
    </div>
</body>
</html>