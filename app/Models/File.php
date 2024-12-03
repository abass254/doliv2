<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //


    protected $fillable = [
        'status',
        'file_type',
        'file_no',
        'first_name',
        'last_name',
        'tort',
        'date_of_loss',
        'opened',
        'claim_no',
        'policy_no',
        'client_address',
        'client_phone_no',
        'date_of_birth',
        'drivers_license',
        'ins_company',
        'ins_address',
        'adj_name',
        'adj_phone_no',
        'adj_fax_no',
        'family_doctor',
        'doctor_address',
        'doctor_phone_no',
        'doc_fax_no',
        'rehab',
        'rehab_phone_no',
        'rehab_fax_no',
        'assessment_center',
        'assessment_fax_no',
        'ohip_no',
        'sin_no',
        'file_city',
    ];


    public static function createFile($data){
        return self::create($data);
    }

    public static function getAllFiles()
    {
        return self::all();
    }

    public static function updateFile($id, $data)
    {
        $file = self::find($id);
        if ($file) {
            $file->update($data);
            return $file;
        }
        return null; // Return null if not found
    }

    public static function deleteFile($id)
    {
        $file = self::find($id);
        if ($file) {
            $file->delete();
            return true;
        }
        return false; // Return false if not found
    }

    public static function generateFileNo($file_type)
    {
        $words = explode(' ', $file_type);
        $prefix = strtoupper(substr($words[0], 0, 1)) . (isset($words[1]) ? strtoupper(substr($words[1], 0, 1)) : '');
        
        $lastItem = self::where('file_type', 'LIKE', $file_type)->latest('id')->first();
        $nextNumber = $lastItem ? intval(substr($lastItem->file_no, 4)) + 1 : 1;
        //return $lastItem;

        return $prefix.'/'. str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }





}
