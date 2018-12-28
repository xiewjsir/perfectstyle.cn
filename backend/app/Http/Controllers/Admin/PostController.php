<?php

namespace App\Http\Controllers\Admin;

use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Column;
use App\Models\tag;
use DB;

class PostController extends CommonController {

    public function index(Request $request) {
        $query = Post::query();
        $postStatus = $request->get('post_status');
        if($postStatus){
            $query->where('post_status', 'publish');
        }

        $slug = '';
        if ($slug) {
            $query->where('column_id', Columns::where('status', 1)->where('slug', $slug)->value('id'));
        }

        $tag = $request->get('tag');
        if ($tag) {
            $query->whereHas('tags', function ($query) use($tag) {
                $query->where('tag_id', $tag);
            });
        }

        $keyword = $request->get('keyword');
        if ($keyword) {
            $query->whereRaw("title like '%{$keyword}%' or summary like '%{$keyword}%'");
        }

        $posts = $query->orderBy('sort', 'asc')->paginate(2);
        $columns = Column::where('status', 'publish')->get();
        return view('admin.post.index', compact('posts','columns'));
    }

    public function create() {
        $columns = Column::all();
        return view('admin.post.create', compact('columns'));
    }

    public function edit($id) {
        $post = post::findOrFail($id);
        $columns = Column::all();
        return view('admin.post.edit', compact('post','columns'));
    }


    public function store(Request $request) {
        $data = array_merge($request->all(),[
            'author'=>auth()->guard('admin')->user()->id
        ]);

        $validator = \Validator::make($request->all(), [
            'title'     => 'required',
            'column_id' => 'required|integer',
            'content'   => 'required',
        ], [
            'required' => ':attribute 不能为空',
            'integer'  => ':attribute 只能为整数',
        ], [
            'title'     => '标题',
            'column_id' => '栏目',
            'content'   => '内容',
        ]);

        if ($validator->fails()) {
            return response()->json(['code'=>400,'message'=>$validator->errors()->first()]);
        }

        $tagNames = explode(',',$data['tag_names']);
        foreach($tagNames as $tagName){
            $tags[] = ['name'=>$tagName,'slug'=>''];
        }

        try{
            DB::transaction(function () use ($data,$tags) {
                $post = Post::create(array_except($data, ['tag_names']));
                $post->tags()->createMany($tags);

                $fileIds = trim($data['file_ids'],',');
                !empty($fileIds) && $post->files()->sync(explode(',',$fileIds));
            });
        }catch (\Exception $e){
            \Log::error('post error:'.json_encode($e));
            return response()->json(['code'=>400,'message'=>'error']);
        }

        return response()->json(['code'=>200,'message'=>'success']);
    }

    public function update(Request $request,$id){
        $data = array_merge($request->all(),[
            'author'=>auth()->guard('admin')->user()->id
        ]);

        $validator = \Validator::make($request->all(), [
            'title'     => 'required',
            'column_id' => 'required|integer',
            'content'   => 'required',
        ], [
            'required' => ':attribute 不能为空',
            'integer'  => ':attribute 只能为整数',
        ], [
            'title'     => '标题',
            'column_id' => '栏目',
            'content'   => '内容',
        ]);

        if ($validator->fails()) {
            return response()->json(['code'=>400,'message'=>$validator->errors()->first()]);
        }

        $tagNames = explode(',',$data['tag_names']);
        foreach($tagNames as $tagName){
            $tags[] = ['name'=>$tagName,'slug'=>''];
        }

        try{
            DB::transaction(function () use ($id,$data,$tags) {
                $post = Post::findOrFail($id);
                $post->update($data);
                $tagIds = [];
                foreach($tags as $tagInfo){
                    $tag = tag::updateOrCreate(['name'=>$tagInfo['name']],['slug'=>$tagInfo['slug']]);
                    $tagIds[] = $tag->id;
                }
                $post->tags()->sync($tagIds);

                $fileIds = trim($data['file_ids'],',');
                !empty($fileIds) && $post->files()->sync(explode(',',$fileIds));
            });
        }catch (\Exception $e){
            \Log::error('post error:'.json_encode($e));
            return response()->json(['code'=>400,'message'=>'编辑文章失败']);
        }

        return response()->json(['code'=>200,'message'=>'编辑文章成功']);
    }

    public function updateField(Request $request){
        $id = $request->get('id');
        $publish = $request->get('publish');
        try{
            $post = Post::findOrFail($id);
            $post->update(['post_status'=>$publish ? 'publish' : 'draft']);
        }catch (\Exception $e){
            \Log::error('post error:'.json_encode($e));
            return response()->json(['code'=>400,'message'=>'编辑发布状态失败']);
        }

        return response()->json(['code'=>200,'message'=>'编辑发布状态成功']);
    }
}
