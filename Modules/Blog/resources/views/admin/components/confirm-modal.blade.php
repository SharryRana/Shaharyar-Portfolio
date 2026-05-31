<div id="admin-confirm-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-950/60 px-4 py-6 backdrop-blur-sm" aria-hidden="true">
    <div class="absolute inset-0" data-confirm-cancel></div>

    <div class="relative w-full max-w-md overflow-hidden rounded-xl border border-gray-200 bg-white shadow-2xl dark:border-gray-700 dark:bg-gray-800" role="dialog" aria-modal="true" aria-labelledby="admin-confirm-title" aria-describedby="admin-confirm-message">
        <div class="p-6">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-600 ring-8 ring-red-50 dark:bg-red-900/30 dark:text-red-300 dark:ring-red-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <h2 id="admin-confirm-title" class="text-lg font-bold text-gray-900 dark:text-white">Confirm action</h2>
                    <p id="admin-confirm-message" class="mt-2 text-sm leading-6 text-gray-600 dark:text-gray-300">Are you sure you want to continue?</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900/40 sm:flex-row sm:justify-end">
            <button type="button" data-confirm-cancel class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-accent focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                Cancel
            </button>
            <button type="button" id="admin-confirm-submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('admin-confirm-modal');
        const title = document.getElementById('admin-confirm-title');
        const message = document.getElementById('admin-confirm-message');
        const confirmButton = document.getElementById('admin-confirm-submit');
        let pendingForm = null;
        let lastFocusedElement = null;

        if (!modal || !title || !message || !confirmButton) {
            return;
        }

        function openModal(form) {
            pendingForm = form;
            lastFocusedElement = document.activeElement;
            title.textContent = form.dataset.confirmTitle || 'Confirm action';
            message.textContent = form.dataset.confirmMessage || form.dataset.confirm || 'Are you sure you want to continue?';
            confirmButton.textContent = form.dataset.confirmButton || 'Confirm';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
            confirmButton.focus();
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
            pendingForm = null;

            if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
                lastFocusedElement.focus();
            }
        }

        document.addEventListener('submit', event => {
            const form = event.target;

            if (!(form instanceof HTMLFormElement) || !form.dataset.confirm || form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();
            openModal(form);
        });

        confirmButton.addEventListener('click', () => {
            if (!pendingForm) {
                closeModal();
                return;
            }

            const form = pendingForm;
            form.dataset.confirmed = 'true';
            closeModal();
            form.requestSubmit();
        });

        modal.querySelectorAll('[data-confirm-cancel]').forEach(element => {
            element.addEventListener('click', closeModal);
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') {
                closeModal();
            }
        });
    });
</script>
