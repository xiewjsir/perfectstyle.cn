<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class adminNode extends Model
{
    protected $fillable = [
        'parent_id','sort','name','icon','uri','level','path','type','method'
    ];

    protected $table = "admin_node";

    public static $typeMap = [
        'menu'=>'菜单',
        'function'=>'功能'
    ];

    public static $methods = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'PATCH',
        'OPTIONS',
        'HEAD',
    ];

    public function parent(){
        return $this->belongsTo(adminNode::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(adminNode::class, 'parent_id');
    }

    public function getParentNameAttribute(){
        if(0 == $this->attributes['parent_id']){
            return '--';
        }

        return $this->parent->name;
    }

    public function getMethodStrAttribute(){
        $html = '';
        $colors = [
            'ANY'=>'pink','POST'=>'info','PUT'=>'purple','DELETE'=>'warning','PATCH'=>'danger',
            'OPTIONS'=>'mint','HEAD'=>'success','GET'=>'primary'
        ];

        $methodArr = explode(',',$this->attributes['method']);
        if (!empty($methodArr)) {
            foreach ($methodArr as $method) {
                $html .= '<span class="label label-'.$colors[$method].'">' . $method . '</span>&nbsp;';
            }
        }else{
            $html = '<span class="label label-primary">ANY</span>&nbsp;';
        }

        return $html;
    }

    public function getTypeStrAttribute(){
        return static::$typeMap[$this->attributes['type']];
    }

    public function getMethodAttribute(){
        return explode(',',$this->attributes['method']);
    }

    public function setMethodAttribute($value){
        $this->attributes['method'] = implode(',',$value);
    }
}
