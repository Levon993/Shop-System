<?php


namespace App\Repositories;
use App\Models\Order;
use App\Repositories\CategoryRepository;
use App\Repositories\ResourceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Order as Model;
use App\Models\Product;

use Illuminate\Http\Request;

class OrderRepository extends CoreRepository implements ResourceInterface
{

    protected function getModelClass()
    {
            return Model::class;
    }

    public function getProductsForBasket(Request $request)
    {
        $requestData = $request->all();
        $prodId = [];
        foreach ($requestData as $item)
        {
            array_push($prodId, $item['id']);
        }
        $prodId =  array_values($prodId);

        $data = Product::with(['category','brand'])->whereIn('id',$prodId)->get();

        return response()->json($data);
    }


    public function index(Request $request)
    {
       $orders = Order::query()
           ->join('users','orders.user_id','=','users.id')
           ->join('order_products', 'order_products.order_id','=',
               'orders.id')
           ->select('orders.id','orders.user_id', 'orders.status',
               'orders.created_at','orders.updated_at','orders.currency','users.name',
               \DB::raw('ROUND(SUM(order_products.price),2) AS sum'))
           ->groupBy('orders.id')
           ->groupBy('orders.user_id')
           ->groupBy('orders.status')
           ->groupBy('orders.created_at')
           ->groupBy('orders.updated_at')
           ->groupBy('orders.currency')
           ->orderBy('orders.status')
           ->orderBy('orders.id')
           ->groupBy('users.id')
           ->groupBy('users.name')
           ->get();
       return $orders;
    }

    public function create(Request $request)
    {
        // TODO: Implement create() method.
    }

    public function destroy(Request $request)
    {
        // TODO: Implement destroy() method.
    }

    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }
}
