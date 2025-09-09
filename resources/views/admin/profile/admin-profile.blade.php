@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin-profile.css') }}">
@endpush

@section('main-content')
    <section class="profile-hero mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h2 class="mb-1">Your Profile</h2>
                <p class="text-muted mb-0">Manage your personal information and account security</p>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back
                    to Dashboard</a>
            </div>
        </div>
    </section>

    <div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Edit Profile</h5>
                        <span class="text-muted small">Update your account details</span>
                    </div>
                    <div class="card-body">

                        {{-- 🔹 ALERT PLACEHOLDERS --}}
                        <div id="settingsAlert" class="alert alert-success d-none"></div>
                        <div id="settingsError" class="alert alert-danger d-none"></div>

                        <form id="profileForm" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="profileName" class="form-label">Full Name</label>
                                <div class="input-group input-with-icon">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="profileName" name="fullName"
                                        value="{{ auth()->user()->name ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="profileEmail" class="form-label">Email address</label>
                                <div class="input-group input-with-icon">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="profileEmail" name="email"
                                        value="{{ auth()->user()->email ?? '' }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <div class="input-group input-with-icon">
                                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" name="currentPassword" id="currentPassword" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group input-with-icon">
                                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                        <input type="password" name="newPassword" id="profilePassword" class="form-control"
                                            minlength="8">
                                        <button type="button" class="btn password-toggle-btn"
                                            data-target="#profilePassword"><i class="bi bi-eye"></i></button>
                                    </div>
                                    <div class="form-text">Minimum 8 characters.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group input-with-icon">
                                        <span class="input-group-text"><i class="bi bi-check2-circle"></i></span>
                                        <input type="password" name="confirmPassword" id="profileConfirm"
                                            class="form-control" minlength="8">
                                        <button type="button" class="btn password-toggle-btn"
                                            data-target="#profileConfirm"><i class="bi bi-eye"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                                <button type="submit" id="submit-btn" class="btn btn-primary">Save Changes</button>
                            </div>

                    </div>
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="avatar-uploader mb-3">
                            <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random' }}"
                                class="rounded-circle profile-avatar-img" alt="Avatar" id="profileAvatarPreview">
                            <button class="btn btn-sm btn-primary change-avatar-btn" type="button"><i
                                    class="bi bi-camera"></i></button>
                            <input type="file" id="profileAvatarInput" name="avatar" class="visually-hidden"
                                accept="image/png, image/jpeg">
                        </div>
                        <small class="text-muted">Click the image to upload a new picture</small>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            function showAlert(element, message, type = "success") {
                element.classList.remove("d-none", "alert-success", "alert-danger");
                element.classList.add(type === "success" ? "alert-success" : "alert-danger");
                element.textContent = message;
                element.style.display = "block";
                setTimeout(() => element.style.display = "none", 4000);
            }

            const avatarInput = document.getElementById("profileAvatarInput");
            const avatarPreview = document.getElementById("profileAvatarPreview");

            avatarInput.addEventListener("change", function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => avatarPreview.src = e.target.result;
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(document).on('click', '.password-toggle-btn', function() {
                const target = $(this).data('target');
                const $input = $(target);
                const $icon = $(this).find('i');
                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $(this).attr('aria-label', 'Hide password');
                    $icon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    $input.attr('type', 'password');
                    $(this).attr('aria-label', 'Show password');
                    $icon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });


            document.addEventListener("DOMContentLoaded", () => {
                const profileForm = document.getElementById("profileForm");
                const settingsAlert = document.getElementById("settingsAlert");
                const settingsError = document.getElementById("settingsError");

                // Password toggle (fixed)
                document.querySelectorAll(".password-toggle-btn").forEach(btn => {
                    btn.addEventListener("click", () => {
                        const input = document.querySelector(btn.dataset.target);
                        input.type = input.type === "password" ? "text" : "password";
                        btn.querySelector("i").classList.toggle("bi-eye");
                        btn.querySelector("i").classList.toggle("bi-eye-slash");
                    });
                });

                profileForm.addEventListener("submit", function(e) {
                    e.preventDefault();

                    let formData = new FormData(profileForm);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.profile.update') }}",
                        data: formData,
                        processData: false, // formData k liye zaroori
                        contentType: false, // formData k liye zaroori
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            showAlert(settingsAlert, response.success, "success");
                        },
                        error: function(xhr) {
                            console.log('Error:', xhr);

                            const msg = xhr.responseJSON?.message || "An error occurred.";
                            showAlert(settingsError, msg, "error");
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection
