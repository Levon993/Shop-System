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
        $perPage = 20;

        if($request)
        {
            $perPage = $request->perPage;
        }

        $products = $this->startConditions()::with(['category','brand'])->paginate($perPage);
        return $products;
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:25|string',

            'category_id' => 'required|int',
            'brand_id' => 'required|int',
            'keywords' => 'nullable|string|min:3|max:100',
            'description' => 'nullable|string',
            'hit' => 'nullable|string',
        ]);
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
