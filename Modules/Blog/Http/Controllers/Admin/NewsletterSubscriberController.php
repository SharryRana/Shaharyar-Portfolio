<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\Models\NewsletterSubscriber;

class NewsletterSubscriberController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        $subscribers = NewsletterSubscriber::query()
            ->when($filters['search'] ?? null, fn ($query, string $search) => $query->where('email', 'like', '%'.$search.'%'))
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('blog::admin.newsletter.index', [
            'subscribers' => $subscribers,
            'filters' => $filters,
            'activeTotal' => NewsletterSubscriber::where('status', 'active')->count(),
        ]);
    }

    public function toggleStatus(NewsletterSubscriber $subscriber)
    {
        $subscriber->update([
            'status' => $subscriber->status === 'active' ? 'inactive' : 'active',
        ]);

        return back()->with('success', 'Subscriber status updated.');
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('success', 'Subscriber deleted.');
    }
}
