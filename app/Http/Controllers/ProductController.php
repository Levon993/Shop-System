<?php

namespace App\Http\Controllers;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $p)
    {
        $this->productRepository = $p;
    }

    public function index(Request $request)
    {
        $products = $this->productRepository->index($request);
        return response()->json($products);
    }

    public function create(Request $request)
    {
       $result =  $this->productRepository->create($request);
       return response()->json($result);
    }

}
