<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class PortfolioProjectController extends Controller
{
    /**
     * Display portfolio projects directory.
     */
    public function index(Request $request)
    {
        $query = Project::published()->with(['category', 'coverImage']);

        if ($catSlug = $request->input('category')) {
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $perPage = (int) $request->input('per_page', 12);
        if ($perPage < 1 || $perPage > 100) {
            $perPage = 12;
        }

        $projects = $query->orderBy('sort_order')->latest('published_at')->paginate($perPage)->withQueryString();
        $categories = ProjectCategory::active()->orderBy('sort_order')->get();

        return view('public.projects.index', compact('projects', 'categories'));
    }

    /**
     * Display single portfolio project details.
     */
    public function show(string $slug)
    {
        $project = Project::published()
            ->with(['category', 'coverImage', 'galleryUsages.media'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->where('category_id', $project->category_id)
            ->take(3)
            ->get();

        return view('public.projects.show', compact('project', 'relatedProjects'));
    }
}
