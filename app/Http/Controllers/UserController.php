<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
    }

    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    /**
     * Handle API vote for a candidate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiVote(Request $request)
    {
        $request->validate([
            'candidate_name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        if ($user->hasVoted()) {
            return response()->json(['message' => 'Anda sudah melakukan pemilihan sebelumnya!'], 403);
        }

        // Cari kandidat berdasarkan nama
        $candidate = Candidate::where('name', $request->candidate_name)->first();

        if (!$candidate) {
            return response()->json(['message' => 'Kandidat tidak ditemukan.'], 404);
        }

        $vote = new Vote();
        $vote->user_id = $user->id;
        $vote->candidate_id = $candidate->id; // Gunakan ID kandidat yang ditemukan
        $vote->save();

        return response()->json(['message' => 'Pemilihan berhasil!'], 200);
    }
}
