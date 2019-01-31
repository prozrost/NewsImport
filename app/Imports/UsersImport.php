<?php

namespace App\Imports;

use App\Exceptions\ImportException;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws ImportException
     */
    public function model(array $row)
    {
        try {
            return new User([
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'password' => Hash::make($row['email']),
                'gender' => $row['gender'] == 'male' ? 'm' : 'f',
                'country' => $row['country'],
                'is_active' => 1
            ]);
        } catch (\Exception $exception) {
            throw new ImportException($exception->getMessage());
        }

    }
}
