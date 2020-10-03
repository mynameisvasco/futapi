<?php

namespace App\Application\Resources\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Domain\Entities\Nation;
use Illuminate\Http\Request;

class GetNationsAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $filters = $request->only(["name", "fifa_id"]);
        $nations = Nation::query();
        foreach ($filters as $key => $value) {
            $nations->where($key, 'like', '%'.$value.'%');
        }
        return $nations->simplePaginate(25);
    }

    protected function validate(Request $request)
    {
        $request->validate([
            "name" => "",
            "fifa_id" => "numeric"
        ]);
    }
}
