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
    const submitLoader = document.getElementById('adminSubmitLoader');
    const submitLoaderText = document.getElementById('adminSubmitLoaderText');
    const networkModal = document.getElementById('adminNetworkModal');
    const networkModalText = document.getElementById('adminNetworkModalText');
    const networkModalClose = document.getElementById('adminNetworkModalClose');
    const networkModalOverlay = document.getElementById('adminNetworkModalOverlay');

    const refreshBodyScrollLock = () => {
        const shouldLock = (submitLoader && !submitLoader.classList.contains('hidden'))
            || (networkModal && !networkModal.classList.contains('hidden'));
        document.body.classList.toggle('overflow-hidden', shouldLock);
    };

    const showSubmitLoader = (message = 'Mohon tunggu, data sedang diproses...') => {
        if (!submitLoader) return;
        if (submitLoaderText) {
            submitLoaderText.textContent = message;
        }
        submitLoader.classList.remove('hidden');
        refreshBodyScrollLock();
    };

    const hideSubmitLoader = () => {
        if (!submitLoader) return;
        submitLoader.classList.add('hidden');
        refreshBodyScrollLock();
    };

    const openNetworkModal = (message = 'Upload gagal. Koneksi internet sedang tidak stabil, silakan coba lagi.') => {
        if (!networkModal) return;
        if (networkModalText) {
            networkModalText.textContent = message;
        }
        networkModal.classList.remove('hidden');
        refreshBodyScrollLock();
    };

    const closeNetworkModal = () => {
        if (!networkModal) return;
        networkModal.classList.add('hidden');
        refreshBodyScrollLock();
    };

    const setFormSubmittingState = (form, isSubmitting) => {
        const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
        submitButtons.forEach((btn) => {
            if (isSubmitting) {
                if (btn.dataset.loadingLocked === '1') return;
                btn.dataset.loadingLocked = '1';
                btn.dataset.wasDisabled = btn.disabled ? '1' : '0';
                btn.disabled = true;

                if (btn.tagName === 'BUTTON') {
                    btn.dataset.originalHtml = btn.innerHTML;
                    btn.innerHTML = `
                        <span class="inline-flex items-center gap-2">
                            <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                <path class="opacity-90" d="M12 2a10 10 0 0110 10" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                            </svg>
                            <span>Memproses...</span>
                        </span>
                    `;
                } else {
                    btn.dataset.originalValue = btn.value;
                    btn.value = 'Memproses...';
                }
                return;
            }

            if (btn.dataset.loadingLocked !== '1') return;

            if (btn.tagName === 'BUTTON' && btn.dataset.originalHtml !== undefined) {
                btn.innerHTML = btn.dataset.originalHtml;
                delete btn.dataset.originalHtml;
            } else if (btn.tagName === 'INPUT' && btn.dataset.originalValue !== undefined) {
                btn.value = btn.dataset.originalValue;
                delete btn.dataset.originalValue;
            }

            btn.disabled = btn.dataset.wasDisabled === '1';
            delete btn.dataset.wasDisabled;
            delete btn.dataset.loadingLocked;
        });
    };

    if (networkModalClose) {
        networkModalClose.addEventListener('click', closeNetworkModal);
    }

    if (networkModalOverlay) {
        networkModalOverlay.addEventListener('click', closeNetworkModal);
    }

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

    // --- Global Confirm Modal (replaces browser confirm()) ---
    const confirmModal = document.getElementById('confirmModal');
    const confirmModalOverlay = document.getElementById('confirmModalOverlay');
    const confirmModalContent = document.getElementById('confirmModalContent');
    const confirmModalTitle = document.getElementById('confirmModalTitle');
    const confirmModalMessage = document.getElementById('confirmModalMessage');
    const confirmModalCancel = document.getElementById('confirmModalCancel');
    const confirmModalOk = document.getElementById('confirmModalOk');

    let pendingForm = null;

    const openConfirm = ({ title, message, okText }) => {
        if (!confirmModal) return;
        if (confirmModalTitle) confirmModalTitle.textContent = title || 'Konfirmasi';
        if (confirmModalMessage) confirmModalMessage.textContent = message || 'Apakah Anda yakin?';
        if (confirmModalOk) confirmModalOk.textContent = okText || 'Ya, Hapus';

        confirmModal.classList.remove('hidden');
        gsap.to(confirmModalOverlay, { opacity: 1, duration: 0.35, ease: 'power2.out' });
        gsap.fromTo(confirmModalContent,
            { scale: 0.92, opacity: 0, y: 18 },
            { scale: 1, opacity: 1, y: 0, duration: 0.35, ease: 'back.out(1.45)' }
        );
    };

    const closeConfirm = () => {
        if (!confirmModal) return;
        gsap.to(confirmModalContent, { scale: 0.96, opacity: 0, y: 10, duration: 0.18, ease: 'power2.in' });
        gsap.to(confirmModalOverlay, {
            opacity: 0,
            duration: 0.25,
            onComplete: () => {
                confirmModal.classList.add('hidden');
                pendingForm = null;
            }
        });
    };

    if (confirmModal && confirmModalOverlay && confirmModalCancel && confirmModalOk) {
        confirmModalOverlay.addEventListener('click', closeConfirm);
        confirmModalCancel.addEventListener('click', closeConfirm);

        document.addEventListener('keydown', (e) => {
            if (confirmModal.classList.contains('hidden')) return;
            if (e.key === 'Escape') closeConfirm();
        });

        confirmModalOk.addEventListener('click', () => {
            if (!pendingForm) return closeConfirm();
            // prevent re-triggering confirmation
            pendingForm.dataset.confirmed = '1';
            if (typeof pendingForm.requestSubmit === 'function') {
                pendingForm.requestSubmit();
            } else {
                pendingForm.submit();
            }
            closeConfirm();
        });

        // Intercept forms that request confirmation
        document.querySelectorAll('form[data-confirm]').forEach((form) => {
            form.addEventListener('submit', (e) => {
                if (form.dataset.confirmed === '1') {
                    delete form.dataset.confirmed;
                    return;
                }

                e.preventDefault();
                pendingForm = form;
                openConfirm({
                    title: form.dataset.confirmTitle || 'Konfirmasi Hapus',
                    message: form.dataset.confirm || 'Apakah Anda yakin ingin menghapus data ini?',
                    okText: form.dataset.confirmOk || 'Ya, Hapus',
                });
            });
        });
    }

    // --- Global submit loading + upload network handling ---
    document.addEventListener('submit', async (e) => {
        const form = e.target;
        if (!(form instanceof HTMLFormElement)) return;

        const method = (form.getAttribute('method') || 'GET').toUpperCase();
        if (method === 'GET') return;

        // Wait until user confirms for confirm-enabled forms
        if (form.dataset.confirm && form.dataset.confirmed !== '1') return;

        if (form.dataset.submitting === '1') {
            e.preventDefault();
            return;
        }

        const activeFileInput = Array.from(form.querySelectorAll('input[type="file"]'))
            .find((input) => input.files && input.files.length > 0);

        if (activeFileInput && !navigator.onLine) {
            e.preventDefault();
            openNetworkModal('Upload tidak dapat dimulai karena koneksi internet terputus. Periksa jaringan lalu coba lagi.');
            return;
        }

        form.dataset.submitting = '1';
        setFormSubmittingState(form, true);
        showSubmitLoader(activeFileInput ? 'Sedang mengunggah file, mohon tunggu...' : 'Mohon tunggu, data sedang diproses...');
        // allow normal browser submit so Laravel redirect/validation flow stays intact
    }, true);

    window.addEventListener('pageshow', () => {
        hideSubmitLoader();
        document.querySelectorAll('form[data-submitting="1"]').forEach((form) => {
            delete form.dataset.submitting;
            setFormSubmittingState(form, false);
        });
    });

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
