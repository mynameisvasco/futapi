<?php

namespace App\Application\Resources\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Domain\Entities\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class DrawCardAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        $this->validate($request);
        $card = Card::where("resource_id", $request["resource_id"])->first();

        $lastPathDigit = "0";
        if ($card->rare_type <= 1) {
            if ($card->level == "gold") {
                $lastPathDigit = "3";
            } else {
                if ($card->level == "silver") {
                    $lastPathDigit = "2";
                } else {
                    $lastPathDigit = "1";
                }
            }
        }
        $background = "https://www.fifarosters.com/assets/cards/fifa21/cards_bg_e_1_{$card->rare_type}_{$lastPathDigit}.png";

        $size = $request["size"] ?? 1;
        $img = Image::make($background)->resize(220 * $size, 305 * $size);
        $img->insert(Image::make($card->face_path)
            ->resize(122 * $size, 122 * $size), "bottom-right", 26, 147);
        $img->text('aaaa', 0, 0, function ($font) {
            $font->size(400);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
        });
        return response($img->encode("png"))
            ->header('Content-Type', 'image/png')
            ->header('Pragma', 'public')
            ->header('Content-Disposition', 'inline; filename="qrcodeimg.png"')
            ->header('Cache-Control', 'max-age=60, must-revalidate');
        //https://www.fifarosters.com/assets/cards/fifa21/cards_bg_e_1_25_0.png
    }

    protected function validate(Request $request)
    {
        $request->validate([
            "resource_id" => "numeric",
            "size" => "numeric|min:1|max:4"
        ]);
    }
}
