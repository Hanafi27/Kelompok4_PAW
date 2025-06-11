<?php
namespace App\Http\Controllers;
use App\Models\Vote;
use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VoteController extends Controller
{
    public function index()
    {
        $candidates = Candidate::withCount('votes')->get();
        return view('vote', compact('candidates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|integer|exists:candidates,id',
        ]);

        $user = Auth::user();

        $existingVote = Vote::where('user_id', $user->id)->first();
        if ($existingVote) {
            return response()->json(['existingVote' => true]);
        }

        // Assign the candidate to the user
        $vote = new Vote();
        $vote->user_id = $user->id;
        $vote->candidate_id = $request->candidate_id;
        $vote->save();

        return response()->json(['existingVote' => false]);
    }


}
