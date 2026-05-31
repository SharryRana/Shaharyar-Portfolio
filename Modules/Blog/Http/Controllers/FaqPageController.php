<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\Faq;
use Illuminate\Contracts\View\View;

class FaqPageController extends Controller
{
    public function index(): View
    {
        return $this->show(Faq::CATEGORY_GENERAL);
    }

    public function advertisers(): View
    {
        return $this->show(Faq::CATEGORY_ADVERTISER);
    }

    public function publishers(): View
    {
        return $this->show(Faq::CATEGORY_PUBLISHER);
    }

    private function show(string $initialTab): View
    {
        return view('blog::faqs', [
            'initialTab' => $initialTab,
            'faqGroups' => $this->faqGroups(),
        ]);
    }

    private function faqGroups(): array
    {
        $groups = Faq::where('is_active', true)
            ->orderBy('category')
            ->orderBy('order')
            ->orderBy('id')
            ->get()
            ->groupBy('category')
            ->map(fn ($faqs) => $faqs->map(fn (Faq $faq) => [
                'question' => $faq->question,
                'answer' => $faq->answer,
            ])->values()->all())
            ->toArray();

        return array_replace([
            Faq::CATEGORY_GENERAL => [],
            Faq::CATEGORY_ADVERTISER => [],
            Faq::CATEGORY_PUBLISHER => [],
        ], $groups);
    }
}
