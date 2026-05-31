@php
    $isEdit = $product->exists;

    $featureRows = collect(old('features', $isEdit ? $product->features->map(fn ($feature) => [
        'title' => $feature->title,
        'description' => $feature->description,
        'icon' => $feature->icon,
        'sort_order' => $feature->sort_order,
    ])->values()->all() : []))->values();
    if ($featureRows->isEmpty()) {
        $featureRows->push(['title' => '', 'description' => '', 'icon' => 'fas fa-check', 'sort_order' => 1]);
    }

    $faqRows = collect(old('faqs', $isEdit ? $product->faqs->map(fn ($faq) => [
        'question' => $faq->question,
        'answer' => $faq->answer,
        'sort_order' => $faq->sort_order,
    ])->values()->all() : []))->values();
    if ($faqRows->isEmpty()) {
        $faqRows->push(['question' => '', 'answer' => '', 'sort_order' => 1]);
    }

    $pricingRows = collect(old('pricing_plans', $isEdit ? $product->pricingPlans->map(fn ($plan) => [
        'key' => 'plan-' . $plan->id,
        'title' => $plan->title,
        'price' => $plan->price,
        'currency' => $plan->currency,
        'duration' => $plan->duration,
        'description' => $plan->description,
        'cta_label' => $plan->cta_label,
        'features' => implode("\n", $plan->features ?? []),
        'is_popular' => $plan->is_popular,
        'status' => $plan->status ?? 'active',
        'sort_order' => $plan->sort_order,
    ])->values()->all() : []))->values();
    if ($pricingRows->isEmpty()) {
        $pricingRows->push([
            'key' => 'plan-new-1',
            'title' => 'Basic',
            'price' => '',
            'currency' => 'USD',
            'duration' => 'monthly',
            'description' => '',
            'cta_label' => 'Get Started',
            'features' => '',
            'is_popular' => false,
            'status' => 'active',
            'sort_order' => 1,
        ]);
    }

    $countryRows = collect(old('country_prices', $isEdit ? $product->pricingPlans->flatMap(fn ($plan) => $plan->countryPrices->map(fn ($price) => [
        'plan_key' => 'plan-' . $plan->id,
        'plan_title' => $plan->title,
        'country_code' => $price->country_code,
        'country_name' => $price->country_name,
        'currency' => $price->currency,
        'price' => $price->price,
    ]))->values()->all() : []))->values();
@endphp

