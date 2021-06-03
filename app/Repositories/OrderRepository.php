<?php


namespace App\Repositories;
use App\Models\Order;
use App\Repositories\CategoryRepository;
use App\Repositories\ResourceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Order as Model;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\NonRegisterOrder;
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
           ->paginate(5);
       return $orders;
    }
    public function NonRegisterIndex(Request $request)
    {

        $orders = NonRegisterOrder::query()
            ->join('address','non_register_orders.address_id','=','address.id')
            ->join('non_register_order_products', 'non_register_order_products.order_id','=',
                'non_register_orders.id')
            ->select('non_register_orders.id','non_register_orders.address_id', 'non_register_orders.status',
                'non_register_orders.created_at','non_register_orders.updated_at','non_register_orders.currency','address.email','address.phone',
                \DB::raw('ROUND(SUM(non_register_order_products.price),2) AS sum'))
            ->groupBy('non_register_orders.id')
            ->groupBy('non_register_orders.address_id')
            ->groupBy('non_register_orders.status')
            ->groupBy('non_register_orders.created_at')
            ->groupBy('non_register_orders.updated_at')
            ->groupBy('non_register_orders.currency')
            ->orderBy('non_register_orders.status')
            ->orderBy('non_register_orders.id')
            ->groupBy('address.id')
            ->groupBy('address.email')
            ->groupBy('address.phone')
            ->paginate(5);
        return $orders;
    }

    public function create(Request $request)
    {

       $nonRegisterUser = '';



       $checkUser =   Address::where('email', $request->user['email'])->orWhere('phone', $request->user['phone'])->first();
       if (!$checkUser)
       {
           $nonRegisterUser = new Address();
           $nonRegisterUser->address = $request->user['address'];
           $nonRegisterUser->corps = $request->user['corps'];
           $nonRegisterUser->email = $request->user['email'] ? $request->user['email']  : null;
           $nonRegisterUser->phone = $request->user['phone']  ? $request->user['phone']  : null;
           $nonRegisterUser->entrance = $request->user['entrance'] ? $request->user['entrance'] : null;
           $nonRegisterUser->flat = $request->user['flat'] ? $request->user['flat'] : null;
           $nonRegisterUser->home = $request->user['home'] ? $request->user['home'] : null;
           $nonRegisterUser->structure = $request->user['structure'] ? $request->user['structure'] : null;
           $nonRegisterUser->save();

       }

        $newOrder = new NonRegisterOrder;
        $newOrder ->address_id = $nonRegisterUser !== '' ? $nonRegisterUser->id : $checkUser->id;
        $newOrder->currency = 'RUB';
        $newOrder->save();
        foreach ($request->products as $item)
        {
            $newOrder->products()->attach( $item['id'], ['qty'=> $item['count'], 'title' => 'Non register', 'price' =>$item['price']]);
        }
        return $newOrder->products;
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
