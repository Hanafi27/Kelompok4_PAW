<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'vision',
        'mission',
        'image_path',
        // other fields
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getVotesCountAttribute()
    {
        return $this->votes()->count();
    }

    public function getVotePercentageAttribute()
    {
        $totalVotes = Vote::count();
        if ($totalVotes === 0) {
            return 0;
        }
        return (int) round(($this->votes_count / $totalVotes) * 100);
    }
}
