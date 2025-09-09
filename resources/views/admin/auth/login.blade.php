<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Core-Tech • Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <link rel="icon" type="image/png" href="{{ asset('frontend/assets/favicon/favicon-96x96.png') }}"
        sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('frontend/assets/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('frontend/assets/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/assets/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('frontend/assets/favicon/site.webmanifest') }}" />
    <link rel="icon" href="data:,">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<body>
    <div class="top-right-theme">
        <button id="themeToggle" class="btn btn-outline-secondary" aria-label="Toggle theme">
            <i class="bi bi-moon-stars"></i>
        </button>
    </div>
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="card-header bg-white">
                <div class="auth-brand">
                    <img class="logo-img" src="https://ui-avatars.com/api/?name=A&background=3f37c9&color=fff"
                        alt="Logo">
                    <div>
                        <h5 class="mb-0">Welcome back</h5>
                        <small class="text-muted">Sign in to continue to Admin Panel</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="loginForm" novalidate>
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email or Username</label>
                        <div class="input-group input-with-icon">
                            <span class="input-group-text"><i class="bi bi-at"></i></span>
                            <input type="email" class="form-control" id="loginEmail" placeholder="name@example.com"
                                required>
                        </div>
                        <div class="invalid-feedback">Please enter your email or username.</div>
                    </div>
                    <div class="mb-2">
                        <label for="loginPassword" class="form-label">Password</label>
                        <div class="input-group input-with-icon">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="password" class="form-control" id="loginPassword"
                                placeholder="Enter your password" required>
                            <button type="button" class="btn password-toggle-btn" aria-label="Show password"
                                data-target="#loginPassword"><i class="bi bi-eye" id="eye"></i></button>
                        </div>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <div class="auth-actions mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <!-- <a href="#" class="small">Forgot password?</a> -->
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-gradient text-white">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>

    <script>
        $(function() {
            // Password visibility toggle
            $('.password-toggle-btn').on('click', function() {
                const target = $($(this).data('target'));
                const icon = $(this).find('i');
                if (target.attr('type') === 'password') {
                    target.attr('type', 'text');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    target.attr('type', 'password');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });


            // Simple login validation
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                const email = $('#loginEmail').val().trim();
                const pass = $('#loginPassword').val();
                let valid = true;
                if (!email) {
                    valid = false;
                    $('#loginEmail')[0].setCustomValidity('invalid');
                } else {
                    $('#loginEmail')[0].setCustomValidity('');
                }
                if (!pass) {
                    valid = false;
                    $('#loginPassword')[0].setCustomValidity('invalid');
                } else {
                    $('#loginPassword')[0].setCustomValidity('');
                }
                $(this).addClass('was-validated');
                if (valid) {
                    const btn = $(this).find('button[type="submit"]');
                    const original = btn.text();
                    btn.prop('disabled', true).text('Signing in...');
                    $.ajax({
                        url: "{{ route('login.perform') }}",
                        method: 'POST',
                        data: {
                            email: email,
                            password: pass,
                            remember: $('#rememberMe').is(':checked') ? $('#rememberMe').is(
                                ':checked') : null,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Redirect to dashboard on success
                            $('#loginForm').addClass('was-validated');

                            window.location.href = "{{ route('dashboard') }}";

                        },
                        error: function(xhr) {
                            $('#loginEmail')[0].setCustomValidity('invalid');
                            $('#loginPassword')[0].setCustomValidity('invalid');
                            btn.prop('disabled', false).text(original);
                        }
                    });
                }
            });
        });

        (function() {
            const saved = localStorage.getItem('theme');
            if (!saved && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-theme', 'dark');
            } else if (saved) {
                document.documentElement.setAttribute('data-theme', saved);
            }
        })();
    </script>
</body>

</html>
