<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Folder;
use App\Models\File;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = Folder::all();
       
        
        foreach ($data as $dt) {
            //  DB::table('files')->where('id', $item['id'])->update(['date_of_loss' => $item['date_of_loss']]);
            $fol = Folder::where('meta_name', 'LIKE', '%'.$dt->meta_primary.'%')->first();
            $primary = $fol->id ?? 0;
            $path = str_replace('/mnt/FILE_SERVER/TORONTO OPEN PERSONAL INJURY FILES/', 'external/', $dt->meta_path);
            preg_match('/external\/[^\/]+\/([^\/]+\/[^\/]+)/', $path, $matches);
            $clean_path = $matches[1] ?? "NIL";
            $possible_file = File::where('file_no', 'LIKE', '%'.$clean_path.'%')->first();
            $poble_file = $possible_file->id ?? 0;
            //    $dt->st_metapath


            // $fl = Folder::find($dt->id);
            $dt->folder_name = $dt->meta_name;
            $dt->folder_type = $dt->meta_type == 'f' ? 'folder' : 'file';
            $dt->primary_folder = $primary;
            $dt->folder_path = $path;
            $dt->folder_status = 1;
            $dt->file = $poble_file;
            $dt->save();
        }
    }

}
