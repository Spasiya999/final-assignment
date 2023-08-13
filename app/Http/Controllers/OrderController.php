<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display the orders index view.
     */
    public function index(){
        return view('admin.orders.index');
    }

    /**
     * Fetch and provide data for the orders DataTable.
     */
    public function dataTable(Request $request){
        // Define the column order for display and search
        $columnsOrder  = [
            'id',
            'total',
            'name',
            'payment_method',
            'payment_status',
            'status',
            null
        ];

        // Define columns for search
        $columnsSearch = [
            'id',
            ['sql'=>'(SELECT SUM(amount) FROM order_items WHERE order_id = orders.id) like ?'],
            ['sql' =>'CONCAT_WS(" ", TRIM(BOTH "\"" FROM JSON_EXTRACT(checkout_data, "$.first_name")), TRIM(BOTH "\"" FROM JSON_EXTRACT(checkout_data, "$.last_name"))) like ?'],
            'payment_method',
            'payment_status',
            'status',
        ];

        // Build the initial query
        $ordersQuery = Order::query()
            ->selectRaw('orders.*,
            (SELECT SUM(amount) FROM order_items WHERE order_id = orders.id) AS total,
            CONCAT_WS(" ",TRIM(BOTH "\"" FROM JSON_EXTRACT(checkout_data, "$.first_name")),TRIM(BOTH "\"" FROM JSON_EXTRACT(checkout_data, "$.last_name")))  AS name
            ');

        // Apply search filters
        if($request->search['value']){
            foreach($columnsSearch as $column){
                if(is_array($column)){
                    $ordersQuery->orWhereRaw($column['sql'], ["%{$request->search['value']}%"] );
                }else{
                    $ordersQuery->orWhere($column, 'like', ["%{$request->search['value']}%"] );
                }
            }
        }
        // Apply sorting
        if($request->order && !empty($columnsOrder[$request->order[0]['column']])){
            $ordersQuery->orderBy($columnsOrder[$request->order[0]['column']], $request->order[0]['dir'] );
        }else{
            $ordersQuery->orderBy('id','asc');
        }

        // Calculate filtered count
        $filteredCount = $ordersQuery->count();

        // Apply pagination
        if($request->length && $request->length!=-1){
            $ordersQuery->offset($request->start)->limit($request->length);
        }

        // Get orders data
        $orders = $ordersQuery->get();

        // Format data for DataTable
        $data = [];
        foreach($orders as $order){
            $data[]=[
                $order->id,
                $order->total,
                $order->name,
                $order->payment_method,
                $order->payment_status,
                $order->status,
                '<button '.($order->status =='cancelled' || $order->status =='approved' ? 'disabled' : '').' class="btn btn-success approve-btn ms-2 mt-2" data-id="'.$order->id.'" >Approve</button>
                <button '.($order->status =='cancelled' ? 'disabled' : '').' class="btn btn-danger cancel-btn ms-2 mt-2" data-id="'.$order->id.'" >Cancel</button>
                '
            ];
        }

        // Build response for DataTable
        $output = [
            "draw" => $request->draw,
            "recordsTotal" => Order::count(),
            "recordsFiltered" =>  $filteredCount,
            "data" => $data,
        ];

        return response()->json($output);
    }

    /**
     * Cancel an order.
     */
    public function cancel(Order $order){
        // Update the order status to 'cancelled'
        $update = $order->update([
            'status' => 'cancelled'
        ]);

        // Return response based on update result
        if($update){
            return response()->json([
                'message' => 'Order cancelled successfully',
                'status' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Unknown error occurred',
                'status' => false
            ]);
        }
    }

    /**
     * Approve an order.
     */
    public function approve(Order $order){
        // Update the order status to 'approved'
        $update = $order->update([
            'status' => 'approved'
        ]);

        // Return response based on update result
        if($update){
            return response()->json([
                'message' => 'Order approved successfully',
                'status' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Unknown error occurred',
                'status' => false
            ]);
        }
    }
}
