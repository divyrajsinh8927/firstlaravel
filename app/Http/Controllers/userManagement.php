<?php

namespace App\Http\Controllers;

use SoulDoit\DataTable\SSP;

use Illuminate\Http\Request;

class userManagement extends Controller
{
    public function AllUsers()
    {
        $dt_obj = $this->dtSsp();
        return view('admin.userManagement', [
            'dt_info'       => $dt_obj->getInfo(),
        ]);
    }

    public function get($id = null)
    {
        $dt_obj = $this->dtSsp();

        return response()->json($dt_obj->getDtArr());
    }

    private function dtSsp()
    {
        $dt = [
            ['label' => 'ID',         'db' => 'id',            'dt' => 0, 'formatter' => function ($value, $model) {
                return str_pad($value, 5, '0', STR_PAD_LEFT);
            }],
            ['label' => 'Email',      'db' => 'email',         'dt' => 2],
            ['label' => 'Username',   'db' => 'name',         'dt' => 1],
            ['label' => 'Created At', 'db' => 'created_at',    'dt' => 6],
            ['label' => 'Action',     'db' => 'id',            'dt' => 0, 'formatter' => function ($value, $model) {
                $btns = [
                    '<button onclick="edit(\'' . $value . '\');">Edit</button>',
                    '<button onclick="delete(\'' . $value . '\');">Delete</button>',
                ];
                return implode(" ",$btns);
            }],
        ];
        return (new SSP('App\Models\User', $dt));
    }
}
