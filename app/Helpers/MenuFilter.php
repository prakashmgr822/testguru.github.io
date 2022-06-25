<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
        if (GuardHelper::check() != ($item['guard'] ?? "") && ($item['guard'] ?? "All") != "All") {
            $item['restricted'] = true;
        }

        return $item;
    }
}
