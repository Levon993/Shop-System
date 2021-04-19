<?php


namespace App\Repositories;
use App\Repositories\CategoryRepository;
use App\Repositories\ResourceInterface;
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
        // TODO: Implement index() method.
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
