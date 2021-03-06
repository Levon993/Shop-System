<?php


namespace App\Repositories;
use App\Repositories\CategoryRepository;
use App\Repositories\ResourceInterface;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand as Model;

use Illuminate\Http\Request;

class BrandRepository extends CoreRepository implements ResourceInterface
{

    public function index(Request $request)
    {
        $data = $this->startConditions()->with('product')->get();
        return $data;
    }

    public function create(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3|max:25|string',
            'alias' => 'required|min:3|max:25|string',
            'description' => 'nullable|string',
        ]);
//         dd('sdsdd');
        $file = $request->file('image');

        if (!$request->hasFile('image')) {
            return response()->json(['message'=>'Фото не найдено']);
        }
        if (!$file->isValid()) {
            return response()->json(['message'=>'Не валидное фото']);
        }
        $path = public_path() . '/storage/images';
        $file->move($path, $file->getClientOriginalName());
//        dd(Storage::url('app/public/images/'));
        $storagePhat = Storage::url('app/public/images/' . $file->getClientOriginalName());
        $newBrand = $this->startConditions();
        $newBrand->title = $request->title;
        $newBrand->alias = $request->alias;
        $newBrand->description = $request->description;
        $newBrand->img = $file->getClientOriginalName() ? $file->getClientOriginalName() : 'empty';
        $newBrand->save();
        return response()->json(['Успешно']);
    }

    public function destroy(Request $request)
    {
        $destroy = $this->startConditions()->find($request->id);
        if(!$destroy->product()->exists())
        {
            $destroy->delete();
            return ['message' => 'Бренд успешно удален'];
        }
        else{
            return ['message' => 'Бренд не может быть удален поскольку имеет связанные продукты'];
        }
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
