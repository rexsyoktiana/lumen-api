<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    private $orders;
    private $orderDetails;
    private $foods;
    private $users;

    public function __construct()
    {
        $this->orders = new Orders;
        $this->orderDetails = new OrderDetails();
        $this->foods = new Foods();
        $this->users = new User();
    }

    public function create(Request $request)
    {
        try {

            $order = $this->orders->get_where_id($request->id_order);

            if (empty($order)) {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Order ID Not Found'
                ]);
            }

            if ($order->order_status != 'aktif') {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  "Order ID can't be processed"
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
                if ($user->id != $order->id_user) {
                    return response()->json([
                        'status'    =>  'error',
                        'message'   =>  "You don't have access"
                    ]);
                }
            }

            $food = $this->foods->get_where_id($request->id_food);
            if (empty($food)) {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Food ID Not Found'
                ]);
            }

            if ($food->food_status != 'Ready') {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Food is not ready'
                ]);
            }

            $this->orderDetails->id_order       = $request->id_order;
            $this->orderDetails->id_food        = $request->id_food;
            $this->orderDetails->order_price    = $food->price;
            $this->orderDetails->total          = $request->total;

            if ($this->orderDetails->save()) {
                return response()->json(
                    [
                        'status'    =>  'success',
                        'message'   =>  'Order created successfully'
                    ]
                );
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $orderDetails   = OrderDetails::findOrFail($id);
            $order          = $this->orders->get_where_id($orderDetails->id_order);
            if ($order->order_status != 'aktif') {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  "Order ID can't be processed"
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
                if ($user->id != $order->id_user) {
                    return response()->json([
                        'status'    =>  'error',
                        'message'   =>  "You don't have access"
                    ]);
                }
            }

            $food = $this->foods->get_where_id($request->id_food);
            if (empty($food)) {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Food ID Not Found'
                ]);
            }

            if ($food->food_status != 'Ready') {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  'Food is not ready'
                ]);
            }

            $orderDetails->id_food    = $request->id_food;
            $this->orderDetails->order_price    = $food->price;
            $orderDetails->total      = $request->total;

            if ($orderDetails->save()) {
                return response()->json(
                    [
                        'status'    =>  'success',
                        'message'   =>  'Order created successfully'
                    ]
                );
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $orderDetails           = OrderDetails::findOrFail($id);
            $order          = $this->orders->get_where_id($orderDetails->id_order);
            if ($order->order_status != 'aktif') {
                return response()->json([
                    'status'    =>  'error',
                    'message'   =>  "Order ID can't be processed"
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
                if ($user->id != $order->id_user) {
                    return response()->json([
                        'status'    =>  'error',
                        'message'   =>  "You don't have access"
                    ]);
                }
            }

            if ($orderDetails->delete()) {
                return response()->json(
                    [
                        'status'    =>  'success',
                        'message'   =>  'Order deleted successfully'
                    ]
                );
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'    =>  'error',
                    'message'   =>  $e->getMessage()
                ]
            );
        }
    }
}
