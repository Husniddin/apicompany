<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' =>$this->id,
            'name' => $this->name,
            'ceo' => $this->ceo,
            'address' => $this->address,
            'email' => $this->user->email,
            'website' => $this->website,
            'phone' => $this->phone,
        ];
    }
}
