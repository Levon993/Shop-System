<?php
namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Repositories\ResourceInterface;
use Illuminate\Support\Facades\Storage;
use App\Models\Product as Model;
use Exception;
use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\Discount;
class ProductRepository extends CoreRepository implements ResourceInterface
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function index(Request $request)
    {

            $products = $this->startConditions()::with(['category','brand'])->paginate(20);

        return $products;
    }

    public function create(Request $request)
    {

        try {
            //return response()->json($request->all());
            $file = $request->file('image');

            if (!$request->hasFile('image')) {
                return response()->json(['image not found']);
            }

            if (!$file->isValid()) {
                return response()->json(['invalid file upload']);
            }

            $path = public_path() . '/storage/images';
            $file->move($path, $file->getClientOriginalName());
            $storagePhat = Storage::url('app/public/images/' . $file->getClientOriginalName());
            $newProduct = $this->startConditions();
            $newProduct->category_id = $request->category_id;
            $newProduct->brand_id = $request->brand_id;
            $newProduct->title = $request->title;
            $newProduct->alias = $request->title;
            $newProduct->price = $request->price;
            $newProduct->keywords = $request->keywords;
            $newProduct->description = $request->description;
            $newProduct->img = $file->getClientOriginalName() ? $file->getClientOriginalName() : 'empty';
            $newProduct->save();
            return response()->json(['Message'=>'Product Successfully Created']);

        }catch (Exception $exception)
        {
            return response()->json(['Message'=>'Something Went Wrong']);
        }
    }

    public function search(Request $request)
    {
    //    return $request->all();
        $res = $this->startConditions()->with(['category','brand']);
        $category = $request->category;
        $title =  $request->title;
        $brand =  $request->brand;
        $price =  $request->price;
        $description = $request->description;
        if ($title)
        {
            $res->where('title','like','%'.$title.'%');
        }
        if ($description)
        {
            $res->where('description','like','%'.$description.'%');
        }
        if ($price)
        {
            $res->where('price',$price);
        }

        if ($category)
        {
            $res->whereHas('category', function ($q) use ($category)
            {
                $q->where('title', 'like', '%' .$category. '%');
            });
        }
        if ($brand)
        {
            $res->whereHas('brand', function ($q) use ($brand)
            {
                $q->where('title', 'like', '%' .$brand. '%');
            });
        }

        return $res->get();
    }

    public  function getByCategory(Request $request)
    {
        $res = $this->startConditions()->with(['category','brand'])->where('category_id', $request->categoryId)->get();
        return response()->json($res);
    }
    public  function recomended(Request $request)
    {

        $res = $this->startConditions()->with(['category','brand'])
            ->where('category_id', $request->data['category_id'])
            ->where('id','!=',$request->data['id'])
            ->OrWhere('brand_id', $request->data['brand_id'])
            ->OrWhere('price', $request->dat['price'])
            ->paginate(8);
        return response()->json($res);
    }

    public function hits(Request $request)
    {
        $res = $this->startConditions()->with('category')->where('hit','=','1')->paginate(10);
        return response()->json($res);
    }

    public function getById($id)
    {
        return $this->startConditions()->with('category')->find($id);
    }

    public function addToChoice(Request $request)
    {
        $res = $this->startConditions()::with('choices')->findOrFail($request->productId);
        if ($res->choices === null)
        {
            $product = new Choice(['product_id' => $request->productId]);
            $res->choices()->save($product);
        }
    }

    public function getChoices()
    {
        $res = $this->startConditions()->with(['choices','category','brand'])->whereHas("choices")->paginate(20);
        return $res ;
    }
    public function getChoicesForUser()
    {
        $res = $this->startConditions()->with(['choices','category','brand'])->whereHas("choices")->limit(8)->orderBy('id')->get();
        return $res ;
    }
    public function addToDiscount(Request $request)
    {
        $res = $this->startConditions()::with('discount')->findOrFail($request->productId);
        if ($res->discount === null)
        {
            $product = new Discount(['product_id' => $request->productId]);
            $res->discount()->save($product);
            return response()->json(['message' => 'Successfully added']);

        }
    }
    public function getDiscounts()
    {
        $res = $this->startConditions()->with(['discount','category','brand'])->whereHas("discount")->paginate(20);
        return $res ;
    }
    public function getDiscountsForUsers()
    {
        $res = $this->startConditions()->with(['discount','category','brand'])->whereHas("discount")->limit(8)->orderBy('id','DESC')->get();
        return $res ;
    }
    public function destroy(Request $request)
    {
        // TODO: Implement destroy() method.
    }

    public function update(Request $request)
    {

       $res = $this->startConditions()->where('id', $request->product['id'])->update(
       [
           'title' => $request->product['title'],
           'alias' => $request->product['alias'],
           'category_id' => $request->product['category_id'],
           'brand_id' => $request->product['brand_id'],
           'price' => $request->product['price'],
           'old_price' => $request->product['old_price'],
           'status' => $request->product['status'],
           'keywords' => $request->product['keywords'],
           'description' => $request->product['description'],
       ]
       );
       return response()->json($res);
    }
}
