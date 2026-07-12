<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-gray-800 bg-gray-900/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + liens -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="logo text-2xl font-bold hover:opacity-80 transition">
                        GenShop
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8 ml-10">
                    <a href="{{ route('dashboard') }}" 
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Accueil
                    </a>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.products.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                                Gestion produits
                            </a>
                            <a href="{{ route('admin.categories.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                Catégories
                            </a>
                            <a href="{{ route('admin.orders.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                                Commandes
                            </a>
                            <a href="{{ route('admin.clients.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                                Clients
                            </a>
                        @else
                            <a href="{{ route('cart.index') }}" 
                               class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}">
                                Panier
                                @php
                                    $cartTotal = session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                                @endphp
                                @if($cartTotal > 0)
                                    <span class="cart-badge bg-brand-red text-white text-xs rounded-full px-2 py-0.5 ml-1" id="cart-badge">
                                        {{ $cartTotal }}
                                    </span>
                                @else
                                    <span class="cart-badge bg-brand-red text-white text-xs rounded-full px-2 py-0.5 ml-1" id="cart-badge" style="display: none;"></span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" 
                               class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                                Mes commandes
                            </a>
                            <a href="{{ route('wishlist.index') }}" 
                               class="nav-link {{ request()->routeIs('wishlist.index') ? 'active' : '' }}">
                                Favoris
                            </a>
                        @endif
                    @endauth

                    @auth
                        @if(!auth()->user()->isAdmin())
                            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                            <a href="{{ route('faq') }}" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
                            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">À propos</a>
                        @endif
                    @else
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                        <a href="{{ route('faq') }}" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
                        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">À propos</a>
                    @endauth
                </div>
            </div>

            <!-- Partie droite -->
            <div class="flex items-center space-x-4">
                @auth
                <!-- Icône notifications -->
                <div x-data="notificationComponent()" x-init="loadNotifications()" @click.outside="open = false" class="relative">
                    <button @click="open = !open; loadNotifications()" class="relative p-2 rounded-full hover:bg-gray-700 transition">
                        <svg class="w-6 h-6 text-gray-300 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-brand-red rounded-full transform translate-x-1 -translate-y-1"></span>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-80 bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto">
                        <div class="p-3 border-b border-gray-700 flex justify-between items-center">
                            <span class="text-sm font-medium text-white">Notifications</span>
                            <button @click="markAllAsRead(); open = false" class="text-xs text-brand-red hover:underline" x-show="unreadCount > 0">
                                Tout marquer comme lu
                            </button>
                        </div>
                        <div class="divide-y divide-gray-700">
                            <template x-for="notif in notifications" :key="notif.id">
                                <div class="p-3 hover:bg-gray-700 transition" :class="{'bg-gray-700/50': !notif.is_read}">
                                    <a :href="notif.link" @click="open = false; markAsRead(notif.id)" class="block text-sm text-gray-300 hover:text-white">
                                        <span x-text="notif.message"></span>
                                        <span class="block text-xs text-gray-500 mt-1" x-text="new Date(notif.created_at).toLocaleString()"></span>
                                    </a>
                                </div>
                            </template>
                            <div x-show="notifications.length === 0" class="p-4 text-center text-sm text-gray-500">Aucune notification</div>
                        </div>
                    </div>
                </div>

                <!-- Menu utilisateur -->
                <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                    <button @click="dropdownOpen = !dropdownOpen" 
                            class="flex items-center space-x-2 nav-link focus:outline-none">
                        <span class="hidden md:inline font-medium">{{ auth()->user()->name }}</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-800 border border-gray-700 z-50">
                        <div class="px-4 py-2 border-b border-gray-700">
                            <p class="text-sm font-medium text-gray-200">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" @click="dropdownOpen = false" 
                           class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition">
                           Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" @click="dropdownOpen = false">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 transition">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm">Register</a>
                @endauth

                <!-- Hamburger -->
                <button @click="open = ! open" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="md:hidden">
        <!-- ... contenu existant ... -->
    </div>
</nav>

<script>
    function notificationComponent() {
        return {
            open: false,
            notifications: [],
            unreadCount: 0,
            loadNotifications() {
                fetch('{{ route("notifications.index") }}')
                    .then(response => response.json())
                    .then(data => {
                        // Trier les notifications par date décroissante (les plus récentes en haut)
                        this.notifications = data.notifications.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                        this.unreadCount = data.unreadCount;
                    })
                    .catch(err => console.error('Erreur chargement notifications:', err));
            },
            markAsRead(notificationId) {
                fetch('{{ route("notifications.mark-read") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ notification_id: notificationId })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur HTTP ' + response.status);
                    return response.json();
                })
                .then(() => {
                    // Mise à jour locale : marquer comme lue et décrémenter le compteur
                    const notif = this.notifications.find(n => n.id === notificationId);
                    if (notif && !notif.is_read) {
                        notif.is_read = true;
                        this.unreadCount = Math.max(0, this.unreadCount - 1);
                    }
                })
                .catch(err => console.error('Erreur markAsRead:', err));
            },
            markAllAsRead() {
                // Mise à jour locale immédiate
                this.unreadCount = 0;
                this.notifications.forEach(notif => notif.is_read = true);

                // Envoi de la requête serveur
                fetch('{{ route("notifications.mark-all-read") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur HTTP ' + response.status);
                    return response.json();
                })
                .then(() => {
                    // Tout est bon, on ne recharge pas pour éviter de réafficher l'ancien compteur
                    // On pourrait éventuellement recharger pour synchroniser les notifications (si de nouvelles notifications sont arrivées entre-temps)
                })
                .catch(err => {
                    console.error('Erreur markAllAsRead:', err);
                    // En cas d'erreur, on recharge pour rétablir l'état réel
                    this.loadNotifications();
                });
            }
        }
    }

    // Gestion du badge du panier
    document.addEventListener('DOMContentLoaded', function() {
        const badge = document.getElementById('cart-badge');
        if (badge) {
            const total = parseInt(badge.textContent) || 0;
            window.updateCartBadge(total);
        }
    });

    window.updateCartBadge = function(total) {
        const badge = document.getElementById('cart-badge');
        if (badge) {
            if (total > 0) {
                badge.textContent = total;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        }
    };
</script>