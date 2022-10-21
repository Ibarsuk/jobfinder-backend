<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCandidateRequest;
use App\Http\Requests\CreateCompanyRequest;
use App\Models\Company;
use App\Models\CompanyBlacklist;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public static function search() {
        $user = Auth::user();

        $blackList = CompanyBlacklist::select('company_id')->
        where('user_id', $user->id)->
        get()->
        pluck('company_id');

        $candidates = Company::select('id')->
        whereNotIn('id', $blackList)->
        orderBy('relevant_at', 'asc')->
        limit(100)->
        get()->
        pluck('id');

        return $candidates;
    }

    public static function store(CreateCompanyRequest $req) {
        $validated = $req->validated();

        if (isset($validated['photo'])) {
            $validated['photo'] = $validated['photo']->store('companies', 'public');
        }
        $user = Auth::user();

        if($user->company) abort(403, 'Can have only one company form');

        $user->company()->create($validated);
    }
}
