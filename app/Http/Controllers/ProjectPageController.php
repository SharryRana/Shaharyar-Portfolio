<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectPageController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::active()->orderBy('sort_order')->orderBy('title');

        if ($request->filled('type')) {
            $query->where('project_type', $request->type);
        }

        $projects = $query->paginate(12)->withQueryString();

        $projectTypes = Project::active()
            ->whereNotNull('project_type')
            ->distinct()
            ->pluck('project_type')
            ->sort()
            ->values();

        return view('frontend.projects.index', compact('projects', 'projectTypes'));
    }

    public function show(string $slug)
    {
        // 301 Redirect old SaaS product URLs under /projects/{slug} to /saas/{slug}
        if (\App\Models\SaasProduct::active()->where('slug', $slug)->exists()) {
            return redirect(route('saas.show', $slug), 301);
        }

        $project = Project::active()
            ->where('slug', $slug)
            ->with('screenshots')
            ->firstOrFail();

        $related = Project::active()
            ->where('id', '!=', $project->id)
            ->when($project->project_type, fn ($q) => $q->where('project_type', $project->project_type))
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('frontend.projects.show', compact('project', 'related'));
    }
}
