<?php

namespace App\Api\Http\Controllers;

use App\Application\Resources\Actions\GetCardPriceAction;
use App\Application\Resources\Actions\GetCardsAction;
use App\Application\Resources\Actions\GetClubsAction;
use App\Application\Resources\Actions\GetLeaguesAction;
use App\Application\Resources\Actions\GetNationsAction;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function cards(Request $request)
    {
        return (new GetCardsAction())($request);
    }

    public function cardPrice(Request $request)
    {
        return (new GetCardPriceAction())($request);
    }

    public function nations(Request $request)
    {
        return (new GetNationsAction())($request);
    }

    public function leagues(Request $request)
    {
        return (new GetLeaguesAction())($request);
    }

    public function clubs(Request $request)
    {
        return (new GetClubsAction())($request);
    }
}
