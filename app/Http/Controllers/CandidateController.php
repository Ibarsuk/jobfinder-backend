<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCandidateRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\Candidate;
use App\Models\CandidateBlacklist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public static function search() {
        $blackList = CandidateBlacklist::select('candidate_id')->
        where('user_id', 1)->
        get()->
        pluck('candidate_id');

        $candidates = Candidate::select('id')->
        whereNotIn('id', $blackList)->
        orderBy('relevant_at', 'asc')->
        limit(100)->
        get()->
        pluck('id');

        return $candidates;
    }

    public static function store(CreateCandidateRequest $req) {
        $validated = $req->validated();

        if (isset($validated['photo'])) {
            $validated['photo'] = $validated['photo']->store('candidates', 'public');
        }
        $user = Auth::user();

        if($user->candidate) abort(403);

        $user->candidate()->create($validated);
    }

    public static function getCandidateId (Request $req, $id) {
        return "worker with id {$id} and ip {$req->ip()}";
    }
}
