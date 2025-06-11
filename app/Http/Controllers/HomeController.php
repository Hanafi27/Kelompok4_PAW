<?php

namespace App\Http\Controllers;
use App\Models\Vote;
use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $sortOrder = $request->get('sort', 'desc');
        if ($user->role === 'admin') {
            $candidatesCount = Candidate::count();
            $candidatesVoteCount = Candidate::withCount('votes')->get();
            $userCount = User::where('role', '!=', 'admin')->count();
            $voteCount = Vote::count();
            $voteLogs = Vote::with('candidate')->orderBy('created_at', $sortOrder)->get();
            return view('admin.dashboard',compact('candidatesCount','userCount','voteCount','voteLogs','candidatesVoteCount','sortOrder'));
        } elseif ($user->role === 'user') {
            $candidates = Candidate::withCount('votes')->get();
            return view('user.dashboard',compact('candidates'));
        }
    }
}
