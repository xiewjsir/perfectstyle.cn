<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/20
 * Time: 15:12
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class FileController extends CommonController {
    public function index(Request $request) {
        $query = File::query();
        $keyword = $request->get('keyword');
        if ($keyword) {
            $query->whereRaw("title like '%{$keyword}%'");
        }

        $files = $query->orderBy('id','desc')->paginate(10);
        return view('admin.file.index', compact('files'));
    }

    public function create() {
        return view('admin.file.create');
    }

    public function edit($id) {
        $file = file::findOrFail($id);
        return view('admin.file.edit', compact('file'));
    }

    public function upload(Request $request)
    {
        try{
            $uploadfile = $request->file('file');
            $type = $request->get('type','normal');
            if($uploadfile->isValid()){
                $file = new File;
                $file->fill($request->all());

                if('avatar' == $type){
                    $path ='/avatars/';
                }else{
                    $path ='/images/'.Carbon::today()->format('Ym').'/';
                }

                $title = $uploadfile->getClientOriginalName();
                $ext = $uploadfile->getClientOriginalExtension();
                $fileName = uniqid().'.'.$ext;

                $uploadfile->storeAs($path,$fileName,['disk'=>'public']);

                $file->path = $path.$fileName;
                $file->title = substr($title,0,stripos($title,'.'));
                $file->type = $type;
                $file->save();
                return ['code'=>200,'message'=>'Success','data'=>['file'=>$file]];
            }else{
                return ['code'=>400,'message'=>'Error'];
            }
        }catch (\Exception $e){
            \logger()->error('upload file error'.json_encode($e));
            exit('Error');
        }catch (\Throwable $e){
            \logger()->error('upload file error'.json_encode($e));
            exit('Error');
        }
    }

    public function destroy($id){
        try{
            $file = File::find($id);
            if($file){
                Storage::disk('public')->delete($file->path);
                $file->delete();
            }
        }catch(\Exepticon $e){
            \logger()->error('remove file exepticon'.json_encode($e));
            return ['code'=>400,'message'=>'Error'];
        }catch(\Throwable $e){
            \logger()->error('remove file throwable'.json_encode($e));
            return ['code'=>400,'message'=>'Error'];
        }

        return ['code'=>200,'message'=>'Success'];
    }
}