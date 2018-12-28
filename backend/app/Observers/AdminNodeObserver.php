<?php

namespace App\Observers;

use App\Models\AdminNode;
use DB;
class AdminNodeObserver
{
    /**
     * Handle the admin menu "created" event.
     *
     * @param  \App\Models\AdminNode  $adminMenu
     * @return void
     */
    public function created(AdminNode $adminMenu)
    {
        $this->calLevelAndPath($adminMenu);
    }

    /**
     * Handle the admin menu "updated" event.
     *
     * @param  \App\Models\AdminNode  $adminMenu
     * @return void
     */
    public function updated(AdminNode $adminMenu)
    {
        $this->calLevelAndPath($adminMenu);
    }

    /**
     * Handle the admin menu "deleted" event.
     *
     * @param  \App\Models\AdminNode  $adminMenu
     * @return void
     */
    public function deleted(AdminNode $adminMenu)
    {
        //
    }

    /**
     * Handle the admin menu "restored" event.
     *
     * @param  \App\Models\AdminNode  $adminMenu
     * @return void
     */
    public function restored(AdminNode $adminMenu)
    {
        //
    }

    /**
     * Handle the admin menu "force deleted" event.
     *
     * @param  \App\Models\AdminNode  $adminMenu
     * @return void
     */
    public function forceDeleted(AdminNode $adminMenu)
    {
        //
    }

    public function calLevelAndPath(AdminNode $adminMenu){
        if(!$adminMenu->parent_id) {
            $adminMenu->level = 0;
            $adminMenu->path = '-'.$adminMenu->id.'-';
        } else {
            $adminMenu->level = $adminMenu->parent->level + 1;
            $adminMenu->path = $adminMenu->parent->path.$adminMenu->id.'-';
        }

        DB::table($adminMenu->getTable())->where('id', $adminMenu->id)->update([
            'level' => $adminMenu->level,
            'path'  => $adminMenu->path,
        ]);

        foreach($adminMenu->children as $submenu){
            $this->calLevelAndPath($submenu);
        }
    }

}
