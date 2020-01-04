<?php

namespace App\Imports;

use App\lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // request()->validate([
        //     'name' => ['required', 'min:3'],
        //     'surname' => ['required', 'min:3'],
        //     'email' => ['required'],

        // ]);

        return new lead([
            'name' => $row["name"],
            'surname' => $row["surname"],
            'email' => $row["email"],
            'phoneNumber' => $row["phonenumber"],
            'country' => $row["country"],
            'schedule' => request()->schedule,
            'created_date' => now(),
            'current_step' => "1",
            'due_date' => request()->due_date,

        ]);

    }
}
