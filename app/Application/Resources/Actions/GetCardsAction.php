<?php

namespace App\Application\Resources\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Domain\Entities\Card;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GetCardsAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $filters = $request->only([
            "rating",
            "rare_type",
            "weak_foot",
            "position",
            "name",
            "level",
            "club_id",
            "nation_id",
            "league_id",
            "skills",
            "base_id",
            "resource_id",
            "min_rating",
            "max_rating",
        ]);
        $cards = Card::query()->with("attributes");
        foreach ($filters as $key => $value) {
            if ($key != "min_rating" && $key != "max_rating") {
                $cards->where($key, "like", "%".$value."%");
            }
        }
        if (isset($filters["min_rating"])) {
            $cards->where("rating", ">=", $filters["min_rating"]);
        }
        if (isset($filters["max_rating"])) {
            $cards->where("rating", "<=", $filters["max_rating"]);
        }
        return response()->json($cards->simplePaginate(25));
    }

    protected function validate(Request $request)
    {
        $request->validate([
            "min_rating" => "numeric|min:0|max:99",
            "max_rating" => "numeric|min:0|max:99",
            "rating" => "numeric|min:0|max:99",
            "rare_type" => "numeric|min:0",
            "weak_foot" => "numeric|min:0|max:5",
            "position" => "",
            "name" => "",
            "level" => Rule::in(["gold", "silver", "bronze"]),
            "club_id" => "numeric",
            "nation_id" => "numeric",
            "league_id" => "numeric",
            "skills" => "numeric|min:0|max:5",
            "base_id" => "numeric",
            "resource_id" => "numeric"
        ]);
    }
}
