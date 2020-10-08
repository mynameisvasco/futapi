<?php

namespace App\Application\Resources\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetCardPriceAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $response = Http::get("https://www.futbin.com/21/playerPrices?player={$request["resource_id"]}");
        $prices = $response->json()[$request["resource_id"]]["prices"];
        return response()->json([
            "xbox" => [
                "values" => [
                    $prices["xbox"]["LCPrice"],
                    $prices["xbox"]["LCPrice2"],
                    $prices["xbox"]["LCPrice3"],
                    $prices["xbox"]["LCPrice4"],
                    $prices["xbox"]["LCPrice5"]
                ],
                "updated_at" => $prices["xbox"]["updated"]
            ],
            "pc" => [
                "values" => [
                    $prices["pc"]["LCPrice"],
                    $prices["pc"]["LCPrice2"],
                    $prices["pc"]["LCPrice3"],
                    $prices["pc"]["LCPrice4"],
                    $prices["pc"]["LCPrice5"]
                ],
                "updated_at" => $prices["pc"]["updated"]
            ],
            "ps" => [
                "values" => [
                    $prices["ps"]["LCPrice"],
                    $prices["ps"]["LCPrice2"],
                    $prices["ps"]["LCPrice3"],
                    $prices["ps"]["LCPrice4"],
                    $prices["ps"]["LCPrice5"]
                ],
                "updated_at" => $prices["ps"]["updated"]
            ],
        ]);
    }

    protected function validate(Request $request)
    {
        $request->validate([
            'resource_id' => 'numeric|required'
        ]);
    }
}
