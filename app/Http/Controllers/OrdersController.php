<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    private $orders;
    private $users;
    public function __construct()
    {
        $this->orders = new Orders;
        $this->users = new User();
    }

    public function status($status)
    {
        try {
            $orders = $this->orders->get_where($status);
            return response()->json([
                'status'    =>  'success',
                'message'   =>  $orders,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $defaultId = 'ABC' . date('dmY') . '-';
            $getId  = $this->orders->get_last_order();

            $id = "";
            if (empty($getId[0])) {
                $id = $defaultId . '001';
            } else {
                $id = explode("-", $getId[0]->id);
                $today = 'ABC' . date('dmY');

                if ($id[0] != $today) {
                    $id = 1;
                } else {
                    $id = (int)$id[1];
                    $id = $id + 1;
                }

                $lengthId = strlen($id);
                if ($lengthId == 1) {
                    $id = $defaultId . '00' . $id;
                } elseif ($lengthId == 2) {
                    $id = $defaultId . '0' . $id;
                } else {
                    $id = $defaultId . $id;
                }
            }

            $user = $this->users->get_where_id($request->id_user);

            if (empty($user)) {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'User is not found'
                ]);
            }


            $data = [
                'id'            =>  $id,
                'id_user'       =>  $request->id_user,
                'order_status'  =>  'aktif',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            ];

            $this->orders->create($data);
            return response()->json([
                'status'    =>  'success',
                'message'   =>  'Order created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    public function pay(Request $request, $id)
    {
        try {
            $user = $this->users->get_where_id($request->id_user);
            if (empty($user)) {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'User is not found'
                ]);
            }

            if ($user->level != 'kasir') {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Only the cashier is allowed to complete the payment'
                ]);
            }

            $order = $this->orders->get_where_id($id);
            if (empty($order)) {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Orders not found'
                ]);
            }

            if ($order->order_status != 'aktif') {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Orders have been completed'
                ]);
            }

            // $getAll = $this->orders->get_all($id);
            $order = $this->orders->edit($id, [
                'order_status'  => 'selesai',
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
            return response()->json([
                'status'    =>  'success',
                'message'   =>  'Payment has been successful'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $order = $this->orders->get_where_id($id);
            if(empty($order)){
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Order ID not found'
                ]);
            }

            $user = $this->users->get_where_id($request->id_user);
            if (empty($user)) {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Users not found'
                ]);
            }

            if ($user->level == 'pelayan') {
                $getAll = $this->orders->get_all_waiters($request->id_user);
            } else {
                $getAll = $this->orders->get_all();
            }

            return response()->json([
                'status'    =>  'success',
                'message'   =>  $getAll
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    // public function delete(Request $request, $id)
    // {
    //     try {
            
    //         $id_user = $this->users->get_where_id($request->id_user);
    //         if(empty($id_user)){
    //             return response()->json([
    //                 'status'    =>  'error',
    //                 'message'   =>  'Users not found'
    //             ]);
    //         }


    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status'    =>  'error',
    //             'message'   =>  $e->getMessage()
    //         ]);
    //     }
    // }
}
