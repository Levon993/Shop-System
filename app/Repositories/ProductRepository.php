<?php
namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Repositories\ResourceInterface;
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
        $products = $this->startConditions()::with('category')->get();
        return products;
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:25|string',
            'alias' => 'required|min:3|max:25|string',
            'category_id' => 'required|int',
            'keywords' => 'nullable|string|min:3|max:12',
            'description' => 'nullable|string',
            'hit' => 'nullable|string',
        ]);
        $file = $request->file('img');

        if (!$request->hasFile('img')) {
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
        $newProduct->title = $request->title;
        $newProduct->alias = $request->alias;
        $newProduct->price = $request->price;
        $newProduct->status = $request->status;
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
