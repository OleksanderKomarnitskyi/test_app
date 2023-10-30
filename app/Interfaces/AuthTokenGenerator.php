<?php

namespace App\Interfaces;

use Illuminate\Http\Client\Response as ClientResponse;

interface AuthTokenGenerator
{
    /**
     * @param array $data
     * @param string $type
     * @return ClientResponse
     */
    public function generateTokens(array $data, string $type): ClientResponse;
}
