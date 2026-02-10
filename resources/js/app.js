import './bootstrap';
import { gsap } from 'gsap';

window.gsap = gsap;

// Mobile Sidebar Logic
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM Ready. Initializing Sidebar...');

    const mobileBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('close-sidebar-btn');
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('mobile-overlay');
    const links = document.querySelectorAll('.mobile-link');
    const mobileNavLinks = document.getElementById('mobile-nav-links');

    if (!mobileBtn || !sidebar || !overlay || !closeBtn) {
        console.error('Sidebar elements missing:', {
            mobileBtn: !!mobileBtn,
            sidebar: !!sidebar,
            overlay: !!overlay,
            closeBtn: !!closeBtn
        });
        return;
    }

    let isOpen = false;

    // Initial state: ensure sidebar is translated off-screen
    // We do NOT want to hide it with display:none if we are going to animate it with transform
    // BUT we do want it hidden from screen readers/clicks when closed. 
    // Tailwind 'hidden' class does display:none. GSAP can handle this but we need to remove hidden first.

    // Explicitly set initial GSAP state just in case
    gsap.set(sidebar, { xPercent: 100 });

    function openMenu() {
        if (isOpen) return;
        isOpen = true;

        console.log('Opening Menu...');

        // Remove 'hidden' class to make elements interactive and visible for animation
        sidebar.classList.remove('hidden');
        overlay.classList.remove('hidden');

        const tl = gsap.timeline();

        // 1. Overlay fade in
        tl.to(overlay, {
            opacity: 1,
            duration: 0.3,
            ease: 'power2.out'
        })
            // 2. Sidebar slide in
            .to(sidebar, {
                xPercent: 0,
                duration: 0.5,
                ease: 'power3.out'
            }, '-=0.3')
            // 3. Links stagger
            .fromTo(links,
                { x: 20, opacity: 0 },
                {
                    x: 0,
                    opacity: 1,
                    duration: 0.4,
                    stagger: 0.05,
                    ease: 'back.out(1.2)'
                },
                '-=0.2'
            );
    }

    function closeMenu() {
        if (!isOpen) return;
        isOpen = false;

        console.log('Closing Menu...');

        const tl = gsap.timeline({
            onComplete: () => {
                // Hide elements after animation
                sidebar.classList.add('hidden');
                overlay.classList.add('hidden');
                // Reset links for next open
                gsap.set(links, { clearProps: 'all' });
            }
        });

        tl.to(sidebar, {
            xPercent: 100,
            duration: 0.4,
            ease: 'power3.in'
        })
            .to(overlay, {
                opacity: 0,
                duration: 0.3
            }, '-=0.4');
    }

    mobileBtn.addEventListener('click', (e) => {
        e.preventDefault();
        openMenu();
    });

    closeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        closeMenu();
    });

    overlay.addEventListener('click', (e) => {
        e.preventDefault();
        closeMenu();
    });

    // Close on link click
    links.forEach(link => {
        link.addEventListener('click', () => {
            // Optional: close menu when a link is clicked
            closeMenu();
        });
    });

    console.log('Sidebar listeners attached.');
});
