<?php


namespace App\Http\Controllers;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductRepository $p)
    {
        $this->productRepository = $p;
    }
      public function search(Request $request)
      {
          $products = $this->productRepository->search($request);
          return response()->json($products);
      }

    public function index(Request $request)
    {

        $products = $this->productRepository->index($request);
        return response()->json($products);
    }

    public function create(CreateProductRequest $request)
    {
       $result =  $this->productRepository->create($request);
       return response()->json($result);
    }
    public  function getByCategory(Request $request)
    {
        $result =  $this->productRepository->getByCategory($request);
         return $result;
    }
    public function addToChoice(Request $request)
    {
        $result =  $this->productRepository->addToChoice($request);
        return $result;
    }
    public function getChoices()
    {
        $res =  $result =  $this->productRepository->getChoices();
        return  response()->json($res);
    }

    public function getChoicesForUser()
    {
        $res =  $result =  $this->productRepository->getChoicesForUser();
        return  response()->json($res);
    }
    public function update(Request $request)
    {
        $result =  $this->productRepository->update($request);
        return $result;
    }
}
