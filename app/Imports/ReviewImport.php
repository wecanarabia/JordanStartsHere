<?php

namespace App\Imports;


use App\Models\Review;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class ReviewImport implements ToModel,WithHeadingRow,WithValidation{


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

    
    public function rules(): array
    {
        return [
            'content'=>'required|min:0|max:10000',
            'points'=>'required|numeric|min:0|max:5',
            'user_id'=>'required|exists:users,id',
            'partner_id'=>'required|exists:partners,id',
            'status'=>'required|in:0,1',
        ];
    }
}
