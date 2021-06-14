<?php


namespace App\Http\Controllers;
use App\Models\Discount;
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
    public  function recomended(Request $request)
    {
        $result =  $this->productRepository->recomended($request);
        return $result;
    }
    public function hits(Request $request)
    {
        $result =  $this->productRepository->hits($request);
        return $result;
    }
    public function getById(Request $request)
    {
        $result =  $this->productRepository->getById($request->id);
        return response()->json($result);
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
    public function getDiscounts()
    {
        $res =  $result =  $this->productRepository->getDiscounts();
        return  response()->json($res);
    }
    public function getDiscountsForUsers()
    {
        $res =  $result =  $this->productRepository->getDiscountsForUsers();
        return  response()->json($res);
    }
    public function getChoicesForUser()
    {
        $res =  $result =  $this->productRepository->getChoicesForUser();
        return  response()->json($res);
    }
    public function addToDiscount(Request $request)
    {
        $result =  $this->productRepository->addToDiscount($request);
        return $result;
    }
    public function update(Request $request)
    {
        $result =  $this->productRepository->update($request);
        return $result;
    }
}
