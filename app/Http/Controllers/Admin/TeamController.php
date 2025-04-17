<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $query = Team::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('surname', 'like', '%' . $request->search . '%');
        }

        $teams = $query->latest()->paginate(10);
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create-edit');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'experience' => 'nullable|string|max:100',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('teams', 'public');
        }

        $data['status'] = $request->has('status');

        Team::create($data);
        return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully.');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.create-edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'experience' => 'nullable|string|max:100',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('teams', 'public');
        }

        $data['status'] = $request->has('status');

        $team->update($data);
        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted.');
    }
}
