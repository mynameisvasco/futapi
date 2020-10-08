<?php

namespace App\Application\Resources\Actions;

use App\Application\Resources\Events\StoredCardEvent;
use App\Application\Common\Models\AbstractAction;
use App\Domain\Entities\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class StoreCardAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $card = Card::updateOrCreate(["resource_id" => $request["resource_id"]], $request->all());
        foreach ($request["attributes"] as $attribute) {
            $card->attributes()->updateOrCreate([
                "card_id" => $card->id,
                "name" => $attribute["name"]
            ], $attribute);
        }
        Event::dispatch(new StoredCardEvent($card));
        return response()->json(["message" => "{$card->display_name} card's ({$card->id}) stored"]);
    }

    protected function validate(Request $request)
    {
        $request->validate([
            "rating" => "required|numeric|min:0|max:99",
            "rare_type" => "required|numeric|min:0",
            "weak_foot" => "required|numeric|min:0|max:5",
            "weight" => "",
            "height" => "",
            "position" => "required",
            "display_name" => "required",
            "level" => "required",
            "foot" => "required",
            "def_work_rate" => "required",
            "att_work_rate" => "required",
            "name" => "required",
            "face_path" => "required",
            "club_id" => "required|numeric",
            "nation_id" => "required|numeric",
            "league_id" => "required|numeric",
            "skills" => "required|numeric|min:0|max:5",
            "base_id" => "required|numeric",
            "resource_id" => "required|numeric",
            "attributes" => "",
        ]);
    }
}
