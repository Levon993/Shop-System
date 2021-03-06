<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BrandRepository;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandRepository $b)
    {
        $this->brandRepository = $b;
    }

    public function index(Request $request)
    {
        $data = $this->brandRepository->index($request);
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $res = $this->brandRepository->create($request);
        return response()->json($res);
    }
    public function destroy(Request $request)
    {
        $res = $this->brandRepository->destroy($request);
        return response()->json($res);

    }

}
