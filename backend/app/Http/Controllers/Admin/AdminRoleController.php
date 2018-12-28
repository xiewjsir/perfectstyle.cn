<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/24
 * Time: 14:02
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminRole;
use DB;

class AdminRoleController extends CommonController {

    private $_validator = [
        'rules'      => [
            'name_en' => 'required',
            'name_cn'     => 'required',
        ],
        'messages'   => [
            'required' => ':attribute不能为空'
        ],
        'attributes' => [
            'name_en' => '英文名称',
            'name_cn' => '中文名称',
        ]
    ];

    public function index(Request $request) {
        $query   = AdminRole::query();
        $keyword = $request->get('keyword');
        if ($keyword) {
            $query->whereRaw("title like '%{$keyword}%'");
        }

        $adminRoles = $query->paginate(10);
        return view('admin.adminrole.index', compact('adminRoles'));
    }

    public function create() {
        return view('admin.adminrole.create');
    }

    public function edit($id) {
        $adminRole = AdminRole::findOrFail($id);
        return view('admin.adminrole.edit', compact('adminRole'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $validator = \Validator::make($data, ...array_values($this->_validator));
        if ($validator->fails()) {
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()]);
        }

//        try {
            DB::transaction(function () use ($data) {
                AdminRole::create($data);
            });
//        } catch (\Exception $e) {
//            \Log::error('update admin menu error:' . json_encode($e));
//            return response()->json(['code' => 400, 'message' => '添加角色信息失败']);
//        }

        return response()->json(['code' => 200, 'message' => '添加角色信息成功']);
    }

    public function update(Request $request, $id) {
        $data = $request->all();

        $validator = $this->_validator;
        $validator = \Validator::make($request->all(), ...array_values($validator));
        if ($validator->fails()) {
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()]);
        }

        try {
            DB::transaction(function () use ($id, $data) {
                $user = AdminRole::findOrFail($id);
                $user->update($data);
            });
        }catch (\Exception $e) {
            \Log::error('update admin menu error:' . json_encode($e));
            return response()->json(['code' => 400, 'message' => '编辑角色信息失败']);
        }

        return response()->json(['code' => 200, 'message' => '编辑角色信息成功']);
    }
}