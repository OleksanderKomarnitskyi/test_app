<?php

namespace App\Services;

use App\Interfaces\AuthTokenGenerator;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Facades\Http;

class AuthService implements AuthTokenGenerator
{

    /**
     * @param array $data
     * @param string $type
     * @return ClientResponse
     */
    public function generateTokens(array $data, string $type): ClientResponse
    {
        $data = array_merge($data, $this->getClientData(), ['grant_type' => $type, 'scope' => '']);
        $response = Http::asForm()->post(config('app.url').'oauth/token', $data);
        return $response;
    }

    /**
     * @return array
     */
    private function getClientData(): array
    {
        return [
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
        ];
    }

}
