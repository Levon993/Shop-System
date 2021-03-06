<?php

namespace App\Repositories;
use Illuminate\Http\Request;



interface ResourceInterface
{
    public function index(Request $request);
    public function create(Request $request);


    public function destroy(Request $request);

    public function update(Request $request);


}
