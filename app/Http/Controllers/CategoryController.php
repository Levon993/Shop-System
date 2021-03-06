<?php

namespace App\Http\Controllers;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepoitory;

    public function __construct(CategoryRepository $C)
    {
        $this->categoryRepoitory = $C;
    }

    public function index(Request $request)
    {

        $data = $this->categoryRepoitory->index($request);
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $this->categoryRepoitory->create($request);
    }
    public function destroy(Request $request)
    {
        $result =  $this->categoryRepoitory->destroy($request);
        return response()->json($result);
    }

}
