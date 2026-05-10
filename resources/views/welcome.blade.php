<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                <div class="text-2xl font-bold text-white">
                    Cashier App
                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('login') }}"
                       class="px-4 py-2 rounded-lg bg-white text-indigo-600 font-semibold hover:bg-gray-100 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 py-2 rounded-lg border border-white text-white font-semibold hover:bg-indigo-700 transition">
                        Register
                    </a>

                </div>

            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="min-h-[85vh] flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full">

            <div class="grid md:grid-cols-2 gap-10 items-center">

                {{-- Left Content --}}
                <div>

                    <span class="inline-block px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium mb-6">
                        Laravel + Tailwind CSS
                    </span>

                    <h1 class="text-5xl font-bold leading-tight mb-6">
                        Modern Cashier System
                        for Your Business
                    </h1>

                    <p class="text-lg text-gray-600 mb-8">
                        Manage transactions, monitor sales, and simplify your cashier workflow with a clean and modern system.
                    </p>

                    <div class="flex flex-wrap gap-4">

                        <a href="{{ route('login') }}"
                           class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow">
                            Get Started
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-6 py-3 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 font-semibold transition">
                            Create Account
                        </a>

                    </div>

                </div>

                {{-- Right Content --}}
                <div class="hidden md:flex justify-center">

                    <div class="bg-white shadow-2xl rounded-3xl p-8 w-full max-w-md">

                        <div class="space-y-4">

                            <div class="bg-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500">
                                    Today Revenue
                                </p>

                                <h2 class="text-3xl font-bold text-indigo-600">
                                    Rp 5.200.000
                                </h2>
                            </div>

                            <div class="grid grid-cols-2 gap-4">

                                <div class="bg-green-100 rounded-xl p-4">
                                    <p class="text-sm text-green-700">
                                        Transactions
                                    </p>

                                    <h3 class="text-2xl font-bold text-green-800">
                                        58
                                    </h3>
                                </div>

                                <div class="bg-blue-100 rounded-xl p-4">
                                    <p class="text-sm text-blue-700">
                                        Customers
                                    </p>

                                    <h3 class="text-2xl font-bold text-blue-800">
                                        32
                                    </h3>
                                </div>

                            </div>

                            <div class="bg-indigo-600 text-white rounded-xl p-5">
                                <p class="text-sm opacity-80 mb-1">
                                    System Status
                                </p>

                                <h3 class="text-xl font-semibold">
                                    All Systems Running Normally
                                </h3>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

</body>
</html>