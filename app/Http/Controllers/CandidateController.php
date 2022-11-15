<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCandidateRequest;
use App\Http\Requests\GetCandidatesInfoRequest;
use App\Models\Candidate;
use App\Models\CandidateBlacklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public static function search() {
        $user = Auth::user();

        $blackList = CandidateBlacklist::select('candidate_id')->
        where('user_id', $user->id)->
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

    public static function getInfo(GetCandidatesInfoRequest $req) {
        $ids = $req->query('ids');

        $candidates = Candidate::whereIn('id', $ids)
        ->where('active', true)
        ->with('user:id,first_name,birth_date')
        ->get();

        $foundFormIds = $candidates->pluck('id')->all();
        $notFoundFormIds = array_diff($ids, $foundFormIds);

        return [
            'data' => $candidates,
            'not_found' => $notFoundFormIds,
        ];
    }

    public static function store(CreateCandidateRequest $req) {
        $validated = $req->validated();

        if (isset($validated['photo'])) {
            $validated['photo'] = $validated['photo']->store('candidates', 'public');
        }
        $user = Auth::user();

        if($user->candidate) abort(403, 'Can have only one candidate form');

        $user->candidate()->create($validated);
    }

    public static function getCandidateId (Request $req, $id) {
        return "worker with id {$id} and ip {$req->ip()}";
    }
}
