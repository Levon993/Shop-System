<?php
namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Repositories\ResourceInterface;
use Illuminate\Support\Facades\Storage;
use App\Models\Product as Model;
use Exception;
use Illuminate\Http\Request;
class ProductRepository extends CoreRepository implements ResourceInterface
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function index(Request $request)
    {



        $products = $this->startConditions()::with(['category','brand'])->paginate(5);
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
        $res = $this->startConditions()->with(['category','brand']);
        $category = $request->category;
        $title =  $request->title;
        $brand =  $request->brand;
        $price =  $request->price;

        if ($title)
        {
            $res->where('title','like','%'.$title.'%');
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

    public function destroy(Request $request)
    {
        // TODO: Implement destroy() method.
    }

    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }
}
