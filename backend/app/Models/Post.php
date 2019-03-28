<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\File;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";

    public $fillable = ['title', 'column_id', 'tag_name', 'author', 'summary', 'content','post_status','comment_status','post_password'];
    public $appends = ['column_str','backend_tag_links'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_pivot', 'post_id', 'tag_id');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'post_file_pivot', 'post_id', 'file_id');
    }

    public function getColumnStrAttribute()
    {
        return Column::find($this->column_id)->name;
    }

    public function getTagLinksAttribute()
    {
        $html = '';
        if (!$this->tags->isEmpty()) {
            foreach ($this->tags as $tag) {
                $html .= '<a href="' . url('/', ['tag' => $tag->slug]) . '" title="' . $tag->name . '" target="_blank" class="">' . $tag->name . '</a>|';
            }
            $html = rtrim($html, '|');
        }

        return $html;
    }

    public function getBackendTagLinksAttribute(){
        $html = '';
        $colors = ['default','primary','info','success','warning','danger','mint','purple','pink'];
        if (!$this->tags->isEmpty()) {
            foreach ($this->tags as $tag) {
                $html .= '<a href="' . route('post.index', ['tag' => $tag->id]) . '" title="' . $tag->name . '" target="_blank" class=""><span class="label label-'.array_random($colors).'">' . $tag->name . '</span></a>&nbsp;';
            }
            $html = rtrim($html, '&nbsp;');
        }else{
            $html = '--';
        }

        return $html;
    }

    public function getTagNamesAttribute(){
        $html = '';
        if (!$this->tags->isEmpty()) {
            foreach ($this->tags as $tag) {
                $html .= $tag->name . ',';
            }
            $html = rtrim($html, ',');
        }

        return $html;
    }
}
