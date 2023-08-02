<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rules\Password;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new User([
            "name" => $row['name'],
            "last_name" => $row['last_name'],
            "password" => bcrypt($row['password']),
            "email" => $row['email'],
            "phone" => $row['phone'],
            "profile_image_id" => $row['profile_image_id'],
        ]);
    }
    public function rules(): array
    {
        return [
            'name'=>'required|min:4|max:255',
            'last_name'=>'required|min:4|max:255',
            'email'=>'required|min:5|email|max:255|unique:users,email',
            'password' => "required:min:8",
            'phone' => 'required|min:9|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone',
            'profile_image_id'=>"required|exists:profile_images,id"
        ];
    }
}
