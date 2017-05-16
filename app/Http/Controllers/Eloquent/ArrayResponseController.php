<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\User;
use Yajra\Datatables\Datatables;

class ArrayResponseController extends Controller
{
    /**
     * Display index page.
     *
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('eloquent.array');
    }

    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Datatables $datatables)
    {
        //$data1 = \App\Order::where('store_id', 910)->get();
        //dump($data1);
        return $datatables->eloquent(User::query())
            ->addColumn('action', '<a class="btn btn-success" href="#"><i class="glyphicon glyphicon-zoom-in icon-white"></i>查看 </a>
                            <a class="btn btn-info" href="#"><i class="glyphicon glyphicon-edit icon-white"></i> 编辑 </a>
                            <a class="btn btn-danger" href="#"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>')
            ->make(true);
    }
}

