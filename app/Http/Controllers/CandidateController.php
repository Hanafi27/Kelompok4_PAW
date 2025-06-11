<?php
namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::paginate(10);
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'image' => 'nullable|image|max:2048', // Adjust validation rules as needed
        ]);

        $candidate = Candidate::create($request->only(['name', 'vision', 'mission']));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('candidates', 'public');
            $candidate->image_path = $imagePath;
            $candidate->save();
        }

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate created successfully');
    }

    public function show(Candidate $candidate)
    {
        return view('admin.candidates.show', compact('candidate'));
    }

    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'image' => 'nullable|image|max:2048', // Adjust validation rules as needed
        ]);

        $candidate->update($request->only(['name', 'vision', 'mission']));

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($candidate->image_path) {
                Storage::delete('public/' . $candidate->image_path);
            }

            $imagePath = $request->file('image')->store('candidates', 'public');
            $candidate->image_path = $imagePath;
            $candidate->save();
        }

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated successfully');
    }

    public function destroy(Candidate $candidate)
    {
        if ($candidate->image_path) {
            Storage::delete('public/' . $candidate->image_path);
        }

        $candidate->delete();
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted successfully');
    }

    /**
     * Get a list of candidates for API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiIndex()
    {
        $candidates = Candidate::all(); // Retrieve all candidates
        return response()->json($candidates);
    }

    /**
     * Get election results (vote counts for each candidate) for API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiResults()
    {
        $candidates = Candidate::withCount('votes')->get();

        return response()->json($candidates);
    }
}
