import './theme';
import Collapse from 'bootstrap/js/dist/collapse';

const menu = document.getElementById('mainNavbar');
const toggle = document.querySelector('[data-bs-target="#mainNavbar"]');

if (menu && toggle) {
    // Bootstrap handles the toggle and aria-expanded through its data API.
    menu.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && window.matchMedia('(max-width: 1199.98px)').matches) {
            Collapse.getOrCreateInstance(menu, { toggle: false }).hide();
            toggle.focus();
        }
    });
}

// Animate when the footer comes into view; content stays visible without JS.
const footer = document.querySelector('.site-footer');
if (footer && 'IntersectionObserver' in window) {
    const footerObserver = new IntersectionObserver((entries, observer) => {
        if (entries.some(entry => entry.isIntersecting)) {
            footer.classList.add('footer-entered');
            observer.disconnect();
        }
    }, { threshold: 0.08 });
    footerObserver.observe(footer);
}
