<?php


namespace App\Repositories;
use App\Repositories\CoreRepository;
use App\Repositories\ResourceInterface;
use App\Http\Requests\CategoryRequest;
use Exception;
use App\Models\Category as Model;
use Illuminate\Http\Request;
class CategoryRepository extends CoreRepository implements ResourceInterface
{

    public function index(Request $request)
    {
        $categories = $this->startConditions()::with(['children','parent'])->get();

        return $categories;
    }

    public function create(Request $request)
    {
        try {


            $request->validate([
                'title' => 'required|min:3|max:25|string',
                'alias' => 'required|min:3|max:25|string',
                'parent_id' => 'nullable|int',
                'keywords' => 'nullable|string|min:3|max:100',
                'description' => 'nullable|string',
            ]);

            $NewCategory = $this->startConditions();
            $NewCategory->title = $request->title;
            $NewCategory->alias = $request->alias;
            $NewCategory->parent_id = $request->parent_id ? $request->parent_id : null;
            $NewCategory->Keywords = $request->Keywords ? $request->Keywords : null;
            $NewCategory->description = $request->description ? $request->description : null;
            $NewCategory->save();
            return ['message' => "Category Successfully Created"];
        }catch (Exception $e)
        {
            return ['message' => "Something went wrong"];
        }
    }

    public function destroy(Request $request)
    {
//        dd($request->all());
        $destroy = $this->startConditions()->find($request->id);
        if(!$destroy->children()->exists())
        {
            $destroy->delete();
            return ['message' => 'Категория Успешно удалена'];
        }
        else{
            return ['message' => 'Категория имеет дочерние категории (не можнт быть удалена)'];
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
