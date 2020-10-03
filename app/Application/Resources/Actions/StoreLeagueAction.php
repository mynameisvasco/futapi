<?php

namespace App\Application\Resources\Actions;

use App\Domain\Entities\League;
use Illuminate\Http\Request;

class StoreLeagueAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $league = League::create($request->only([
            "name",
            "badge_path",
            "fifa_id"
        ]));
        return response()->json(["message" => "{$league->name} league ({$league->id}) stored"]);
    }

    protected function validate(Request $request)
    {
        $request->validate([
            "name" => "required",
            "badge_path" => "required",
            "fifa_id" => "required|numeric"
        ]);
    }
}
