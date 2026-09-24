<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index', [
            'projects' => Project::query()->orderBy('sort_order')->get(),
            'activeModule' => 'work',
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.form', ['project' => new Project, 'activeModule' => 'work']);
    }

    public function store(Request $request): RedirectResponse
    {
        $project = Project::query()->create($this->validated($request));

        return redirect()->route('admin.projects.edit', $project)->with('status', 'Project created.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', compact('project') + ['activeModule' => 'work']);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $project->update($this->validated($request, $project));

        return back()->with('status', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Project removed.');
    }

    private function validated(Request $request, ?Project $project = null): array
    {
        $request->merge(['slug' => $request->input('slug') ?: Str::slug($request->input('title', ''))]);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'alpha_dash', 'max:180', Rule::unique('projects')->ignore($project)],
            'category' => ['nullable', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:600'],
            'description' => ['nullable', 'string', 'max:10000'],
            'technologies_text' => ['nullable', 'string', 'max:1000'],
            'project_url' => ['nullable', 'url', 'max:500'],
            'github_url' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
        ]);
        $data['technologies'] = collect(explode(',', $data['technologies_text'] ?? ''))->map(fn ($item) => trim($item))->filter()->values()->all();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        unset($data['technologies_text']);

        return $data;
    }
}
