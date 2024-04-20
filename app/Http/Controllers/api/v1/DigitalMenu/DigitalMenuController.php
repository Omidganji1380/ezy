<?php

namespace App\Http\Controllers\api\v1\DigitalMenu;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\DigitalMenu\StoreDigitalMenuRequest;
use App\Http\Requests\api\v1\DigitalMenu\UpdateDigitalMenuRequest;
use App\Models\api\v1\DigitalMenu\DigitalMenu;
use App\Models\Profile;
use App\traits\api\v1\getAllReservedLinks;
use Illuminate\Http\Request;
use Route;

class DigitalMenuController extends Controller
{
    use getAllReservedLinks;

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

    public function submitNewMenu() {
        $this->profileUrl = $this->req->link;
        $this->getAllReservedLinks();
        $user_id = $this->req->user_id;
        $query   = DigitalMenu::query()
                              ->where('link', $this->profileUrl)
                              ->exists();
        if (!$query && !$this->reservedLink) {
            $digitalMenu=DigitalMenu::query()
                       ->create([
                                    'link'    => $this->profileUrl,
                                    'user_id' => $user_id,
                                ]);

            return response()->json($digitalMenu, 201);
        }
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

    public function edit() {
        $digitalMenu=DigitalMenu::query()->whereUserId($this->req->user_id)->find($this->req->menu_id);
        return response($digitalMenu);
    }

    public function update(UpdateDigitalMenuRequest $request, DigitalMenu $digitalMenu) {
        //
    }

    public function destroy(DigitalMenu $digitalMenu) {
        //
    }
}
