import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

window.gsap = gsap;

// Mobile Sidebar Logic
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM Ready. Initializing Sidebar...');

    // Lucide icons (only if used on the page)
    if (document.querySelector('[data-lucide]') && window.lucide?.createIcons) {
        window.lucide.createIcons();
    }

    const mobileBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('close-sidebar-btn');
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('mobile-overlay');
    const links = document.querySelectorAll('.mobile-link');
    const mobileNavLinks = document.getElementById('mobile-nav-links');

    const hasSidebar = !!(mobileBtn && sidebar && overlay && closeBtn);
    if (!hasSidebar) {
        console.error('Sidebar elements missing:', {
            mobileBtn: !!mobileBtn,
            sidebar: !!sidebar,
            overlay: !!overlay,
            closeBtn: !!closeBtn
        });
    } else {
        let isOpen = false;

        // Explicitly set initial GSAP state just in case
        gsap.set(sidebar, { xPercent: 100 });

        function openMenu() {
            if (isOpen) return;
            isOpen = true;

            console.log('Opening Menu...');

            sidebar.classList.remove('hidden');
            overlay.classList.remove('hidden');

            const tl = gsap.timeline();

            tl.to(overlay, {
                opacity: 1,
                duration: 0.3,
                ease: 'power2.out'
            })
                .to(sidebar, {
                    xPercent: 0,
                    duration: 0.5,
                    ease: 'power3.out'
                }, '-=0.3')
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
                    sidebar.classList.add('hidden');
                    overlay.classList.add('hidden');
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

        links.forEach(link => {
            link.addEventListener('click', () => {
                closeMenu();
            });
        });

        console.log('Sidebar listeners attached.');
    }

    // Majelis timeline (Lenis + GSAP ScrollTrigger)
    const timelineContainer = document.querySelector('.timeline-container');
    if (!timelineContainer) return;

    gsap.registerPlugin(ScrollTrigger);

    const lenis = new Lenis();
    window.lenis = lenis;

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);

    const lineActive = document.getElementById('line-active');
    if (lineActive) {
        gsap.to(lineActive, {
            scaleY: 1,
            ease: 'none',
            scrollTrigger: {
                trigger: timelineContainer,
                start: 'top 20%',
                end: 'bottom 80%',
                scrub: true,
            },
        });
    }

    document.querySelectorAll('.timeline-row').forEach((row) => {
        const content = row.querySelector('.reveal-content');
        const img = row.querySelector('.reveal-img');
        const dot = row.querySelector('.timeline-dot');

        if (!content || !img) return;

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: row,
                start: 'top 70%',
                toggleActions: 'play none none reverse',
            },
        });

        if (dot) {
            tl.from(dot, { scale: 0, duration: 0.5, ease: 'back.out(1.7)' });
        }

        tl.from(
            content,
            {
                x: row.classList.contains('is-left') ? -50 : 50,
                opacity: 0,
                duration: 0.8,
            },
            dot ? '-=0.3' : 0
        ).from(
            img,
            {
                y: 50,
                opacity: 0,
                duration: 0.8,
            },
            '-=0.6'
        );
    });

    window.addEventListener('load', () => {
        ScrollTrigger.refresh();
    });
});
