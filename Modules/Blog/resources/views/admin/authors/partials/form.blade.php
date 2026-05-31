@php
    $isEditing = $author->exists;
@endphp

<div class="grid gap-6 lg:grid-cols-[1fr_340px]">
    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $author->name) }}" required class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Author full name">
                    @error('name') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="designation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author Designation/Role</label>
                    <input type="text" id="designation" name="designation" value="{{ old('designation', $author->designation) }}" class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="SEO Strategist, Editor, Founder">
                    @error('designation') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author Bio</label>
                    <textarea id="bio" name="bio" rows="6" class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Short author bio shown on blog detail pages">{{ old('bio', $author->bio) }}</textarea>
                    @error('bio') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">Images</h3>
            <div class="mt-4 space-y-5">
                <div>
                    <label for="avatar_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author Avatar/Image</label>
                    @if($author->avatar)
                        <img src="{{ $author->avatar }}" alt="{{ $author->name }}" class="mt-2 h-16 w-16 rounded-full border-2 border-brand-accent object-cover">
                    @endif
                    <input type="file" id="avatar_file" name="avatar_file" accept=".jpeg,.jpg,.png,.gif,.svg,.webp,image/jpeg,image/png,image/gif,image/svg+xml,image/webp" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-brand-accent/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-accent hover:file:bg-brand-accent/20 dark:text-gray-400">
                    @error('avatar_file') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="signature_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author Signature Image</label>
                    @if($author->signature)
                        <div class="mt-2 rounded-md bg-white p-3 dark:bg-gray-900">
                            <img src="{{ $author->signature }}" alt="{{ $author->name }} signature" class="max-h-16 w-auto">
                        </div>
                    @endif
                    <input type="file" id="signature_file" name="signature_file" accept=".jpeg,.jpg,.png,.gif,.svg,.webp,image/jpeg,image/png,image/gif,image/svg+xml,image/webp" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-brand-accent/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-accent hover:file:bg-brand-accent/20 dark:text-gray-400">
                    @error('signature_file') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <label class="flex items-start gap-3">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $author->is_active) ? 'checked' : '' }} class="mt-1 h-4 w-4 rounded border-gray-300 text-brand-accent focus:ring-brand-accent">
                <span>
                    <span class="block text-sm font-semibold text-gray-900 dark:text-white">Active author</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Only active authors appear in the article author dropdown.</span>
                </span>
            </label>
        </div>

        <button type="submit" class="w-full rounded-md border border-transparent bg-brand-accent px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#d66c2e]">
            {{ $isEditing ? 'Update Author' : 'Create Author' }}
        </button>
    </div>
</div>
