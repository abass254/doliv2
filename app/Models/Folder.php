<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //


    protected $fillable = [
        'file',
        'folder_name',
        'primary_folder',
        'folder_status',
        'folder_type'
    ];


    public function parentFolder()
    {
        return $this->belongsTo(Folder::class, 'primary_folder');
    }

    // Relationship to get all child folders (optional, if needed)
    public function childFolders()
    {
        return $this->hasMany(Folder::class, 'primary_folder');
    }


    public static function createFolder($data){
        return self::create($data);
    }

    public static function getAllFolders()
    {
        return self::all();
    }

    public static function updateFolder($id, $data)
    {
        $folder = self::find($id);
        if ($folder) {
            $folder->update($data);
            return $folder;
        }
        return null; // Return null if not found
    }

    public static function deleteFolder($id)
    {
        $folder = self::find($id);
        if ($folder) {
            $folder->delete();
            return true;
        }
        return false; // Return false if not foundolder
    }


}
