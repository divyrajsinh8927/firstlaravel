<?php

namespace App\Http\Controllers;

use SoulDoit\DataTable\SSP;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userManagement extends Controller
{
    public function list()
    {
        $dt_obj = $this->dtSsp();
        return view('admin.userManagement', [
            'dt_info'    => $dt_obj->getInfo(),
        ]);
    }

    public function get(Request $request)
    {
        $dt_obj = $this->dtSsp();
        return response()->json($dt_obj->getDtArr());
    }

    private function dtSsp()
    {
        $dt = [

            ['label' => 'id',         'db' => 'id',            'dt' => 0, 'formatter' => function ($value, $model) {

                return str_pad($value, 5, '0', STR_PAD_LEFT);
            }],
            ['label' => 'name',       'db' => 'name',          'dt' => 1,'formatter'=>function( $value, $model){
                $name = [
                    '<a href="javascript:void(0)" class="xedit" data-type="text" data-pk="'.$model->id.'" data-title="Enter name" data-name="name" > '. $value .'</a>',
                ];
                return implode(" ",$name);
            }],
            ['label' => 'email',      'db' => 'email',         'dt' => 2,'formatter'=>function( $value, $model){
                $name = [
                    '<a href="javascript:void(0)" class="xedit" data-type="email" data-pk="'.$model->id.'" data-title="Enter Email" data-name="email" > '. $value .'</a>',
                ];
                return implode(" ",$name);
            }],
            ['label' => 'created_at', 'db' => 'created_at' ,    'dt' => 3] ,

            ['label'=>'Action',     'db'=>'id', 'dt'=>4, 'formatter'=>function( $value, $model){
                $btns = [
                    '<span class="DeleteButton" style="float:right; margin-right: 25%" data-id="'.$value.'"><i class="fa fa-trash fa-2x" style="color: red; cursor: pointer;"></i></span>',
                ];
                return implode(" ",$btns);
            }],
        ];

        return (new SSP('users', $dt))->where('status',1)->where('is_delete',0);

    }

    public function deleteUser(Request $request)
    {
        $updateCategory = User::findOrFail($request->id)->update([
            'is_delete' => 1,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json(['success' => 'user Deleted successfully.']);
    }

    public function updateUser(Request $request)
    {
        if($request->ajax()){
            User::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => true]);
        }
    }
}
