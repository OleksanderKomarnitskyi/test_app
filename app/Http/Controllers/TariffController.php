<?php

namespace App\Http\Controllers;

use App\Http\Resources\TariffResource;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TariffController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $tariffs = Tariff::all();

        return TariffResource::collection($tariffs);

    }


}
