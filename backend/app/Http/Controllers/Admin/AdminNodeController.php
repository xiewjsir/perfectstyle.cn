<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/24
 * Time: 14:47
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\AdminNode;
use DB;

class AdminNodeController extends CommonController {
    private $_validator = [
        'rules'      => [
            'name' => 'required',
            'icon'     => 'required',
            'uri' => 'required',
        ],
        'messages'   => [
            'required' => ':attribute不能为空'
        ],
        'attributes' => [
            'name' => '名称',
            'icon' => '图标',
            'uri' => '路径',
        ]
    ];

    public function index(Request $request) {
        $query   = AdminNode::query();
        $keyword = $request->get('keyword');
        if ($keyword) {
            $query->whereRaw("name like '%{$keyword}%'");
        }

        $adminNodes = $query->paginate(10);
        return view('admin.adminnode.index', compact('adminNodes'));
    }

    public function create() {
        $adminNodeTree = $this->_adminNodeTree(AdminNode::where('parent_id',0)->orderBy('sort','asc')->get());
        $methods = AdminNode::$methods;
        return view('admin.adminnode.create', compact('adminNodeTree','methods'));
    }

    public function edit($id) {
        $adminNode = AdminNode::findOrFail($id);
        $adminNodeTree = $this->_adminNodeTree(AdminNode::where('parent_id',0)->orderBy('sort','asc')->get(),$adminNode->parent_id);
        $methods = AdminNode::$methods;
        return view('admin.adminNode.edit', compact('adminNode','adminNodeTree','methods'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $validator = \Validator::make($data, ...array_values($this->_validator));
        if ($validator->fails()) {
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()]);
        }

        try {
            DB::transaction(function () use ($data) {
                AdminNode::create($data);
            });
        } catch (\Exception $e) {
            \Log::error('update admin menu error:' . json_encode($e));
            return response()->json(['code' => 400, 'message' => '添加菜单信息失败']);
        }

        return response()->json(['code' => 200, 'message' => '添加菜单信息成功']);
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
                $user = AdminNode::findOrFail($id);
                $user->update($data);
            });
        }catch (\Exception $e) {
            \Log::error('update admin menu error:' . json_encode($e));
            return response()->json(['code' => 400, 'message' => '编辑菜单信息失败']);
        }

        return response()->json(['code' => 200, 'message' => '编辑菜单信息成功']);
    }

    private function _adminNodeTree($adminNodes,$id = 0){
        static $html = '<option value="0">Root</option>';
        if(!$adminNodes->isEmpty()){
            foreach($adminNodes as $adminNode){
                $selected = $id == $adminNode->id ? 'selected' : '';
                $html .= '<option value="'.$adminNode->id.'" '.$selected.'>'.str_repeat('&nbsp;',$adminNode->level*6).$adminNode->name.'</option>';
                $this->_adminNodeTree($adminNode->children,$id);
            }
        }

        return $html;
    }
}