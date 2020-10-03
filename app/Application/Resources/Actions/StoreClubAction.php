<?php

namespace App\Application\Resources\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Domain\Entities\Club;
use Illuminate\Http\Request;

class StoreClubAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $club = Club::create($request->only([
            "name",
            "badge_path",
            "fifa_id"
        ]));
        return response()->json(["message" => "{$club->name} club ({$club->id}) stored"]);
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
