import 'leaflet/dist/leaflet.css';
import { initMap } from './map.js';
import { initDashboardCharts } from './dashboard-charts.js';
import { initAiAssistant } from './ai-assistant.js';

// Expose initMap globally
window.initMap = initMap;

// Marker for JS availability (enables CSS scroll-reveal guards)
document.documentElement.classList.add('js');

// Progressive enhancement: mobile nav toggle
document.addEventListener('DOMContentLoaded', () => {
    initDashboardCharts();
    initAiAssistant();

    const toggle = document.getElementById('mobile-menu-toggle');
    const nav = document.getElementById('mobile-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    // Scroll reveal — subtle, respects reduced motion
    const revealEls = document.querySelectorAll('[data-reveal]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!reduceMotion && revealEls.length > 0 && 'IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -48px 0px' });

        revealEls.forEach((el) => io.observe(el));
    } else {
        revealEls.forEach((el) => el.classList.add('is-revealed'));
    }

    // Quick-nav scroll-spy — highlights current section in .quick-nav
    const quickNav = document.querySelector('.quick-nav');
    if (quickNav && 'IntersectionObserver' in window) {
        const navLinks = Array.from(quickNav.querySelectorAll('.quick-nav-link'));
        const sectionIds = navLinks.map(a => a.getAttribute('href')?.replace('#', '')).filter(Boolean);
        const sections = sectionIds.map(id => document.getElementById(id)).filter(Boolean);

        const spy = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    navLinks.forEach((a) => {
                        const active = a.getAttribute('href') === '#' + id;
                        a.classList.toggle('is-active', active);
                        a.setAttribute('aria-current', active ? 'true' : 'false');
                    });
                }
            });
        }, { rootMargin: '-30% 0px -60% 0px', threshold: 0 });

        sections.forEach((s) => spy.observe(s));
    }

    // Dusun-wall slide arrow for mobile
    const dusunWallWrapper = document.querySelector('.dusun-wall-wrapper');
    if (dusunWallWrapper) {
        const wallList = dusunWallWrapper.querySelector('.dusun-wall');
        const wallNextBtn = dusunWallWrapper.querySelector('.dusun-wall-arrow-next');
        if (wallList && wallNextBtn) {
            wallNextBtn.addEventListener('click', () => {
                wallList.scrollBy({ left: 160, behavior: 'smooth' });
            });
        }
    }
});


