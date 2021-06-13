<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithValidation, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'password' => Hash::make(str_replace(' ','',strtolower($row['name']))),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'string',
                'unique:users'
            ],
        ];
    }
}
