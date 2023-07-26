<?php

namespace App\Imports;


use App\Models\Review;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class ReviewImport implements ToModel,WithHeadingRow{


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
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
