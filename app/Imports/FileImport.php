<?php

namespace App\Imports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileImport implements ToModel, WithHeadingRow
{
    /**
     * Transform each row into a model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new File([
            'status' => $row['status'],
            'file_type' => $row['file_type'],
            'file_no' => $row['file_no'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'tort' => $row['tort'],
            'date_of_loss' => \Carbon\Carbon::parse($row['date_of_loss']),
            'opened' => $row['opened'],
            'claim_no' => $row['claim_no'],
            'policy_no' => $row['policy_no'],
            'client_address' => $row['client_address'],
            'client_phone_no' => $row['client_phone_no'],
            'date_of_birth' => \Carbon\Carbon::parse($row['date_of_birth']),
            'drivers_license' => $row['drivers_license'],
            'ins_company' => $row['ins_company'],
            'ins_address' => $row['ins_address'],
            'adj_name' => $row['adj_name'],
            'adj_phone_no' => $row['adj_phone_no'],
            'adj_fax_no' => $row['adj_fax_no'],
            'family_doctor' => $row['family_doctor'],
            'doctor_address' => $row['doctor_address'],
            'doctor_phone_no' => $row['doctor_phone_no'],
            'doc_fax_no' => $row['doc_fax_no'],
            'rehab' => $row['rehab'],
            'rehab_phone_no' => $row['rehab_phone_no'],
            'rehab_fax_no' => $row['rehab_fax_no'],
            'assessment_center' => $row['assessment_center'],
            'assessment_fax_no' => $row['assessment_fax_no'],
            'ohip_no' => $row['ohip_no'],
            'sin_no' => $row['sin_no'],
            'file_city' => $row['file_city'],
        ]);
    }
}
