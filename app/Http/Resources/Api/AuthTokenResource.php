<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'access_token' => $this->resource['token'],
            'token_tipe' => 'Bearer',
            'user' => [
                'id' => $this->resource['user']->id,
                'email' => $this->resource['user']->email,
                'phone' => $this->resource['user']->phone,
                'first_name' => $this->resource['user']->first_name,
            ],
        ];

    }
}
