<?php

namespace App\Application\Resources\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Domain\Entities\League;
use Illuminate\Http\Request;

class GetLeaguesAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $filters = $request->only(["name", "fifa_id"]);
        $leagues = League::query();
        foreach ($filters as $key => $value) {
            $leagues->where($key, 'like', '%'.$value.'%');
        }
        return $leagues->simplePaginate(25);
    }

    protected function validate(Request $request)
    {
        $request->validate([
            "name" => "",
            "fifa_id" => "numeric"
        ]);
    }
}
