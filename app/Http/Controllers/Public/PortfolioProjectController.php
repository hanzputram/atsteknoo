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

        $projects = $query->orderBy('sort_order')->latest('published_at')->paginate(12)->withQueryString();
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
