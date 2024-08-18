<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'profileImage' => $this->profile_image ? asset('storage/'.$this->profile_image) : url('/images/default.png'),
            'placeOfBirth' => $this->place_of_birth,
            'dateOfBirth' => $this->date_of_birth,
            'gender' => $this->gender,
            'phoneNumber' => $this->phone_number,
            'address' => $this->address,
            'role' => $this->role,
        ];
    }
}
