import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('adminSidebar');
    const toggleBtn = document.getElementById('adminSidebarToggle'); // Desktop toggle
    const mobileBurger = document.getElementById('adminBurger'); // Mobile toggle
    const overlay = document.getElementById('adminOverlay');
    const sidebarTextElements = sidebar.querySelectorAll('.sidebar-text'); // Elements to hide when collapsed
    const logoText = sidebar.querySelectorAll('.logo-text'); // Brand elements

    // Initial Entrance Animation
    const tl = gsap.timeline();
    tl.fromTo(sidebar,
        { x: -50, opacity: 0 },
        { x: 0, opacity: 1, duration: 0.6, ease: 'power3.out' }
    )
        .fromTo(logoText,
            { y: -20, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.4, ease: 'back.out(1.7)' },
            '-=0.3'
        )
        .fromTo(sidebar.querySelectorAll('nav a'),
            { x: -20, opacity: 0 },
            { x: 0, opacity: 1, duration: 0.4, stagger: 0.05, ease: 'power2.out' },
            '-=0.2'
        )
        .fromTo(sidebar.querySelector('.sidebar-text.border-t'),
            { y: 20, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.4, ease: 'power2.out' },
            '-=0.4'
        );

    let isSidebarOpenDesktop = true;
    let isSidebarOpenMobile = false;

    // --- Desktop Animation ---
    function toggleDesktopSidebar() {
        if (isSidebarOpenDesktop) {
            // Collapse
            gsap.to(sidebar, { width: '90px', duration: 0.4, ease: 'power3.inOut' });
            gsap.to(sidebarTextElements, {
                opacity: 0, x: -10, duration: 0.2, onComplete: () => {
                    sidebarTextElements.forEach(el => el.classList.add('hidden'));
                }
            });
            gsap.to(logoText, {
                opacity: 0, x: -10, duration: 0.2, onComplete: () => {
                    logoText.forEach(el => el.classList.add('hidden'));
                }
            });
        } else {
            // Expand
            sidebarTextElements.forEach(el => el.classList.remove('hidden'));
            logoText.forEach(el => el.classList.remove('hidden'));

            gsap.to(sidebar, { width: '18rem', duration: 0.4, ease: 'power3.inOut' });
            gsap.fromTo(sidebarTextElements,
                { opacity: 0, x: -10 },
                { opacity: 1, x: 0, duration: 0.3, stagger: 0.05, delay: 0.1 }
            );
            gsap.fromTo(logoText,
                { opacity: 0, x: -10 },
                { opacity: 1, x: 0, duration: 0.3, delay: 0.1 }
            );
        }
        isSidebarOpenDesktop = !isSidebarOpenDesktop;
    }

    // --- Mobile Animation ---
    function openMobileSidebar() {
        overlay.classList.remove('hidden');
        gsap.fromTo(overlay, { opacity: 0 }, { opacity: 1, duration: 0.3 });

        sidebar.classList.remove('hidden');
        sidebar.classList.add('fixed', 'z-50');
        // Force full height on mobile if needed, or keep the floating look but position it correctly

        gsap.fromTo(sidebar, { x: '-100%' }, { x: '0%', duration: 0.4, ease: 'power3.out' });
        isSidebarOpenMobile = true;
    }

    function closeMobileSidebar() {
        gsap.to(overlay, { opacity: 0, duration: 0.3, onComplete: () => overlay.classList.add('hidden') });
        gsap.to(sidebar, {
            x: '-100%', duration: 0.3, ease: 'power3.in', onComplete: () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('hidden');
                }
                gsap.set(sidebar, { clearProps: "x" }); // Clear transform mostly
            }
        });
        isSidebarOpenMobile = false;
    }

    // --- Event Listeners ---
    if (toggleBtn) {
        toggleBtn.addEventListener('click', toggleDesktopSidebar);
    }

    if (mobileBurger) {
        mobileBurger.addEventListener('click', () => {
            if (isSidebarOpenMobile) closeMobileSidebar();
            else openMobileSidebar();
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeMobileSidebar);
    }

    // --- Logout Modal Logic ---
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const logoutModalOverlay = document.getElementById('logoutModalOverlay');
    const logoutModalContent = document.getElementById('logoutModalContent');
    const closeLogoutBtn = document.getElementById('closeLogoutModal');

    if (logoutBtn && logoutModal) {
        logoutBtn.addEventListener('click', () => {
            logoutModal.classList.remove('hidden');
            gsap.to(logoutModalOverlay, { opacity: 1, duration: 0.4, ease: 'power2.out' });
            gsap.fromTo(logoutModalContent,
                { scale: 0.9, opacity: 0, y: 20 },
                { scale: 1, opacity: 1, y: 0, duration: 0.4, ease: 'back.out(1.5)' }
            );
        });

        const closeModal = () => {
            gsap.to(logoutModalContent, { scale: 0.95, opacity: 0, y: 10, duration: 0.2, ease: 'power2.in' });
            gsap.to(logoutModalOverlay, {
                opacity: 0,
                duration: 0.3,
                onComplete: () => logoutModal.classList.add('hidden')
            });
        };

        closeLogoutBtn.addEventListener('click', closeModal);
        logoutModalOverlay.addEventListener('click', closeModal);
    }

    // Handle Window Resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            if (isSidebarOpenMobile) closeMobileSidebar();

            sidebar.classList.remove('hidden');
            gsap.set(sidebar, { x: 0, clearProps: "transform" });

            if (isSidebarOpenDesktop) {
                gsap.set(sidebar, { width: '18rem' });
                sidebarTextElements.forEach(el => { el.classList.remove('hidden'); el.style.opacity = 1; });
                logoText.forEach(el => { el.classList.remove('hidden'); el.style.opacity = 1; });
            } else {
                gsap.set(sidebar, { width: '90px' });
                sidebarTextElements.forEach(el => { el.classList.add('hidden'); el.style.opacity = 0; });
                logoText.forEach(el => { el.classList.add('hidden'); el.style.opacity = 0; });
            }

        } else {
            // Mobile
            if (!isSidebarOpenMobile) sidebar.classList.add('hidden');
            gsap.set(sidebar, { width: '18rem' }); // Reset width for mobile view to full size

            sidebarTextElements.forEach(el => { el.classList.remove('hidden'); el.style.opacity = 1; });
            logoText.forEach(el => { el.classList.remove('hidden'); el.style.opacity = 1; });
        }
    });

});
