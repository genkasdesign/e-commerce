import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import Alpine from 'alpinejs';

// Initialisation AOS
AOS.init({
    duration: 800,
    once: true,
    offset: 50,
});

// Initialisation Swiper
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.mySwiper')) {
        new Swiper('.mySwiper', {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    }
});

// Alpine.js
window.Alpine = Alpine;
Alpine.start();

// ---------- FONCTIONS UTILITAIRES ----------
function showFlash(message, type = 'success') {
    const flash = document.createElement('div');
    flash.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-900/80 text-green-200' : 'bg-red-900/80 text-red-200'}`;
    flash.textContent = message;
    document.body.appendChild(flash);
    setTimeout(() => flash.remove(), 3000);
}

// Mise à jour du badge du panier (exposé globalement)
window.updateCartBadge = function(total) {
    const badge = document.querySelector('.cart-badge');
    if (badge) {
        if (total > 0) {
            badge.textContent = total;
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }
    }
};

// ----- AJOUT AU PANIER (mise à jour du badge) -----
document.querySelectorAll('.cart-add-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = this.action;
        const formData = new FormData(this);
        const token = this.querySelector('input[name="_token"]').value;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Utiliser la fonction globale pour mettre à jour le badge
                window.updateCartBadge(data.totalItems);
                showFlash(data.message, 'success');
            }
        })
        .catch(error => console.error('Erreur ajout panier:', error));
    });
});

// ----- FAVORIS -----
document.querySelectorAll('[id^="wishlist-form-"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = this.action;
        const method = this.querySelector('input[name="_method"]') ? this.querySelector('input[name="_method"]').value : 'POST';
        const token = this.querySelector('input[name="_token"]').value;

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const btn = this.querySelector('button');
                const svg = btn.querySelector('svg');
                if (data.inWishlist) {
                    btn.classList.remove('text-gray-400', 'hover:text-yellow-400');
                    btn.classList.add('text-red-500', 'hover:text-red-700');
                    btn.title = 'Retirer des favoris';
                } else {
                    btn.classList.remove('text-red-500', 'hover:text-red-700');
                    btn.classList.add('text-gray-400', 'hover:text-yellow-400');
                    btn.title = 'Ajouter aux favoris';
                }
                showFlash(data.message, 'success');
            }
        })
        .catch(error => console.error('Erreur favoris:', error));
    });
});

// ----- PANIER : mise à jour quantité -----
document.querySelectorAll('.cart-update-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = this.action;
        const formData = new FormData(this);
        const token = this.querySelector('input[name="_token"]').value;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = this.closest('tr');
                const subtotalCell = row.querySelector('.subtotal');
                if (subtotalCell) {
                    subtotalCell.textContent = data.subtotal;
                }
                const grandTotal = document.querySelector('.grand-total');
                if (grandTotal) {
                    grandTotal.textContent = data.grandTotal;
                }
                // Mettre à jour le badge du panier (le total des articles peut avoir changé)
                // On pourrait recharger le badge depuis le serveur, mais on le fait manuellement
                // On demande au serveur le nouveau total ou on met à jour localement
                // On peut aussi récupérer le nouveau total depuis la réponse
                showFlash(data.message, 'success');
            }
        })
        .catch(error => console.error('Erreur mise à jour panier:', error));
    });
});

// ----- PANIER : suppression -----
document.querySelectorAll('.cart-remove-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!confirm('Supprimer cet article ?')) return;
        const url = this.action;
        const token = this.querySelector('input[name="_token"]').value;
        const method = this.querySelector('input[name="_method"]').value;

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = this.closest('tr');
                row.remove();
                const grandTotal = document.querySelector('.grand-total');
                if (grandTotal) {
                    grandTotal.textContent = data.grandTotal;
                }
                // Mettre à jour le badge du panier (on peut calculer le nouveau total depuis les lignes restantes)
                const remainingItems = document.querySelectorAll('#cart-items tr').length;
                window.updateCartBadge(remainingItems);
                showFlash(data.message, 'success');
                const countSpan = document.querySelector('.text-sm.text-gray-400');
                if (countSpan) {
                    const count = parseInt(countSpan.textContent) - 1;
                    countSpan.textContent = count + ' article(s)';
                }
            }
        })
        .catch(error => console.error('Erreur suppression panier:', error));
    });
});

// ----- ADMIN : changement statut commande -----
document.querySelectorAll('.order-status-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = this.action;
        const formData = new FormData(this);
        const token = this.querySelector('input[name="_token"]').value;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = this.closest('tr');
                const badge = row.querySelector('.status-badge');
                if (badge) {
                    badge.textContent = data.statusLabel;
                    badge.className = `px-2 py-1 text-xs rounded-full status-badge ${data.statusColor}`;
                }
                showFlash(data.message, 'success');
            }
        })
        .catch(error => console.error('Erreur changement statut:', error));
    });
});

// Initialisation du badge du panier au chargement
document.addEventListener('DOMContentLoaded', function() {
    const badge = document.querySelector('.cart-badge');
    if (badge) {
        const total = parseInt(badge.textContent) || 0;
        window.updateCartBadge(total);
    }
});