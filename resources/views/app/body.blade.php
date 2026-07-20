<body class="bg-slate-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden bg-slate-50">

        <div x-show="mobileMenuOpen" x-cloak @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-transition.opacity></div>

        @include('app.body-aside')

        <div class="flex-1 flex flex-col overflow-hidden relative">

            @include('app.body-header')

            <main class="flex-1 overflow-y-auto p-4 lg:p-8 bg-slate-50 relative">
                @include('app.watemark')

                <div class="relative z-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
