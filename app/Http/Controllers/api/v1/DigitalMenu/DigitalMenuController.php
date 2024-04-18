<?php

namespace App\Http\Controllers\api\v1\DigitalMenu;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\DigitalMenu\StoreDigitalMenuRequest;
use App\Http\Requests\api\v1\DigitalMenu\UpdateDigitalMenuRequest;
use App\Models\api\v1\DigitalMenu\DigitalMenu;
use Illuminate\Http\Request;

class DigitalMenuController extends Controller
{
    public $req;

    public function __construct(Request $request) {
        $this->req = $request;
    }

    public function getDigitalMenus() {
        $menuImgs      = [];
        $menuTitles    = [];
        $menuSubtitles = [];
        $menuLinks     = [];
        $menus         = DigitalMenu::query()
                                    ->where('user_id', $this->req->userId)
                                    ->orderByDesc('updated_at')
                                    ->get();
        foreach ($menus as $menu) {
            array_push($menuImgs, asset('/storage/pb/profiles/profile-' . $menu->id . '/' . $menu->image));
            array_push($menuTitles, $menu->title);
            array_push($menuSubtitles, $menu->subtitle);
            array_push($menuLinks, $menu->link);
        }
        $data = [
            'DigitalMenus'         => $menus,
            'DigitalMenuImgs'      => $menuImgs,
            'DigitalMenuTitles'    => $menuTitles,
            'DigitalMenuSubtitles' => $menuSubtitles,
            'DigitalMenuLinks'     => $menuLinks,
        ];
        return response()->json($data);

    }

    public function create() {
        //
    }

    public function store(StoreDigitalMenuRequest $request) {
        //
    }

    public function show(DigitalMenu $digitalMenu) {
        //
    }

    public function edit(DigitalMenu $digitalMenu) {
        //
    }

    public function update(UpdateDigitalMenuRequest $request, DigitalMenu $digitalMenu) {
        //
    }

    public function destroy(DigitalMenu $digitalMenu) {
        //
    }
}