@push('styles')
    <style>
        .saas-form-card { border: 0; border-radius: var(--border-radius); box-shadow: var(--card-shadow); overflow: hidden; }
        .saas-form-header { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 22px; }
        .saas-form-card .nav-tabs { gap: 6px; }
        .saas-form-card .tab-pane { padding-top: 6px; }
        .saas-form-card .tab-pane.active { display: block; }
        .tab-error-dot { width: 8px; height: 8px; border-radius: 50%; background: #dc3545; display: inline-block; margin-left: 6px; vertical-align: middle; }
        .validation-hint { font-size: .78rem; margin-top: 4px; }
        .form-control.is-invalid, .form-select.is-invalid { border-color: #dc3545; }
        .form-control.is-valid, .form-select.is-valid { border-color: #20c997; }
        .saas-preview { width: 132px; height: 92px; border-radius: 14px; object-fit: cover; background: rgba(67,97,238,.1); border: 1px solid rgba(148,163,184,.35); }
        .helper { font-size: .82rem; color: #6c757d; }
        .builder-card { border: 1px solid #dee2e6; border-radius: 16px; padding: 16px; background: #fff; position: relative; }
        .builder-card + .builder-card { margin-top: 14px; }
        .builder-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 14px; }
        .builder-title { font-weight: 700; color: #111827; }
        .media-preview-grid { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 12px; }
        .media-preview-item { width: 150px; border: 1px solid #dee2e6; border-radius: 14px; padding: 8px; background: #fff; }
        .media-preview-item img { width: 100%; height: 92px; object-fit: cover; border-radius: 10px; display: block; margin-bottom: 8px; }
        .video-preview-box { border: 1px dashed #ced4da; border-radius: 16px; padding: 14px; min-height: 90px; background: #f8fafc; }
        .video-preview-box iframe, .video-preview-box video { width: 100%; aspect-ratio: 16 / 9; border: 0; border-radius: 12px; background: #111827; }
        .preview-modal-product { background: #f4f7fb; border-radius: 18px; overflow: hidden; }
        .preview-hero { padding: 26px; color: #fff; background: linear-gradient(135deg, #22d3ee, #818cf8); }
        .preview-section { padding: 22px 26px; border-top: 1px solid #e5e7eb; background: #fff; }
        .preview-tags { display: flex; flex-wrap: wrap; gap: 8px; }
        .preview-tags span { border-radius: 999px; padding: 6px 10px; background: #eef2ff; color: #2563eb; font-size: .82rem; font-weight: 700; }
        html[data-theme="dark"] .saas-form-card,
        html[data-theme="dark"] .builder-card,
        html[data-theme="dark"] .media-preview-item,
        html[data-theme="dark"] .preview-section { background: #161a2e; color: #e2e6f3; border-color: rgba(255,255,255,.12); }
        html[data-theme="dark"] .builder-title { color: #e2e6f3; }
        html[data-theme="dark"] .video-preview-box { background: #101426; border-color: rgba(255,255,255,.14); }
    </style>
@endpush

<div class="card saas-form-card">
    <div class="saas-form-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h4 class="mb-1">{{ $isEdit ? 'Edit SaaS Product' : 'Add SaaS Product' }}</h4>
            <p class="mb-0 opacity-75">Build product page content, media, pricing, and SEO from one clean form.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-light" id="openPreviewBtn"><i class="bi bi-eye"></i> Preview</button>
            <a href="{{ route('saas-products.index') }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the highlighted fields.</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="saasProductForm" action="{{ $isEdit ? route('saas-products.update', $product) : route('saas-products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-tab-key="basic" data-bs-toggle="tab" data-bs-target="#saas-basic-tab" type="button">Basic <span class="tab-error-dot d-none"></span></button></li>
                <li class="nav-item"><button class="nav-link" data-tab-key="content" data-bs-toggle="tab" data-bs-target="#saas-content-tab" type="button">Content <span class="tab-error-dot d-none"></span></button></li>
                <li class="nav-item"><button class="nav-link" data-tab-key="media" data-bs-toggle="tab" data-bs-target="#saas-media-tab" type="button">Media <span class="tab-error-dot d-none"></span></button></li>
                <li class="nav-item"><button class="nav-link" data-tab-key="pricing" data-bs-toggle="tab" data-bs-target="#saas-pricing-tab" type="button">Pricing <span class="tab-error-dot d-none"></span></button></li>
                <li class="nav-item"><button class="nav-link" data-tab-key="seo" data-bs-toggle="tab" data-bs-target="#saas-seo-tab" type="button">SEO <span class="tab-error-dot d-none"></span></button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="saas-basic-tab">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input id="titleInput" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SEO Slug</label>
                            <input id="slugInput" type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $product->slug) }}" placeholder="my-saas-product" required>
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tagline</label>
                            <input type="text" name="tagline" class="form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline', $product->tagline) }}">
                            @error('tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $product->category) }}">
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Icon Class</label>
                            <input type="text" name="icon" class="form-control" value="{{ old('icon', $product->icon) }}" placeholder="fas fa-layer-group">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" min="0" value="{{ old('sort_order', $product->sort_order ?? 0) }}" required>
                            @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="active" @selected(old('status', $product->status) === 'active')>Active</option>
                                <option value="inactive" @selected(old('status', $product->status) === 'inactive')>Inactive</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="saas-content-tab">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Product Overview</label>
                            <textarea name="overview" rows="5" class="form-control @error('overview') is-invalid @enderror" required>{{ old('overview', $product->overview) }}</textarea>
                            @error('overview')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Detailed Description / How It Works</label>
                            <textarea name="how_it_works" rows="6" class="form-control @error('how_it_works') is-invalid @enderror">{{ old('how_it_works', $product->how_it_works) }}</textarea>
                            @error('how_it_works')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">How To Use / Access</label>
                            <textarea name="access_instructions" rows="6" class="form-control @error('access_instructions') is-invalid @enderror">{{ old('access_instructions', $product->access_instructions) }}</textarea>
                            @error('access_instructions')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Benefits</label>
                            <textarea name="benefits" rows="7" class="form-control" placeholder="One benefit per line">{{ old('benefits', implode("\n", $product->benefits ?? [])) }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Use Cases</label>
                            <textarea name="use_cases" rows="7" class="form-control" placeholder="One use case per line">{{ old('use_cases', implode("\n", $product->use_cases ?? [])) }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tech Stack</label>
                            <textarea name="tech_stack" rows="7" class="form-control" placeholder="Laravel">{{ old('tech_stack', implode("\n", $product->tech_stack ?? [])) }}</textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="builder-toolbar">
                        <div>
                            <h5 class="mb-1">Main Features</h5>
                            <div class="helper">Add one card per feature shown on the product detail page.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-add-row="features"><i class="bi bi-plus-circle"></i> Add Feature</button>
                    </div>
                    <div id="featuresBuilder">
                        @foreach($featureRows as $index => $feature)
                            <div class="builder-card" data-builder-row>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="builder-title">Feature</span>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-4"><label class="form-label">Title</label><input type="text" name="features[{{ $index }}][title]" class="form-control" value="{{ $feature['title'] ?? '' }}"></div>
                                    <div class="col-md-5"><label class="form-label">Description</label><input type="text" name="features[{{ $index }}][description]" class="form-control" value="{{ $feature['description'] ?? '' }}"></div>
                                    <div class="col-md-2"><label class="form-label">Icon</label><input type="text" name="features[{{ $index }}][icon]" class="form-control" value="{{ $feature['icon'] ?? 'fas fa-check' }}"></div>
                                    <div class="col-md-1"><label class="form-label">Sort</label><input type="number" name="features[{{ $index }}][sort_order]" class="form-control" value="{{ $feature['sort_order'] ?? $index + 1 }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="builder-toolbar">
                        <div>
                            <h5 class="mb-1">FAQs</h5>
                            <div class="helper">Questions and answers shown near the bottom of the product page.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-add-row="faqs"><i class="bi bi-plus-circle"></i> Add FAQ</button>
                    </div>
                    <div id="faqsBuilder">
                        @foreach($faqRows as $index => $faq)
                            <div class="builder-card" data-builder-row>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="builder-title">FAQ</span>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-5"><label class="form-label">Question</label><input type="text" name="faqs[{{ $index }}][question]" class="form-control" value="{{ $faq['question'] ?? '' }}"></div>
                                    <div class="col-md-6"><label class="form-label">Answer</label><input type="text" name="faqs[{{ $index }}][answer]" class="form-control" value="{{ $faq['answer'] ?? '' }}"></div>
                                    <div class="col-md-1"><label class="form-label">Sort</label><input type="number" name="faqs[{{ $index }}][sort_order]" class="form-control" value="{{ $faq['sort_order'] ?? $index + 1 }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="saas-media-tab">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Thumbnail</label>
                            <div class="mb-2">
                                <img id="thumbnailPreview" class="saas-preview" src="{{ $product->thumbnail ? asset($product->thumbnail) : '' }}" alt="{{ $product->thumbnail_alt }}" @if(!$product->thumbnail) style="display:none" @endif>
                            </div>
                            <input id="thumbnailInput" type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                            @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Thumbnail Alt Text</label>
                            <input type="text" name="thumbnail_alt" class="form-control" value="{{ old('thumbnail_alt', $product->thumbnail_alt) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Video URL</label>
                            <input id="videoUrlInput" type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $product->video_url) }}" placeholder="YouTube, Vimeo, or MP4 URL">
                            @error('video_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Demo URL</label>
                            <input type="url" name="demo_url" class="form-control @error('demo_url') is-invalid @enderror" value="{{ old('demo_url', $product->demo_url) }}">
                            @error('demo_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Screenshots</label>
                            <input id="screenshotsInput" type="file" name="screenshots[]" class="form-control @error('screenshots.*') is-invalid @enderror" accept="image/*" multiple>
                            <div class="helper">Preview, rename, or remove selected screenshots before saving.</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Video Preview</label>
                        <div id="videoPreview" class="video-preview-box">
                            <span class="helper">Paste a YouTube, Vimeo, or direct MP4 URL to preview it here.</span>
                        </div>
                    </div>

                    <div id="screenshotsPreview" class="media-preview-grid"></div>

                    @if($isEdit && $product->screenshots->isNotEmpty())
                        <hr>
                        <h5>Existing Screenshots</h5>
                        <div class="row g-3">
                            @foreach($product->screenshots as $shot)
                                <div class="col-md-4">
                                    <div class="builder-card">
                                        <img class="saas-preview mb-2" src="{{ asset($shot->image) }}" alt="{{ $shot->alt_text }}">
                                        <input type="text" name="existing_screenshots[{{ $shot->id }}][alt_text]" class="form-control mb-2" value="{{ $shot->alt_text }}" placeholder="Alt text">
                                        <input type="text" name="existing_screenshots[{{ $shot->id }}][title]" class="form-control mb-2" value="{{ $shot->title }}" placeholder="Title">
                                        <input type="number" name="existing_screenshots[{{ $shot->id }}][sort_order]" class="form-control mb-2" value="{{ $shot->sort_order }}">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="existing_screenshots[{{ $shot->id }}][delete]" value="1">
                                            Delete this screenshot
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="saas-pricing-tab">
                    <div class="builder-toolbar">
                        <div>
                            <h5 class="mb-1">Pricing Plans</h5>
                            <div class="helper">Add plans without memorizing a strict format.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-add-row="pricing"><i class="bi bi-plus-circle"></i> Add Plan</button>
                    </div>
                    <div id="pricingBuilder">
                        @foreach($pricingRows as $index => $plan)
                            @php($planKey = $plan['key'] ?? 'plan-new-' . ($index + 1))
                            <div class="builder-card" data-builder-row data-plan-row data-plan-key="{{ $planKey }}">
                                <input type="hidden" name="pricing_plans[{{ $index }}][key]" value="{{ $planKey }}">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="builder-title">Pricing Plan</span>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-3"><label class="form-label">Plan Name</label><input type="text" name="pricing_plans[{{ $index }}][title]" class="form-control plan-title-input" value="{{ $plan['title'] ?? '' }}"></div>
                                    <div class="col-md-2"><label class="form-label">Price</label><input type="number" step="0.01" min="0" name="pricing_plans[{{ $index }}][price]" class="form-control" value="{{ $plan['price'] ?? '' }}"></div>
                                    <div class="col-md-2"><label class="form-label">Currency</label><input type="text" name="pricing_plans[{{ $index }}][currency]" class="form-control" value="{{ $plan['currency'] ?? 'USD' }}"></div>
                                    <div class="col-md-2"><label class="form-label">Duration</label><input type="text" name="pricing_plans[{{ $index }}][duration]" class="form-control" value="{{ $plan['duration'] ?? '' }}" placeholder="monthly"></div>
                                    <div class="col-md-3"><label class="form-label">CTA Text</label><input type="text" name="pricing_plans[{{ $index }}][cta_label]" class="form-control" value="{{ $plan['cta_label'] ?? '' }}"></div>
                                    <div class="col-md-6"><label class="form-label">Plan Description</label><input type="text" name="pricing_plans[{{ $index }}][description]" class="form-control" value="{{ $plan['description'] ?? '' }}"></div>
                                    <div class="col-md-6"><label class="form-label">Features List</label><textarea name="pricing_plans[{{ $index }}][features]" rows="3" class="form-control" placeholder="One feature per line">{{ $plan['features'] ?? '' }}</textarea></div>
                                    <div class="col-md-2"><label class="form-label">Sort</label><input type="number" min="0" name="pricing_plans[{{ $index }}][sort_order]" class="form-control" value="{{ $plan['sort_order'] ?? $index + 1 }}"></div>
                                    <div class="col-md-3"><label class="form-label">Status</label><select name="pricing_plans[{{ $index }}][status]" class="form-select"><option value="active" @selected(($plan['status'] ?? 'active') === 'active')>Active</option><option value="inactive" @selected(($plan['status'] ?? 'active') === 'inactive')>Inactive</option></select></div>
                                    <div class="col-md-3 d-flex align-items-end">
                                        <label class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="pricing_plans[{{ $index }}][is_popular]" value="1" @checked(!empty($plan['is_popular']))>
                                            Highlight as popular
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="builder-toolbar">
                        <div>
                            <h5 class="mb-1">Country-wise Prices</h5>
                            <div class="helper">Attach localized pricing to any plan.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-add-row="country"><i class="bi bi-plus-circle"></i> Add Country Price</button>
                    </div>
                    <div id="countryPricingBuilder">
                        @foreach($countryRows as $index => $price)
                            <div class="builder-card" data-builder-row>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="builder-title">Country Price</span>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Plan</label>
                                        <select name="country_prices[{{ $index }}][plan_key]" class="form-select country-plan-select" data-selected="{{ $price['plan_key'] ?? '' }}"></select>
                                        <input type="hidden" name="country_prices[{{ $index }}][plan_title]" value="{{ $price['plan_title'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2"><label class="form-label">Country Code</label><input type="text" name="country_prices[{{ $index }}][country_code]" class="form-control" value="{{ $price['country_code'] ?? '' }}" placeholder="PK"></div>
                                    <div class="col-md-3"><label class="form-label">Country Name</label><input type="text" name="country_prices[{{ $index }}][country_name]" class="form-control" value="{{ $price['country_name'] ?? '' }}" placeholder="Pakistan"></div>
                                    <div class="col-md-2"><label class="form-label">Currency</label><input type="text" name="country_prices[{{ $index }}][currency]" class="form-control" value="{{ $price['currency'] ?? '' }}" placeholder="PKR"></div>
                                    <div class="col-md-2"><label class="form-label">Price</label><input type="number" step="0.01" min="0" name="country_prices[{{ $index }}][price]" class="form-control" value="{{ $price['price'] ?? '' }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="saas-seo-tab">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title) }}"></div>
                        <div class="col-md-6"><label class="form-label">Focus Keyword</label><input type="text" name="focus_keyword" class="form-control" value="{{ old('focus_keyword', $product->focus_keyword) }}"></div>
                        <div class="col-md-6"><label class="form-label">Meta Description</label><textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description', $product->meta_description) }}</textarea></div>
                        <div class="col-md-6"><label class="form-label">Meta Keywords</label><textarea name="meta_keywords" rows="3" class="form-control">{{ old('meta_keywords', $product->meta_keywords) }}</textarea></div>
                        <div class="col-md-6"><label class="form-label">Canonical URL</label><input type="url" name="canonical_url" class="form-control" value="{{ old('canonical_url', $product->canonical_url) }}"></div>
                        <div class="col-md-6"><label class="form-label">Open Graph Title</label><input type="text" name="og_title" class="form-control" value="{{ old('og_title', $product->og_title) }}"></div>
                        <div class="col-md-6"><label class="form-label">Open Graph Description</label><textarea name="og_description" rows="3" class="form-control">{{ old('og_description', $product->og_description) }}</textarea></div>
                        <div class="col-md-6"><label class="form-label">Open Graph Image</label><input type="file" name="og_image" class="form-control" accept="image/*"></div>
                        <div class="col-md-6"><label class="form-label">Twitter Card Title</label><input type="text" name="twitter_title" class="form-control" value="{{ old('twitter_title', $product->twitter_title) }}"></div>
                        <div class="col-md-6"><label class="form-label">Twitter Card Image</label><input type="file" name="twitter_image" class="form-control" accept="image/*"></div>
                        <div class="col-md-6"><label class="form-label">Twitter Card Description</label><textarea name="twitter_description" rows="3" class="form-control">{{ old('twitter_description', $product->twitter_description) }}</textarea></div>
                        <div class="col-md-6"><label class="form-label">Product Schema / Structured Data JSON</label><textarea name="product_schema_json" rows="5" class="form-control">{{ old('product_schema_json', $product->product_schema_json) }}</textarea></div>
                    </div>
                    <div class="mt-4 p-3 border rounded-3 bg-light">
                        <div class="helper mb-1">SEO Preview</div>
                        <h5 id="seoPreviewTitle" class="mb-1 text-primary"></h5>
                        <div id="seoPreviewUrl" class="text-success small"></div>
                        <p id="seoPreviewDescription" class="mb-0 text-muted"></p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn btn-outline-primary" id="bottomPreviewBtn"><i class="bi bi-eye"></i> Preview</button>
                <a href="{{ route('saas-products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button id="submitProductBtn" class="btn btn-primary"><i class="bi bi-check2-circle"></i> {{ $isEdit ? 'Update Product' : 'Create Product' }}</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="productPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SaaS Product Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="productPreviewContent" class="preview-modal-product"></div>
            </div>
        </div>
    </div>
</div>

<template id="featureTemplate">
    <div class="builder-card" data-builder-row>
        <div class="d-flex justify-content-between align-items-center mb-2"><span class="builder-title">Feature</span><button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button></div>
        <div class="row g-3">
            <div class="col-md-4"><label class="form-label">Title</label><input type="text" data-name="features[__INDEX__][title]" class="form-control"></div>
            <div class="col-md-5"><label class="form-label">Description</label><input type="text" data-name="features[__INDEX__][description]" class="form-control"></div>
            <div class="col-md-2"><label class="form-label">Icon</label><input type="text" data-name="features[__INDEX__][icon]" class="form-control" value="fas fa-check"></div>
            <div class="col-md-1"><label class="form-label">Sort</label><input type="number" data-name="features[__INDEX__][sort_order]" class="form-control" value="__SORT__"></div>
        </div>
    </div>
</template>

<template id="faqTemplate">
    <div class="builder-card" data-builder-row>
        <div class="d-flex justify-content-between align-items-center mb-2"><span class="builder-title">FAQ</span><button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button></div>
        <div class="row g-3">
            <div class="col-md-5"><label class="form-label">Question</label><input type="text" data-name="faqs[__INDEX__][question]" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Answer</label><input type="text" data-name="faqs[__INDEX__][answer]" class="form-control"></div>
            <div class="col-md-1"><label class="form-label">Sort</label><input type="number" data-name="faqs[__INDEX__][sort_order]" class="form-control" value="__SORT__"></div>
        </div>
    </div>
</template>

<template id="pricingTemplate">
    <div class="builder-card" data-builder-row data-plan-row data-plan-key="__KEY__">
        <input type="hidden" data-name="pricing_plans[__INDEX__][key]" value="__KEY__">
        <div class="d-flex justify-content-between align-items-center mb-2"><span class="builder-title">Pricing Plan</span><button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button></div>
        <div class="row g-3">
            <div class="col-md-3"><label class="form-label">Plan Name</label><input type="text" data-name="pricing_plans[__INDEX__][title]" class="form-control plan-title-input" value="New Plan"></div>
            <div class="col-md-2"><label class="form-label">Price</label><input type="number" step="0.01" min="0" data-name="pricing_plans[__INDEX__][price]" class="form-control"></div>
            <div class="col-md-2"><label class="form-label">Currency</label><input type="text" data-name="pricing_plans[__INDEX__][currency]" class="form-control" value="USD"></div>
            <div class="col-md-2"><label class="form-label">Duration</label><input type="text" data-name="pricing_plans[__INDEX__][duration]" class="form-control" value="monthly"></div>
            <div class="col-md-3"><label class="form-label">CTA Text</label><input type="text" data-name="pricing_plans[__INDEX__][cta_label]" class="form-control" value="Get Started"></div>
            <div class="col-md-6"><label class="form-label">Plan Description</label><input type="text" data-name="pricing_plans[__INDEX__][description]" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Features List</label><textarea data-name="pricing_plans[__INDEX__][features]" rows="3" class="form-control" placeholder="One feature per line"></textarea></div>
            <div class="col-md-2"><label class="form-label">Sort</label><input type="number" min="0" data-name="pricing_plans[__INDEX__][sort_order]" class="form-control" value="__SORT__"></div>
            <div class="col-md-3"><label class="form-label">Status</label><select data-name="pricing_plans[__INDEX__][status]" class="form-select"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            <div class="col-md-3 d-flex align-items-end"><label class="form-check mb-2"><input class="form-check-input" type="checkbox" data-name="pricing_plans[__INDEX__][is_popular]" value="1"> Highlight as popular</label></div>
        </div>
    </div>
</template>

<template id="countryTemplate">
    <div class="builder-card" data-builder-row>
        <div class="d-flex justify-content-between align-items-center mb-2"><span class="builder-title">Country Price</span><button type="button" class="btn btn-outline-danger btn-sm" data-remove-row><i class="bi bi-trash"></i></button></div>
        <div class="row g-3">
            <div class="col-md-3"><label class="form-label">Plan</label><select data-name="country_prices[__INDEX__][plan_key]" class="form-select country-plan-select"></select><input type="hidden" data-name="country_prices[__INDEX__][plan_title]"></div>
            <div class="col-md-2"><label class="form-label">Country Code</label><input type="text" data-name="country_prices[__INDEX__][country_code]" class="form-control" placeholder="PK"></div>
            <div class="col-md-3"><label class="form-label">Country Name</label><input type="text" data-name="country_prices[__INDEX__][country_name]" class="form-control" placeholder="Pakistan"></div>
            <div class="col-md-2"><label class="form-label">Currency</label><input type="text" data-name="country_prices[__INDEX__][currency]" class="form-control" placeholder="PKR"></div>
            <div class="col-md-2"><label class="form-label">Price</label><input type="number" step="0.01" min="0" data-name="country_prices[__INDEX__][price]" class="form-control"></div>
        </div>
    </div>
</template>

@push('scripts')
    <script>
        (() => {
            const form = document.getElementById('saasProductForm');
            const titleInput = document.getElementById('titleInput');
            const slugInput = document.getElementById('slugInput');
            const submitButton = document.getElementById('submitProductBtn');
            const backendErrors = @json($errors->messages());
            const imageTypes = ['image/jpeg', 'image/png', 'image/webp'];
            const maxImageBytes = 4 * 1024 * 1024;
            let slugEdited = Boolean(slugInput?.value);
            let screenshotFiles = [];
            let formErrors = {};

            const escapeHtml = (value) => String(value || '').replace(/[&<>"']/g, char => ({'&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#039;'}[char]));
            const lines = (value) => String(value || '').split(/\r?\n|,/).map(item => item.trim()).filter(Boolean);
            const field = (name) => form.querySelector(`[name="${name}"]`);
            const value = (name) => field(name)?.value || '';
            const friendlyName = (name) => {
                if (name.includes('[currency]')) return 'Currency';
                if (name.includes('[price]')) return 'Price';
                if (name.includes('[title]')) return name.startsWith('pricing_plans') ? 'Plan name' : 'Title';
                if (name.includes('[cta_label]')) return 'CTA text';
                if (name.includes('[country_name]')) return 'Country name';
                if (name.includes('[country_code]')) return 'Country code';
                if (name === 'video_url') return 'Video URL';
                if (name === 'thumbnail') return 'Thumbnail';
                if (name === 'slug') return 'SEO slug';
                if (name === 'overview') return 'Product overview';
                return name.replaceAll('_', ' ');
            };
            const tabForField = (name) => {
                if (['title', 'slug', 'tagline', 'category', 'icon', 'sort_order', 'status'].includes(name)) return 'basic';
                if (['overview', 'how_it_works', 'access_instructions', 'benefits', 'use_cases', 'tech_stack'].includes(name) || name.startsWith('features') || name.startsWith('faqs')) return 'content';
                if (['thumbnail', 'thumbnail_alt', 'video_url', 'demo_url'].includes(name) || name.startsWith('screenshots') || name.startsWith('screenshot_') || name.startsWith('existing_screenshots')) return 'media';
                if (name.startsWith('pricing_plans') || name.startsWith('country_prices')) return 'pricing';
                return 'seo';
            };

            const slugify = (value) => value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            const normalizeErrorKey = (key) => {
                if (!key.includes('.')) return key;
                const parts = key.split('.');
                return parts.shift() + parts.map(part => `[${part}]`).join('');
            };
            const userMessage = (name, message) => {
                if (/currency.*greater than 10|currency.*10 characters/i.test(message)) return 'Currency must be 10 characters or less.';
                if (/must be an image|file of type/i.test(message)) return `${friendlyName(name)} must be a JPG, JPEG, PNG, or WebP image.`;
                if (/greater than 4096|max/i.test(message) && name.includes('screenshot')) return 'Screenshot must be 4MB or smaller.';
                return message.replace(name, friendlyName(name));
            };
            const ensureFeedback = (input) => {
                let feedback = input.parentElement.querySelector(':scope > .invalid-feedback.client-feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback client-feedback';
                    input.insertAdjacentElement('afterend', feedback);
                }
                return feedback;
            };
            const setError = (input, message) => {
                if (!input?.name) return;
                formErrors[input.name] = { message, tab: tabForField(input.name) };
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                ensureFeedback(input).textContent = message;
            };
            const clearError = (input) => {
                if (!input?.name) return;
                delete formErrors[input.name];
                input.classList.remove('is-invalid');
                const feedback = input.parentElement.querySelector(':scope > .invalid-feedback.client-feedback');
                if (feedback) feedback.textContent = '';
                if (input.value && input.type !== 'file') input.classList.add('is-valid');
            };
            const updateTabBadges = () => {
                const tabsWithErrors = new Set(Object.values(formErrors).map(error => error.tab));
                document.querySelectorAll('[data-tab-key]').forEach(tab => {
                    tab.querySelector('.tab-error-dot')?.classList.toggle('d-none', !tabsWithErrors.has(tab.dataset.tabKey));
                });
                if (submitButton) {
                    submitButton.disabled = Object.keys(formErrors).length > 0;
                    submitButton.title = submitButton.disabled ? 'Fix validation errors before saving.' : '';
                }
            };

            function validateInput(input) {
                if (!input?.name || input.disabled) return true;
                const name = input.name;
                const val = input.value.trim();
                clearError(input);

                if (['title', 'slug', 'overview'].includes(name) && !val) {
                    setError(input, `${friendlyName(name)} is required.`);
                } else if (name === 'slug' && val && !/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(val)) {
                    setError(input, 'Slug can use lowercase letters, numbers, and single hyphens only.');
                } else if (name === 'sort_order' && (val === '' || Number(val) < 0 || Number.isNaN(Number(val)))) {
                    setError(input, 'Sort order must be a valid number.');
                } else if (name === 'video_url' && val && !embedUrl(val)) {
                    setError(input, 'Use a supported YouTube, Vimeo, or direct MP4 video URL.');
                } else if ((name === 'demo_url' || name === 'canonical_url') && val && !/^https?:\/\/\S+/i.test(val)) {
                    setError(input, `${friendlyName(name)} must start with http:// or https://.`);
                } else if (name.includes('[currency]') && val.length > 10) {
                    setError(input, 'Currency must be 10 characters or less.');
                } else if (name.includes('[price]') && val && (Number.isNaN(Number(val)) || Number(val) < 0)) {
                    setError(input, 'Price must be a valid number greater than or equal to 0.');
                } else if (name.startsWith('pricing_plans') && name.includes('[title]') && !val) {
                    setError(input, 'Plan name is required.');
                } else if (name.startsWith('pricing_plans') && name.includes('[cta_label]') && val.length > 255) {
                    setError(input, 'CTA text must be 255 characters or less.');
                } else if (name.startsWith('country_prices') && name.includes('[country_name]')) {
                    const row = input.closest('[data-builder-row]');
                    const rowHasValue = [...row.querySelectorAll('input,select')].some(rowInput => rowInput.value.trim());
                    if (rowHasValue && !val) setError(input, 'Country name is required for country pricing.');
                } else if (name.startsWith('country_prices') && name.includes('[currency]')) {
                    const row = input.closest('[data-builder-row]');
                    const rowHasValue = [...row.querySelectorAll('input,select')].some(rowInput => rowInput.value.trim());
                    if (rowHasValue && !val) setError(input, 'Currency is required for country pricing.');
                } else if (name.startsWith('country_prices') && name.includes('[price]')) {
                    const row = input.closest('[data-builder-row]');
                    const rowHasValue = [...row.querySelectorAll('input,select')].some(rowInput => rowInput.value.trim());
                    if (rowHasValue && !val) setError(input, 'Price is required for country pricing.');
                } else if (name === 'meta_title' && val.length > 255) {
                    setError(input, 'Meta title must be 255 characters or less.');
                } else if ((name === 'meta_description' || name === 'og_description' || name === 'twitter_description') && val.length > 500) {
                    setError(input, `${friendlyName(name)} must be 500 characters or less.`);
                }

                updateTabBadges();
                return !formErrors[name];
            }

            function validateFile(file, label) {
                if (!imageTypes.includes(file.type)) return `${label} must be a JPG, JPEG, PNG, or WebP image.`;
                if (file.size > maxImageBytes) return `${label} must be 4MB or smaller.`;
                return '';
            }

            function validateAll() {
                form.querySelectorAll('input[name], textarea[name], select[name]').forEach(validateInput);
                validateThumbnail();
                updateTabBadges();
                return Object.keys(formErrors).length === 0;
            }

            slugInput?.addEventListener('input', () => slugEdited = true);
            titleInput?.addEventListener('input', () => {
                if (!slugEdited) slugInput.value = slugify(titleInput.value);
                updateSeoPreview();
                validateInput(titleInput);
                validateInput(slugInput);
            });
            form.addEventListener('input', (event) => {
                validateInput(event.target);
                if (['meta_title', 'meta_description', 'slug'].includes(event.target.name)) updateSeoPreview();
                if (event.target.classList.contains('plan-title-input')) syncCountryPlanOptions();
            });
            form.addEventListener('blur', (event) => validateInput(event.target), true);
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
                tab.addEventListener('shown.bs.tab', validateAll);
            });

            function activateNames(container) {
                container.querySelectorAll('[data-name]').forEach(input => {
                    input.name = input.dataset.name;
                    input.removeAttribute('data-name');
                });
            }

            function addTemplate(templateId, targetId, token) {
                const target = document.getElementById(targetId);
                const index = target.querySelectorAll('[data-builder-row]').length;
                const key = token === 'pricing' ? `plan-new-${Date.now()}` : '';
                let html = document.getElementById(templateId).innerHTML
                    .replaceAll('__INDEX__', index)
                    .replaceAll('__SORT__', index + 1)
                    .replaceAll('__KEY__', key);
                target.insertAdjacentHTML('beforeend', html);
                activateNames(target.lastElementChild);
                syncCountryPlanOptions();
                target.lastElementChild.querySelectorAll('input, textarea, select').forEach(validateInput);
            }

            document.querySelector('[data-add-row="features"]')?.addEventListener('click', () => addTemplate('featureTemplate', 'featuresBuilder', 'features'));
            document.querySelector('[data-add-row="faqs"]')?.addEventListener('click', () => addTemplate('faqTemplate', 'faqsBuilder', 'faqs'));
            document.querySelector('[data-add-row="pricing"]')?.addEventListener('click', () => addTemplate('pricingTemplate', 'pricingBuilder', 'pricing'));
            document.querySelector('[data-add-row="country"]')?.addEventListener('click', () => addTemplate('countryTemplate', 'countryPricingBuilder', 'country'));

            document.addEventListener('click', (event) => {
                const removeButton = event.target.closest('[data-remove-row]');
                if (!removeButton) return;
                const row = removeButton.closest('[data-builder-row]');
                row?.remove();
                syncCountryPlanOptions();
                validateAll();
            });

            function planOptions() {
                return [...document.querySelectorAll('[data-plan-row]')].map(row => ({
                    key: row.dataset.planKey,
                    title: row.querySelector('.plan-title-input')?.value || 'Untitled plan',
                }));
            }

            function syncCountryPlanOptions() {
                const options = planOptions();
                document.querySelectorAll('.country-plan-select').forEach(select => {
                    const selected = select.value || select.dataset.selected;
                    select.innerHTML = options.map(option => `<option value="${escapeHtml(option.key)}" ${option.key === selected ? 'selected' : ''}>${escapeHtml(option.title)}</option>`).join('');
                    const hiddenTitle = select.parentElement.querySelector('input[type="hidden"]');
                    const current = options.find(option => option.key === select.value);
                    if (hiddenTitle) hiddenTitle.value = current?.title || '';
                });
            }

            document.addEventListener('change', (event) => {
                if (!event.target.classList.contains('country-plan-select')) return;
                const selected = planOptions().find(option => option.key === event.target.value);
                const hiddenTitle = event.target.parentElement.querySelector('input[type="hidden"]');
                if (hiddenTitle) hiddenTitle.value = selected?.title || '';
            });

            const thumbnailInput = document.getElementById('thumbnailInput');
            const thumbnailPreview = document.getElementById('thumbnailPreview');
            function validateThumbnail() {
                const file = thumbnailInput.files?.[0];
                clearError(thumbnailInput);
                if (!file) {
                    updateTabBadges();
                    return true;
                }
                const error = validateFile(file, 'Thumbnail');
                if (error) {
                    thumbnailInput.value = '';
                    thumbnailPreview.removeAttribute('src');
                    thumbnailPreview.style.display = 'none';
                    setError(thumbnailInput, error);
                    updateTabBadges();
                    return false;
                }
                thumbnailPreview.src = URL.createObjectURL(file);
                thumbnailPreview.style.display = 'block';
                updateTabBadges();
                return true;
            }
            thumbnailInput?.addEventListener('change', validateThumbnail);

            const screenshotsInput = document.getElementById('screenshotsInput');
            const screenshotsPreview = document.getElementById('screenshotsPreview');
            screenshotsInput?.addEventListener('change', () => {
                clearError(screenshotsInput);
                const validFiles = [];
                const errors = [];
                [...screenshotsInput.files].forEach((file, index) => {
                    const error = validateFile(file, `Screenshot ${index + 1}`);
                    if (error) {
                        errors.push(error);
                        return;
                    }
                    validFiles.push(file);
                });
                screenshotFiles = validFiles;
                if (errors.length) setError(screenshotsInput, [...new Set(errors)].join(' '));
                renderScreenshotPreview();
                updateTabBadges();
            });

            function renderScreenshotPreview() {
                screenshotsPreview.innerHTML = '';
                const dataTransfer = new DataTransfer();
                screenshotFiles.forEach((file, index) => {
                    dataTransfer.items.add(file);
                    screenshotsPreview.insertAdjacentHTML('beforeend', `
                        <div class="media-preview-item">
                            <img src="${URL.createObjectURL(file)}" alt="">
                            <input class="form-control form-control-sm mb-1" name="screenshot_title[${index}]" placeholder="Title" value="${escapeHtml(file.name.replace(/\.[^.]+$/, ''))}">
                            <input class="form-control form-control-sm mb-2" name="screenshot_alt[${index}]" placeholder="Alt text">
                            <button type="button" class="btn btn-outline-danger btn-sm w-100" data-remove-screenshot="${index}">Remove</button>
                        </div>
                    `);
                });
                screenshotsInput.files = dataTransfer.files;
            }

            screenshotsPreview?.addEventListener('click', (event) => {
                const button = event.target.closest('[data-remove-screenshot]');
                if (!button) return;
                screenshotFiles.splice(Number(button.dataset.removeScreenshot), 1);
                renderScreenshotPreview();
                if (!screenshotFiles.length) clearError(screenshotsInput);
                updateTabBadges();
            });

            const videoInput = document.getElementById('videoUrlInput');
            const videoPreview = document.getElementById('videoPreview');
            const embedUrl = (url) => {
                if (!url) return '';
                const youtube = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]+)/);
                if (youtube) return `https://www.youtube.com/embed/${youtube[1]}`;
                const vimeo = url.match(/vimeo\.com\/(?:video\/)?([0-9]+)/);
                if (vimeo) return `https://player.vimeo.com/video/${vimeo[1]}`;
                if (/\.mp4(?:\?.*)?$/i.test(url)) return url;
                return null;
            };

            function renderVideoPreview() {
                const url = videoInput.value.trim();
                const embed = embedUrl(url);
                clearError(videoInput);
                if (!url) {
                    videoPreview.innerHTML = '<span class="helper">Paste a YouTube, Vimeo, or direct MP4 URL to preview it here.</span>';
                    updateTabBadges();
                    return;
                }
                if (!embed) {
                    setError(videoInput, 'Use a supported YouTube, Vimeo, or direct MP4 video URL.');
                    videoPreview.innerHTML = '<span class="text-danger">Unsupported video URL. Use YouTube, Vimeo, or a direct MP4 link.</span>';
                    updateTabBadges();
                    return;
                }
                videoPreview.innerHTML = /\.mp4/i.test(embed)
                    ? `<video src="${escapeHtml(embed)}" controls></video>`
                    : `<iframe src="${escapeHtml(embed)}" allowfullscreen></iframe>`;
                updateTabBadges();
            }
            videoInput?.addEventListener('input', renderVideoPreview);

            function updateSeoPreview() {
                const title = value('meta_title') || value('title') || 'Product title';
                const description = value('meta_description') || value('tagline') || value('overview') || 'Product page description will appear here.';
                const slug = value('slug') || 'product-slug';
                document.getElementById('seoPreviewTitle').textContent = title;
                document.getElementById('seoPreviewUrl').textContent = `${window.location.origin}/projects/${slug}`;
                document.getElementById('seoPreviewDescription').textContent = description.slice(0, 165);
            }

            function collectFeatures(selector, titleName, descriptionName) {
                return [...document.querySelectorAll(selector)].map(row => ({
                    title: row.querySelector(`[name$="[${titleName}]"]`)?.value || '',
                    description: row.querySelector(`[name$="[${descriptionName}]"]`)?.value || '',
                })).filter(item => item.title || item.description);
            }

            function renderProductPreview() {
                const features = collectFeatures('#featuresBuilder [data-builder-row]', 'title', 'description');
                const faqs = collectFeatures('#faqsBuilder [data-builder-row]', 'question', 'answer');
                const plans = [...document.querySelectorAll('#pricingBuilder [data-builder-row]')].map(row => ({
                    title: row.querySelector('[name$="[title]"]')?.value || '',
                    price: row.querySelector('[name$="[price]"]')?.value || '0',
                    currency: row.querySelector('[name$="[currency]"]')?.value || 'USD',
                    duration: row.querySelector('[name$="[duration]"]')?.value || '',
                    description: row.querySelector('[name$="[description]"]')?.value || '',
                    features: lines(row.querySelector('[name$="[features]"]')?.value),
                    popular: row.querySelector('[name$="[is_popular]"]')?.checked,
                })).filter(plan => plan.title);

                document.getElementById('productPreviewContent').innerHTML = `
                    <div class="preview-hero">
                        <div class="small text-uppercase fw-bold">${escapeHtml(value('category') || 'SaaS Product')}</div>
                        <h2>${escapeHtml(value('title') || 'Untitled Product')}</h2>
                        <p class="mb-0">${escapeHtml(value('tagline') || value('overview') || 'Product summary will appear here.')}</p>
                    </div>
                    <div class="preview-section">
                        <h5>Overview</h5>
                        <p>${escapeHtml(value('overview') || 'No overview added yet.')}</p>
                    </div>
                    <div class="preview-section">
                        <h5>Main Features</h5>
                        <div class="row g-3">${features.map(feature => `<div class="col-md-4"><strong>${escapeHtml(feature.title)}</strong><p class="mb-0">${escapeHtml(feature.description)}</p></div>`).join('') || '<p class="mb-0 text-muted">No features added yet.</p>'}</div>
                    </div>
                    <div class="preview-section">
                        <h5>Benefits</h5>
                        <div class="preview-tags">${lines(value('benefits')).map(item => `<span>${escapeHtml(item)}</span>`).join('') || '<span>No benefits yet</span>'}</div>
                    </div>
                    <div class="preview-section">
                        <h5>Pricing</h5>
                        <div class="row g-3">${plans.map(plan => `<div class="col-md-4"><div class="border rounded-3 p-3 h-100">${plan.popular ? '<span class="badge bg-primary mb-2">Popular</span>' : ''}<h6>${escapeHtml(plan.title)}</h6><strong>${escapeHtml(plan.currency)} ${escapeHtml(plan.price)}</strong><div class="small text-muted">${escapeHtml(plan.duration)}</div><p>${escapeHtml(plan.description)}</p><ul>${plan.features.map(item => `<li>${escapeHtml(item)}</li>`).join('')}</ul></div></div>`).join('') || '<p class="mb-0 text-muted">No pricing plans added yet.</p>'}</div>
                    </div>
                    <div class="preview-section">
                        <h5>FAQs</h5>
                        ${faqs.map(faq => `<details class="mb-2"><summary>${escapeHtml(faq.title)}</summary><p>${escapeHtml(faq.description)}</p></details>`).join('') || '<p class="mb-0 text-muted">No FAQs added yet.</p>'}
                    </div>
                    <div class="preview-section">
                        <h5>SEO Preview</h5>
                        <div class="text-primary fw-bold">${escapeHtml(value('meta_title') || value('title') || 'Meta title')}</div>
                        <div class="text-success small">${escapeHtml(window.location.origin + '/projects/' + (value('slug') || 'product-slug'))}</div>
                        <p class="mb-0">${escapeHtml(value('meta_description') || value('tagline') || value('overview') || 'Meta description')}</p>
                    </div>
                `;
                new bootstrap.Modal(document.getElementById('productPreviewModal')).show();
            }

            document.getElementById('openPreviewBtn')?.addEventListener('click', renderProductPreview);
            document.getElementById('bottomPreviewBtn')?.addEventListener('click', renderProductPreview);
            form.addEventListener('submit', (event) => {
                if (!validateAll()) {
                    event.preventDefault();
                    const firstError = Object.keys(formErrors)[0];
                    const targetTab = firstError ? formErrors[firstError].tab : 'basic';
                    document.querySelector(`[data-tab-key="${targetTab}"]`)?.click();
                    setTimeout(() => field(firstError)?.focus(), 120);
                }
            });

            Object.entries(backendErrors).forEach(([key, messages]) => {
                const bracketName = normalizeErrorKey(key);
                const input = field(bracketName) || field(key);
                if (input) {
                    setError(input, userMessage(bracketName, messages[0]));
                    return;
                }
                formErrors[key] = {
                    message: userMessage(key, messages[0]),
                    tab: tabForField(key),
                };
            });

            syncCountryPlanOptions();
            renderVideoPreview();
            updateSeoPreview();
            validateAll();
        })();
    </script>
@endpush
