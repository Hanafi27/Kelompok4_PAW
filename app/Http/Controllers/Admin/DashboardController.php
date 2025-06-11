<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCandidates = Candidate::count();
        $totalVotes = Vote::count();
        
        // Hitung persentase voting
        $votingPercentage = $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100, 2) : 0;
        
        $votesByCandidate = Vote::selectRaw('candidate_id, count(*) as total')
            ->groupBy('candidate_id')
            ->with('candidate')
            ->get();

        $recentVotes = Vote::with(['user', 'candidate'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCandidates',
            'totalVotes',
            'votesByCandidate',
            'recentVotes',
            'votingPercentage'
        ));
    }
} 