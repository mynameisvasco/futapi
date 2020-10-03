<?php

namespace App\Application\Resources\Actions;

use App\Domain\Entities\Nation;
use Illuminate\Http\Request;

class StoreNationAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $nation = Nation::create($request->only([
            "name",
            "badge_path",
            "fifa_id"
        ]));
        return response()->json(["message" => "{$nation->name} nation ({$nation->id}) stored"]);
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
