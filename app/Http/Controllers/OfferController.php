<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OfferRepository;


class OfferController extends Controller
{
    protected $offerRepository;

    public function __construct(OfferRepository $o)
    {
        $this->offerRepository =$o;
    }

    public function index(Request $request)
    {
        $data = $this->offerRepository->index($request);
        return response()->json($data);
    }
    public function create(Request $request)
    {

        $data = $this->offerRepository->create($request);
        return response()->json($data);
    }

}
