@extends('admin.layouts.master')

@push('styles')
    <style>
        .flash-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
            min-width: 280px;
            max-width: 360px;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.5s ease, fadeOut 0.5s ease 2.5s forwards;
        }

        .flash-alert i {
            font-size: 1.2rem;
        }

        .flash-alert.success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }

        .flash-alert.error {
            background: linear-gradient(135deg, #dc3545, #e55353);
            color: #fff;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(120%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translateX(120%);
            }
        }

        .messages-hero h2 {
            font-weight: 700;
        }

        .message-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease;
            background: #fff;
            overflow: hidden;
            animation: msgFade .35s ease both;
        }

        .message-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, .12);
        }

        .message-card.unread {
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.12) inset;
        }

        .message-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 16px 18px;
        }

        .message-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .12);
        }

        .message-meta {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .message-snippet {
            margin: 2px 0 0 0;
            color: #6c757d;
        }

        .message-time {
            color: #6c757d;
            font-size: .85rem;
            white-space: nowrap;
        }

        .message-actions {
            opacity: 0;
            transition: opacity .2s ease;
        }

        .message-card:hover .message-actions {
            opacity: 1;
        }

        .messages-list {
            display: grid;
            gap: 14px;
        }

        @keyframes msgFade {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dark mode adjustments */
        html[data-theme="dark"] .message-card {
            background: #161a2e;
            color: #e2e6f3;
        }

        html[data-theme="dark"] .message-snippet,
        html[data-theme="dark"] .message-time {
            color: rgba(226, 230, 243, 0.7);
        }

        html[data-theme="dark"] .message-card.unread {
            box-shadow: 0 0 0 2px rgba(226, 230, 243, 0.12) inset;
        }

        /* Pagination */
        .pagination-modern {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px;
        }

        .pagination-modern .page-link {
            border: none;
            color: var(--primary);
            border-radius: 10px;
            padding: 10px 14px;
            transition: background-color .2s ease, transform .15s ease, box-shadow .2s ease;
            background: rgba(67, 97, 238, 0.08);
        }

        .pagination-modern .page-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.18);
            background: rgba(67, 97, 238, 0.12);
        }

        .pagination-modern .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 10px 28px rgba(67, 97, 238, 0.28);
        }

        .pagination-modern .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.2);
        }

        .pagination-modern .page-item.disabled .page-link {
            opacity: .6;
        }

        html[data-theme="dark"] .pagination-modern .page-link {
            background: rgba(226, 230, 243, 0.08);
            color: #e2e6f3;
        }

        html[data-theme="dark"] .pagination-modern .page-link:hover {
            background: rgba(226, 230, 243, 0.12);
        }

        /* Modal polish */
        .modal-content {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: var(--border-radius);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header,
        .modal-footer {
            background: rgba(255, 255, 255, 0.6);
        }

        .modal-title {
            font-weight: 700;
        }

        .modal-body {
            line-height: 1.6;
        }

        #messageModalBody {
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .modal.fade .modal-dialog {
            transform: translateY(10px);
            transition: transform .25s ease;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        @media (max-width: 575.98px) {
            .modal-dialog {
                margin: .75rem;
            }
        }

        html[data-theme="dark"] .modal-content {
            background: #161a2e;
            color: #e2e6f3;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45);
        }

        html[data-theme="dark"] .modal-header,
        html[data-theme="dark"] .modal-footer {
            background: rgba(22, 26, 46, 0.6);
        }

        /* ================== Mobile Responsiveness Fixes ================== */
        body,
        html {
            overflow-x: hidden;
        }

        /* Fix for Messages header */
        .messages-hero .d-flex {
            flex-wrap: wrap;
            gap: 10px;
        }

        .messages-hero .d-flex>div {
            flex: 1 1 auto;
        }

        .messages-hero .btn {
            white-space: nowrap;
        }

        @media (max-width: 767.98px) {
            .messages-hero .d-flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .messages-hero .d-flex>div:last-child {
                width: 100%;
                display: flex;
                justify-content: center;
                margin-top: 10px;
            }

            .messages-hero .btn {
                width: auto;
                font-size: 0.9rem;
                padding: 8px 14px;
            }

            .messages-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .message-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 14px;
            }

            .message-avatar {
                width: 40px;
                height: 40px;
            }

            .message-meta {
                flex-wrap: wrap;
                gap: 6px;
            }

            .message-title {
                font-size: 0.95rem;
            }

            .message-snippet {
                font-size: 0.9rem;
            }

            .message-actions {
                margin-top: 8px;
                opacity: 1 !important;
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
            }

            .message-actions .btn {
                flex: 1 1 auto;
                min-width: 90px;
            }
        }

        @media (max-width: 575.98px) {
            .pagination-modern .page-link {
                font-size: 0.8rem;
                padding: 6px 10px;
                min-width: 32px;
            }

            .modal-dialog {
                margin: 10px;
                width: auto;
            }

            .modal-body {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .messages-hero .btn {
                width: 100%;
            }

            .message-actions .btn {
                width: 100%;
            }
        }
    </style>
@endpush


@section('main-content')
    <section class="messages-hero mb-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h2 class="mb-1">Messages</h2>
                <p class="text-muted mb-0">View and manage your recent communications</p>
            </div>
            <div class="d-flex gap-2 *:flex-wrap justify-content-end">
                <button id="unreadMessageBtn" class="btn btn-primary">
                    <i class="bi bi-envelope"></i> {{ $unreadCount ?? 0 }} New Message
                </button>

            </div>
        </div>
    </section>

    <div class="messages-list">
        @forelse($messages as $msg)
            <div class="card message-card {{ $msg->read_or_not == 0 ? 'unread' : '' }}"
                data-message-id="{{ $msg->id }}" data-message-title="{{ $msg->subject }}"
                data-message-sender="{{ $msg->name }}" data-message-time="{{ $msg->created_at->format('M d, Y h:i A') }}"
                data-message-body="{{ $msg->message }}">

                <div class="message-item">
                    <img class="message-avatar"
                        src="https://ui-avatars.com/api/?name={{ urlencode($msg->name) }}&background=random" alt="Sender">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="message-meta">
                                    @if ($msg->read_or_not == 0)
                                        <span id="{{ $msg->id . 'new_badge' }}" class="badge bg-primary">New</span>
                                    @endif
                                    <span class="text-muted">{{ $msg->subject }}</span>
                                </div>
                                <h6 class="message-title">{{ $msg->name }}</h6>
                            </div>
                            <div class="text-end">
                                <div class="message-time">{{ $msg->created_at->diffForHumans() }}</div>
                                <div class="message-actions">
                                    <form id="{{ $msg->id . 'delete-form' }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $msg->id }}">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Delete"><i
                                                class="bi bi-trash3"></i></button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-primary view-message" title="View"><i
                                            class="bi bi-eye"></i> View</button>
                                </div>
                            </div>
                        </div>
                        <p class="message-snippet mb-0">{{ Str::limit($msg->message, 120) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No messages found.</div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $messages->links('vendor.pagination.messages') }}
    </div>


    <!-- Message Details Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-start justify-content-between flex-wrap gap-2 mb-2">
                        <div>
                            <div class="small text-muted">From</div>
                            <div class="fw-semibold" id="messageModalSender"></div>
                        </div>
                        <div class="text-end">
                            <div class="small text-muted">Received</div>
                            <div class="fw-semibold" id="messageModalTime"></div>
                        </div>
                    </div>
                    <hr>
                    <p id="messageModalBody" class="mb-0"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-reply"></i> Reply
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {

                // Delete message
                $(document).on('click', 'form button[title="Delete"]', function(event) {
                    event.preventDefault();
                    const $form = $(this).closest('form');
                    if (confirm('Are you sure you want to delete this message?')) {
                        $.ajax({
                            url: '{{ route('messages.delete') }}',
                            method: 'DELETE',
                            data: $form.serialize(),
                            success: function() {
                                $form.closest('.message-card').fadeOut(300, function() {
                                    $(this).remove();
                                });
                                $('<div class="alert alert-info mt-3">Message deleted successfully.</div>')
                                    .insertBefore('.messages-list').delay(3000).fadeOut(300,
                                        function() {
                                            $(this).remove();
                                        });

                                showFlash('Message deleted successfully.', 'success');
                            },
                            error: function(error) {
                                showFlash('Failed to delete message. Please try again.', 'error');
                                $('<div class="alert alert-danger mt-3">Failed to delete message. Please try again.</div>')
                                    .insertBefore('.messages-list').delay(3000).fadeOut(300,
                                        function() {
                                            $(this).remove();
                                        });
                            }
                        });
                    }
                });

                // Function to show beautiful flash alerts
                function showFlash(message, type) {
                    const icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' :
                        '<i class="fas fa-times-circle"></i>';
                    const $alert = $(`<div class="flash-alert ${type}">${icon} ${message}</div>`);

                    $('body').append($alert);

                    setTimeout(() => {
                        $alert.fadeOut(400, function() {
                            $(this).remove();
                        });
                    }, 3000);
                }

                // Open modal
                $(document).on('click', '.view-message', function() {
                    const $card = $(this).closest('.message-card');
                    $('#messageModalLabel').text($card.data('message-title'));
                    $('#messageModalSender').text($card.data('message-sender'));
                    $('#messageModalTime').text($card.data('message-time'));
                    $('#messageModalBody').text($card.data('message-body'));

                    new bootstrap.Modal(document.getElementById('messageModal')).show();

                    $card.removeClass('unread');

                    $.ajax({
                        url: '/admin/message/' + $card.data('message-id') + '/mark-read',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            $('#' + $card.data('message-id') + 'new_badge').remove();

                            let $unreadBtn = $(
                            '#unreadMessageBtn'); // only unread button target karo
                            let unreadCount = parseInt($unreadBtn.text()) - 1;

                            unreadCount = unreadCount < 0 ? 0 : unreadCount; // negative fix
                            $unreadBtn.html('<i class="bi bi-envelope"></i> ' + unreadCount +
                                ' New Message');
                        },
                        error: function() {
                            console.error('Failed to mark message as read.');
                        }

                    });

                });
            });
        </script>
    @endpush
@endsection
