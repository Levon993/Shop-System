<?php


namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Repositories\ResourceInterface;
use App\Models\Offer as Model;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class OfferRepository extends CoreRepository implements ResourceInterface
{

    public function index(Request $request)
    {
        $offers = $this->startConditions()->with('products')->get();
        return $offers;
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|min:3|max:100|string',
                'products_id' => 'required',
                'description' => 'nullable|string',
            ]);
            $file = $request->file('image');

            if (!$request->hasFile('image')) {
                return response()->json(['image not found']);
            }

            if (!$file->isValid()) {
                return response()->json(['invalid file upload']);
            }
            $products = [];
            $segments = explode(',', $request->products_id);
            foreach ($segments as $item) {
                $products[] += intval($item);
            }
            $path = public_path() . '/storage/images';
            $file->move($path, $file->getClientOriginalName());
            $storagePhat = Storage::url('app/public/images/' . $file->getClientOriginalName());
            $newOffer = $this->startConditions();
            $newOffer->title = $request->title;
            $newOffer->description = $request->description;
            $newOffer->img = $file->getClientOriginalName() ? $file->getClientOriginalName() : 'empty';
            $newOffer->save();
            $newOffer->products()->attach($products);
            return response()->json(['message'=>"Предложение Успешно Сохранено"]);
        }catch (Exception $e)
        {
            return response()->json(['message'=>"Произошла Ошибка"]);
        }



    }

    public function destroy(Request $request)
    {
        // TODO: Implement destroy() method.
    }

    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }

    protected function getModelClass()
    {
        return Model::class;
    }
}
