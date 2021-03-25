<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PharmacyImageResource;

class PharmacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'logo' => isset($this->logo) ? asset($this->logo) : null,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'fax' => $this->fax,
            'state' => $this->state,
            'city' => $this->city,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'postcode' => $this->postcode,
            'images' => $this->images()->exists() ? PharmacyImageResource::collection($this->images) : null,
        ];
    }
}
