@extends('blog::admin.layouts.master')
@push('styles')
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --accent: #f472b6;
            --text: #1f2937;
            --text-light: #6b7280;
            --bg: #f9fafb;
            --bg-alt: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.95);
            --glass-bg: rgba(255, 255, 255, 0.2);
            --glass-border: rgba(255, 255, 255, 0.5);
            --border: #e5e7eb;
            --border-radius: 16px;
            --shadow: rgba(0, 0, 0, 0.05);
            --success: #10b981;
            --error: #ef4444;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
            --accent-gradient: linear-gradient(135deg, #f472b6 0%, #f9a8d4 100%);
        }

        .form-wrapper {
            margin: 2rem auto;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            padding: 40px;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            animation: fadeIn 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .form-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--primary-gradient);
        }

        .form-wrapper h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--text);
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .form-wrapper h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
            animation: slideIn 0.5s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: var(--bg-alt);
            color: var(--text);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
            outline: none;
            transform: translateY(-2px);
        }

        .form-group input:hover,
        .form-group textarea:hover,
        .form-group select:hover {
            border-color: #c7d2fe;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .form-actions button {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            padding: 14px 36px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .form-actions button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: all 0.6s ease;
        }

        .form-actions button:hover {
            background: var(--accent-gradient);
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(244, 114, 182, 0.4);
        }

        .form-actions button:hover::before {
            left: 100%;
        }

        .form-actions button:active {
            transform: translateY(0);
        }

        /* Success message */
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-size: 15px;
            animation: slideIn 0.5s ease-out;
        }

        /* Error message */
        .error-message {
            color: var(--error);
            font-size: 13px;
            margin-top: 6px;
            display: block;
            animation: shake 0.4s ease;
        }

        /* Responsive grid */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-wrapper {
                padding: 30px 20px;
                margin: 1rem;
            }

            .form-wrapper h2 {
                font-size: 24px;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        /* File input styling */
        .form-group input[type="file"] {
            padding: 12px;
            background: #f8fafc;
            cursor: pointer;
        }

        .form-group input[type="file"]::file-selector-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            margin-right: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-group input[type="file"]::file-selector-button:hover {
            opacity: 0.9;
        }
    </style>
@endpush
@section('main-content')
    <div class="form-wrapper">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>Create Blog Category</h2>
        <div id="flashArea"></div>

        <form action="{{ route('admin.blog.categories.store') }}" id="createCategoryForm" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="grid">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter category name">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" placeholder="Enter category description">{{ old('description') }}</textarea>
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>Parent Category</label>
                    <select name="parent_id">
                        <option value="">Main Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Order</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" min="0">
                </div>
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit">Create Category</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('createCategoryForm');
            const flashArea = document.getElementById('flashArea');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const url = form.action;
                const formData = new FormData(form);

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(async res => {
                        if (!res.ok) {
                            // convert validation error
                            const err = await res.json();
                            throw err;
                        }
                        return res.json();
                    })
                    .then(data => {
                        // show success flash
                        showFlash(data.message, 'success');
                        form.reset();
                    })
                    .catch(err => {
                        let msg = 'Something went wrong';
                        if (err && err.message) msg = err.message;
                        showFlash(msg, 'error');
                    });
            });

            function showFlash(message, type) {
                // clear previous
                flashArea.innerHTML = '';

                const div = document.createElement('div');
                div.className = type === 'success' ? 'alert-success' : 'error-message';
                div.textContent = message;

                flashArea.appendChild(div);

                // fade out after 3s
                setTimeout(() => {
                    div.style.opacity = '0';
                    div.style.transition = 'opacity 0.5s';
                    setTimeout(() => div.remove(), 500);
                }, 3000);
            }
        });
    </script>
@endpush
