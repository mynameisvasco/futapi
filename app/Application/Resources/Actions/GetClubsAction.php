<?php

namespace App\Application\Resources\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Domain\Entities\Club;
use Illuminate\Http\Request;

class GetClubsAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $filters = $request->only(["name", "fifa_id"]);
        $clubs = Club::query();
        foreach ($filters as $key => $value) {
            $clubs->where($key, 'like', '%'.$value.'%');
        }
        return $clubs->simplePaginate(25);
    }

    protected function validate(Request $request)
    {
        $request->validate([
            "name" => "",
            "fifa_id" => "numeric"
        ]);
    }
}
