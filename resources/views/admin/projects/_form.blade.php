<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Project Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->title) }}" required placeholder="e.g. FinTech Multi-Currency Gateway">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $project->slug) }}" placeholder="e.g. fintech-multi-currency-gateway (auto-generated if empty)">
        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tagline</label>
        <input type="text" name="tagline" class="form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline', $project->tagline) }}" placeholder="e.g. High-throughput payment routing system">
        @error('tagline') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Project Type / Category</label>
        <input type="text" name="project_type" class="form-control @error('project_type') is-invalid @enderror" value="{{ old('project_type', $project->project_type) }}" placeholder="e.g. FinTech / SaaS / Enterprise">
        @error('project_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Summary (Card & Listing Overview)</label>
        <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" rows="2" placeholder="Short description for listing cards...">{{ old('summary', $project->summary) }}</textarea>
        @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Full Project Overview</label>
        <textarea name="overview" class="form-control @error('overview') is-invalid @enderror" rows="5" placeholder="Full narrative and introduction to the project...">{{ old('overview', $project->overview) }}</textarea>
        @error('overview') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">The Problem</label>
        <textarea name="problem" class="form-control @error('problem') is-invalid @enderror" rows="4" placeholder="What challenge or problem was this project solving?">{{ old('problem', $project->problem) }}</textarea>
        @error('problem') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">The Solution</label>
        <textarea name="solution" class="form-control @error('solution') is-invalid @enderror" rows="4" placeholder="How was the problem solved?">{{ old('solution', $project->solution) }}</textarea>
        @error('solution') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">My Role</label>
        <textarea name="my_role" class="form-control @error('my_role') is-invalid @enderror" rows="3" placeholder="Lead Architect, Full-Stack Engineer, etc.">{{ old('my_role', $project->my_role) }}</textarea>
        @error('my_role') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Architecture</label>
        <textarea name="architecture" class="form-control @error('architecture') is-invalid @enderror" rows="3" placeholder="Microservices, Event-driven, Monolith, etc.">{{ old('architecture', $project->architecture) }}</textarea>
        @error('architecture') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Challenges Faced</label>
        <textarea name="challenges" class="form-control @error('challenges') is-invalid @enderror" rows="3" placeholder="Technical hurdles and how they were overcome...">{{ old('challenges', $project->challenges) }}</textarea>
        @error('challenges') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Results & Business Impact</label>
        <textarea name="results" class="form-control @error('results') is-invalid @enderror" rows="3" placeholder="Quantifiable metrics, user growth, latency reduction...">{{ old('results', $project->results) }}</textarea>
        @error('results') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tech Stack (One per line)</label>
        <textarea name="tech_stack" class="form-control @error('tech_stack') is-invalid @enderror" rows="4" placeholder="Go&#10;PostgreSQL&#10;Docker&#10;Vue.js">{{ old('tech_stack', is_array($project->tech_stack) ? implode("\n", $project->tech_stack) : $project->tech_stack) }}</textarea>
        @error('tech_stack') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Key Highlights / Achievements (One per line)</label>
        <textarea name="highlights" class="form-control @error('highlights') is-invalid @enderror" rows="4" placeholder="Handled 1M+ daily requests&#10;99.99% Uptime&#10;Zero data loss migration">{{ old('highlights', is_array($project->highlights) ? implode("\n", $project->highlights) : $project->highlights) }}</textarea>
        @error('highlights') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Live Demo URL</label>
        <input type="url" name="demo_url" class="form-control @error('demo_url') is-invalid @enderror" value="{{ old('demo_url', $project->demo_url) }}" placeholder="https://example.com">
        @error('demo_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">GitHub Repository URL</label>
        <input type="url" name="github_url" class="form-control @error('github_url') is-invalid @enderror" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/user/repo">
        @error('github_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Project Thumbnail Image</label>
        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
        @if($project->thumbnail)
            <div class="mt-2 small text-muted">Current: <a href="{{ asset($project->thumbnail) }}" target="_blank">View image</a></div>
        @endif
        @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Thumbnail Alt Text</label>
        <input type="text" name="thumbnail_alt" class="form-control @error('thumbnail_alt') is-invalid @enderror" value="{{ old('thumbnail_alt', $project->thumbnail_alt) }}" placeholder="Image description for accessibility & SEO">
        @error('thumbnail_alt') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Project Date</label>
        <input type="date" name="project_date" class="form-control @error('project_date') is-invalid @enderror" value="{{ old('project_date', $project->project_date ? $project->project_date->format('Y-m-d') : '') }}">
        @error('project_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $project->sort_order ?? 1) }}" min="0">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="active" @selected(old('status', $project->status) === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $project->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" @checked(old('is_featured', $project->is_featured))>
            <label class="form-check-label fw-bold" for="is_featured">Featured Project (Highlighted on Homepage)</label>
        </div>
    </div>

    <hr class="my-4">
    <h4>SEO Settings</h4>

    <div class="col-md-6">
        <label class="form-label">Meta Title</label>
        <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $project->meta_title) }}">
        @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Focus Keyword</label>
        <input type="text" name="focus_keyword" class="form-control @error('focus_keyword') is-invalid @enderror" value="{{ old('focus_keyword', $project->focus_keyword) }}" placeholder="e.g. fintech payment engine">
        @error('focus_keyword') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">OG Image</label>
        <input type="file" name="og_image" class="form-control @error('og_image') is-invalid @enderror" accept="image/*">
        @if($project->og_image)
            <div class="mt-2 small text-muted">Current: <a href="{{ asset($project->og_image) }}" target="_blank">View image</a></div>
        @endif
        @error('og_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Meta Description</label>
        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="2">{{ old('meta_description', $project->meta_description) }}</textarea>
        @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mt-4 text-end">
    <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-check-circle"></i> {{ $isEdit ? 'Update Project' : 'Create Project' }}
    </button>
</div>
