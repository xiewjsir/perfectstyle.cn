<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/24
 * Time: 14:03
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\AdminRole;
use DB;
use Hash;

class AdminUserController extends CommonController {
    private $_validator = [
        'rules'      => [
            'username' => 'required|unique:AdminUsers',
            'name'     => 'required',
            'password' => 'required|min:6|max:32|confirmed',
            'password_confirmation' => 'required|min:6|max:32',
        ],
        'messages'   => [
            'required' => ':attribute不能为空',
            'min' => ':attribute最少:min字符',
            'max' => ':attribute最长:max字符',
            'confirmed' =>':attribute输入不一致',
            'unique' =>':attribute已存在',
        ],
        'attributes' => [
            'username' => '用户名',
            'name'     => '用户',
            'password' => '密码',
            'password_confirmation' => '密码确认',
        ]
    ];

    public function index(Request $request) {
        $query   = AdminUser::query();
        $keyword = $request->get('keyword');
        if ($keyword) {
            $query->whereRaw("name like '%{$keyword}%'");
        }

        $adminUsers = $query->paginate(10);
        return view('admin.adminuser.index', compact('adminUsers'));
    }

    public function create() {
        $adminRoles        = AdminRole::all();
        return view('admin.adminuser.create', compact('adminRoles'));
    }

    public function store(Request $request) {
        $data = array_merge($request->all(), [
            'author' => auth()->guard('admin')->user()->id,
        ]);


        $validator = \Validator::make($request->all(), ...$this->_validator);
        if ($validator->fails()) {
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()]);
        }

        $data['password'] = Hash::make($data['password']);
        try {
            DB::transaction(function () use ($data) {
                $user = AdminUser::create($data);
                $user->roles()->sync($data['roles']);
            });
        } catch (\Exception $e) {
            \Log::error('update admin user error:' . json_encode($e));
            return response()->json(['code' => 400, 'message' => '添加管理员信息失败']);
        }

        return response()->json(['code' => 200, 'message' => '添加管理员信息成功']);
    }

    public function edit($id) {
        $adminUser = AdminUser::findOrFail($id);
        $adminRoles         = AdminRole::all();
        return view('admin.adminuser.edit', compact('adminUser', 'adminRoles'));
    }

    public function update(Request $request, $id) {
        $data = array_merge($request->all(), [
            'author' => auth()->guard('admin')->user()->id,
        ]);


        $validator = $this->_validator;
        $validator['rules']['username'] = 'required|unique:admin_users,username,'.$id;
        if(!empty($data['password']) || !empty($data['password_confirmation'])){
            $validator['rules']['password'] = 'min:6|max:32|confirmed';
            $validator['rules']['password_confirmation'] = 'min:6|max:32';
        }else{
            unset($data['password'],$validator['rules']['password'],$validator['rules']['password_confirmation']);
        }

        $validator = \Validator::make($request->all(), ...array_values($validator));
        if ($validator->fails()) {
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()]);
        }

        !empty($data['password']) && $data['password'] = Hash::make($data['password']);
        try {
            DB::transaction(function () use ($id, $data) {
                $user = AdminUser::findOrFail($id);
                $user->update($data);
                $user->roles()->sync($data['roles']);
            });
        } catch (\Exception $e) {
            \Log::error('update admin user error:' . json_encode($e));
            return response()->json(['code' => 400, 'message' => '编辑管理员信息失败']);
        }

        return response()->json(['code' => 200, 'message' => '编辑管理员信息成功']);
    }
}