<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminNode;
use View;
use Route;
class CommonController extends Controller
{
    public function __construct() {
        $this->getLeftMenu();
    }


    public function getLeftMenu(){
        $currentMenuPath = AdminNode::where('uri',Route::currentRouteName())->orderBy('id','asc')->value('path');

        $menus = AdminNode::where('parent_id',0)->where('type','menu')->get();

        $leftMenus = $this->_formatLeftMenu($menus,$currentMenuPath);
        View::share('leftMenus', $leftMenus);
    }

    private function _formatLeftMenu($menus,$currentMenuPath){
        static $leftMenus = [];
        if(!$menus->isEmpty()){
            foreach($menus as $menu){
                $menu->selected = 0 === strpos($currentMenuPath,$menu->path) ? 1 : 0;
                $leftMenus[$menu->parent_id][$menu->id] = $menu->toArray();
                $this->_formatLeftMenu($menu->children,$currentMenuPath);
            }
        }

        return $leftMenus;
    }
}
