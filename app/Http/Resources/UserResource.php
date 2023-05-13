<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->profile->gender,
            'phone' => $this->profile->phone,
            'address' => $this->profile->address,
            'action' => '<div class="btn-group"><button class="btn btn-success" data-toggle="modal" data-target="#saveUserData" onclick="viewUser('.$this->id.')">View</button>
            <button class="btn btn-info" data-toggle="modal" data-target="#saveUserData" onclick="editUser('.$this->id.')">Edit</button>
            <button class="btn btn-danger" onclick="deleteUser('.$this->id.')">Delete</button>',
            // 'created_at' => $this->created_at,
        ];
    }
}

// <button class="btn btn-secondary" data-toggle="modal" data-target="#addAddress" onclick="addAddress('.$this->id.')">Address</button>
// <button class="btn btn-warning" data-toggle="modal" data-target="#viewAddress" onclick="viewAddress('.$this->id.')"><i class="fas fa-align-left"></i></button></div>