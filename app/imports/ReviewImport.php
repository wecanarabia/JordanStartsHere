<?php

namespace App\Imports;

use App\Models\Review;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ReviewImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $row)
    {

        return new Review([
            "content" => $row['content'],
            "points" => $row['points'],
            "user_id" => $row['user_id'],
            "partner_id" => $row['partner_id'],
            "status" => $row['status'],
        ]);

    }
}
