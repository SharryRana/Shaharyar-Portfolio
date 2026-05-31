<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:read,unread'],
        ]);

        $messages = ContactMessage::query()
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%')
                        ->orWhere('subject', 'like', '%'.$search.'%')
                        ->orWhere('message', 'like', '%'.$search.'%')
                        ->orWhere('ip_address', 'like', '%'.$search.'%');
                });
            })
            ->when(($filters['status'] ?? null) === 'read', fn ($query) => $query->where('is_read', true))
            ->when(($filters['status'] ?? null) === 'unread', fn ($query) => $query->where('is_read', false))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('blog::admin.messages.index', [
            'messages' => $messages,
            'filters' => $filters,
            'unreadTotal' => ContactMessage::where('is_read', false)->count(),
        ]);
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('blog::admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('blog-admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
