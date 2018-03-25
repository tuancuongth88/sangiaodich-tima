<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSearchCollection extends JsonResource {
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'          => $this->id,
            'name'        => $this->fullname,
            'description' => $this->email,
        ];
    }
}
