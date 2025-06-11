<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class VoteController extends Controller
{
    public function index()
    {
        $votes = Vote::with(['user', 'candidate'])->paginate(10);
        
        $totalVotes = Vote::count();
        
        $votesByCandidate = Vote::selectRaw('candidate_id, count(*) as total')
            ->groupBy('candidate_id')
            ->with('candidate')
            ->get();

        return view('admin.votes.index', compact(
            'votes',
            'totalVotes',
            'votesByCandidate'
        ));
    }

    public function export()
    {
        $votes = Vote::with(['user', 'candidate'])->get();

        $csvData = "User Name,User Email,Candidate Name,Vote Time\n";

        foreach ($votes as $vote) {
            $csvData .= "\"" . $vote->user->name . "\",";
            $csvData .= "\"" . $vote->user->email . "\",";
            $csvData .= "\"" . $vote->candidate->name . "\",";
            $csvData .= "\"" . $vote->created_at . "\"\n";
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="votes.csv"',
        ];

        return Response::make($csvData, 200, $headers);
    }
} 