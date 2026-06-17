import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.directive('reveal', (el) => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    el.style.transform = 'translateY(0)';
                    el.style.opacity = '1';
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.1 });
        el.style.transform = 'translateY(30px)';
        el.style.opacity = '0';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(el);
    });
});

Alpine.start();
