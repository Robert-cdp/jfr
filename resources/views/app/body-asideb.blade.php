<aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:static inset-y-0 left-0 z-50 w-64 flex flex-col bg-brand-950 text-white transition-transform duration-300 ease-in-out overflow-hidden shadow-2xl lg:shadow-none"
            x-transition>
            <!-- Logo pequeño -->
            <div class="flex items-center gap-3 px-5 py-6 border-b border-brand-800/60 flex-shrink-0">
                <span class="text-lg font-bold tracking-tight whitespace-nowrap">
                    <span class="text-white">Colegio </span><span class="text-brand-300">JFR</span>
                </span>
            </div>

            <!-- Navegación -->
            <nav class="flex-1 px-3 py-6 space-y-1.5 overflow-y-auto">

                <a href="index.html"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl bg-brand-800/70 text-white shadow-lg shadow-brand-900/30">

                    <svg class="w-5 h-5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1" />
                    </svg>

                    <span class="text-sm font-medium">Inicio</span>
                </a>

                <a href="expenses.html"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-brand-200/80 hover:bg-brand-800/40 hover:text-white transition">

                    <svg class="w-5 h-5 text-brand-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>

                    <span class="text-sm font-medium">Instituciones</span>
                </a>

                <a href="providers.html"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-brand-200/80 hover:bg-brand-800/40 hover:text-white transition">

                    <svg class="w-5 h-5 text-brand-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <span class="text-sm font-medium">Grados</span>
                </a>

                <a href="reports.html"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-brand-200/80 hover:bg-brand-800/40 hover:text-white transition">

                    <svg class="w-5 h-5 text-brand-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>

                    <span class="text-sm font-medium">Alumnos</span>
                </a>

                <a href="settings.html"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-brand-200/80 hover:bg-brand-800/40 hover:text-white transition">

                    <svg class="w-5 h-5 text-brand-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <span class="text-sm font-medium">Pagos</span>
                </a>

            </nav>

            <!-- Footer sidebar -->
            <div class="p-4 border-t border-brand-800/60">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-cyan-500 flex items-center justify-center ring-2 ring-brand-700/50">
                        <span class="text-white font-semibold text-sm">DC</span>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-medium text-white truncate">Dir. Carlos Mendoza</p>
                        <p class="text-xs text-brand-400 truncate">Administrador</p>
                    </div>
                </div>
            </div>
        </aside>