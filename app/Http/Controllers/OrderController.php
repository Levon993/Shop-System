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

    }

    public function create(Request $request)
    {

    }
}
