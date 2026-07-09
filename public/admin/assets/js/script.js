     // Toggle sidebar on all devices
     $(document).ready(function() {
        // Theme: apply saved or system preference
        const getNextTheme = (current) => current === 'dark' ? 'light' : 'dark';
        const applyTheme = (theme) => {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            const icon = theme === 'dark' ? 'bi-sun' : 'bi-moon-stars';
            const remove = theme === 'dark' ? 'bi-moon-stars' : 'bi-sun';
            $('#themeToggle i').removeClass(remove).addClass(icon);
        };

        const savedTheme = localStorage.getItem('theme') || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        applyTheme(savedTheme);

        // Simple view router
        const showView = (view) => {
            if (view === 'profile') {
                $('#view-dashboard').addClass('d-none');
                $('#view-profile').removeClass('d-none');
            } else {
                $('#view-profile').addClass('d-none');
                $('#view-dashboard').removeClass('d-none');
            }
        };

        // Sidebar nav click handling (works for standalone pages too)
        $('#sidebar .sidebar-menu a[data-view]').on('click', function(e) {
            const view = $(this).data('view');
            const isSinglePage = !$('#view-dashboard').length && !$('#view-profile').length;
            if (isSinglePage) {
                // Navigate between pages
                if (view === 'dashboard') { window.location.href = 'index.html'; return; }
                if (view === 'profile') { window.location.href = 'profile.html'; return; }
            }
            e.preventDefault();
            $('#sidebar .sidebar-menu li').removeClass('active');
            $(this).closest('li').addClass('active');
            showView(view === 'profile' ? 'profile' : 'dashboard');
            if ($(window).width() < 768) {
                $('#sidebar, #content, .overlay').removeClass('active');
                $('#content').removeClass('mobile-spaced');
            }
        });

        // Sidebar toggle functionality
        $('#sidebarCollapse').on('click', function() {
            if ($(window).width() < 768) {
                // Mobile: expand/collapse with overlay and sync content width
                $('#sidebar, .overlay, #content').toggleClass('active');
                $('#content').toggleClass('mobile-spaced', $('#sidebar').hasClass('active'));
            } else if ($(window).width() < 992) {
                // Tablet: slide content slightly when active
                $('#sidebar, #content, .overlay').toggleClass('active');
            } else {
                // Desktop: use collapse button instead
                $('body').toggleClass('sidebar-collapsed');
            }
        });

        // Desktop collapse/expand sidebar
        $('#sidebarToggle').on('click', function() {
            if ($(window).width() >= 992) {
                $('body').toggleClass('sidebar-collapsed');
            } else {
                // Fallback to mobile slide behavior
                $('#sidebar, #content, .overlay').toggleClass('active');
            }
        });

        // Close sidebar when clicking on overlay
        $('.overlay').on('click', function() {
            $('#sidebar, #content, .overlay').removeClass('active');
            $('#content').removeClass('mobile-spaced');
        });

        // Adjust sidebar on resize
        $(window).resize(function() {
            if ($(window).width() > 767.98) {
                $('#sidebar, #content, .overlay').removeClass('active');
                $('#content').removeClass('mobile-spaced');
            }
            if ($(window).width() < 992) {
                $('body').removeClass('sidebar-collapsed');
            }
        });

        // Theme toggle click
        $('#themeToggle').on('click', function() {
            const current = document.documentElement.getAttribute('data-theme') || 'light';
            applyTheme(getNextTheme(current));
        });

        window.showAdminFlash = function(message, type = 'success') {
            const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle';
            const $toast = $(`
                <div class="admin-flash-toast ${type}" role="status">
                    <i class="bi ${icon}"></i>
                    <span></span>
                </div>
            `);

            $toast.find('span').text(message);
            $('body').append($toast);

            setTimeout(() => {
                $toast.fadeOut(220, function() {
                    $(this).remove();
                });
            }, 3200);
        };

        window.showAdminConfirm = function(options = {}) {
            return new Promise((resolve) => {
                const modalEl = document.getElementById('adminConfirmModal');

                if (!modalEl || typeof bootstrap === 'undefined') {
                    resolve(false);
                    return;
                }

                const $modal = $(modalEl);
                const confirmText = options.confirmText || 'Delete';
                const confirmClass = options.confirmClass || options.variant || 'danger';
                let resolved = false;

                $modal.find('#adminConfirmTitle').text(options.title || 'Confirm Action');
                $modal.find('#adminConfirmMessage').text(options.message || 'Are you sure you want to continue?');
                $modal.find('#adminConfirmAction')
                    .removeClass('btn-danger btn-primary btn-warning btn-success')
                    .addClass(`btn-${confirmClass}`)
                    .text(confirmText)
                    .prop('disabled', false);

                const modal = bootstrap.Modal.getOrCreateInstance(modalEl, {
                    backdrop: 'static',
                    keyboard: true
                });

                const cleanup = () => {
                    $modal.find('#adminConfirmAction').off('click.admin-confirm');
                    $modal.off('hidden.bs.modal.admin-confirm');
                };

                $modal.find('#adminConfirmAction').one('click.admin-confirm', function() {
                    resolved = true;
                    cleanup();
                    modal.hide();
                    resolve(true);
                });

                $modal.one('hidden.bs.modal.admin-confirm', function() {
                    cleanup();
                    if (!resolved) {
                        resolve(false);
                    }
                });

                modal.show();
            });
        };

        $(document).on('submit', 'form[data-confirm]', function(event) {
            const form = this;

            if (form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();

            window.showAdminConfirm({
                title: form.dataset.confirmTitle || 'Delete item?',
                message: form.dataset.confirm || 'This action cannot be undone.',
                confirmText: form.dataset.confirmButton || 'Delete',
                variant: form.dataset.confirmVariant || 'danger'
            }).then((confirmed) => {
                if (!confirmed) {
                    return;
                }

                form.dataset.confirmed = 'true';
                HTMLFormElement.prototype.submit.call(form);
            });
        });

        // Profile form validation + password strength
        const $form = $('#profileForm');
        if ($form.length) {
            const $pass = $('#profilePassword');
            const $strength = $('#passwordStrength');
            const calcStrength = (pwd) => {
                let score = 0;
                if (pwd.length >= 8) score++;
                if (/[A-Z]/.test(pwd)) score++;
                if (/[0-9]/.test(pwd)) score++;
                if (/[^A-Za-z0-9]/.test(pwd)) score++;
                return score;
            };
            $pass.on('input', function() {
                const val = $(this).val();
                const s = calcStrength(val);
                if (!val) { $strength.text(''); $strength.removeClass('weak medium strong'); return; }
                if (s <= 1) { $strength.text('Weak'); $strength.attr('class','password-strength weak'); }
                else if (s === 2 || s === 3) { $strength.text('Medium'); $strength.attr('class','password-strength medium'); }
                else { $strength.text('Strong'); $strength.attr('class','password-strength strong'); }
            });

            // Password visibility toggle
            $(document).on('click', '.password-toggle-btn', function() {
                const target = $(this).data('target');
                const $input = $(target);
                const $icon = $(this).find('i');
                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $(this).attr('aria-label','Hide password');
                    $icon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    $input.attr('type', 'password');
                    $(this).attr('aria-label','Show password');
                    $icon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });

            // Avatar upload + live preview
            const $avatarInput = $('#profileAvatarInput');
            const $avatarPreview = $('#profileAvatarPreview');
            $('.change-avatar-btn, #profileAvatarPreview').on('click', function() {
                $avatarInput.trigger('click');
            });
            $avatarInput.on('change', function(e) {
                const file = e.target.files && e.target.files[0];
                if (!file) return;
                const isValidType = /image\/(jpeg|png|webp|jpeg)/.test(file.type);
                const isValidSize = file.size <= 5 * 1024 * 1024;

                if (!isValidType || !isValidSize) {
                    window.showAdminFlash('Please select a JPG, JPEG, PNG, or WebP image up to 5MB.', 'error');
                    $(this).val('');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(ev) {
                    $avatarPreview.attr('src', ev.target.result);
                };
                reader.readAsDataURL(file);
            });

        }


    });
