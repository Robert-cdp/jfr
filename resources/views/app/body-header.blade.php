<header class="header-gradient flex-shrink-0 shadow-xl relative z-20">
                <div class="flex items-center justify-between px-4 lg:px-8 py-3">
                    <div class="flex items-center gap-3">
                        <!-- Botón menú móvil -->
                        <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="lg:hidden p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <!-- Título dinámico -->
                        <h1 class="text-white font-semibold text-lg lg:text-xl tracking-tight"
                            x-text="
                            activeSection === 'dashboard' ? 'Panel de Control' :
                            activeSection === 'expenses' ? 'Gestión de Gastos' : 'EduFinance'
                        ">
                        </h1>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex items-center bg-white/10 rounded-lg px-3 py-2 gap-2">
                            <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" placeholder="Buscar..."
                                class="bg-transparent text-white text-sm placeholder-white/50 outline-none w-32 lg:w-48">
                        </div>
                        <button class="relative p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span
                                class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-accent-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center ring-2 ring-brand-700">3</span>
                        </button>
                    </div>
                </div>
            </header>