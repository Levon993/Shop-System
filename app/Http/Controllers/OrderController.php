<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $OrderRepository;

    public function __construct(OrderRepository $o)
    {
        $this->OrderRepository = $o;
    }

    public function getProductsForBasket(Request $request)
    {
        return $this->OrderRepository->getProductsForBasket($request);

    }

    public function index(Request $request)
    {
        $orders = $this->OrderRepository->index($request);
        return response()->json($orders);
    }
    public function NonRegisterIndex(Request $request)
    {
        $orders = $this->OrderRepository->NonRegisterIndex($request);
        return response()->json($orders);
    }

    public function create(Request $request)
    {
        $orders = $this->OrderRepository->create($request);
        return response()->json($orders);
    }
}
