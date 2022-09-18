<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Candidate;
use App\Models\CandidateBlacklist;
use App\Models\User;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public static function search() {
        $blackList = CandidateBlacklist::select('candidate_id')->
        where('user_id', 1)->
        get()->
        pluck('candidate_id');

        $candidates = Candidate::select()->
        with(['tags:id,name', 'user'])->
        whereNotIn('id', $blackList)->
        orderBy('relevant_at', 'asc')->
        limit(100)->
        get();

        return $candidates;
    }

    public static function store(Request $req) {
        //
    }

    public static function getCandidateId (Request $req, $id) {
        return "worker with id {$id} and ip {$req->ip()}";
    }
}
