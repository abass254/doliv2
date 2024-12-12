<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentCommentController;
use App\Http\Controllers\FolderCommentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FinanceController;





Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AccountController::class, 'login'])->name('login');


// Route::get('/files', function () {
//     return view('cases.list');
// });


Route::middleware(['auth'])->group(function () {


    Route::get('/old_server_files', [FolderController::class, 'scan']);

   
    Route::get('/home', [AccountController::class, 'homePage'])->name('home'); 
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
    Route::post('/change-password', [AccountController::class, 'changePassword'])->name('password.update');
    Route::get('/', function () {
        return 'Welcome!!!';
    });



    Route::get('/files/next-file-no', [FileController::class, 'getNextFileNo']);
    Route::post('/file-contacts', [FileController::class, 'saveFileContact'])->name('file-contacts');
    Route::post('/file-finances', [FileController::class, 'saveFileFinance'])->name('file-finances');
    Route::get('/files_station', [FolderController::class, 'getAllFiles']);
    Route::get('/update_folder_details', [FolderController::class, 'updateFolderDetails']);
    Route::get('/files_station/{id}/main', [FolderController::class, 'justTrial']);
    Route::get('/files_station/{id}/folder/{sub_id}', [FolderController::class, 'justTrial'])->name('file_stations.show');

    Route::get('/folder-upload', [TestController::class, 'uploadForm'])->name('folder.upload.form');
    Route::post('/process-folder', [TestController::class, 'processZip'])->name('folder.process');


    Route::post('/uploadFile', [FolderController::class, 'uploadFiles'])->name('upload-files');

    Route::post('/import-file', [FileController::class, 'importExcel']);

    Route::get('/file_documents/{id}', [FolderController::class, 'getFileDocuments']);


    Route::get('/file_documents_data/{id}', [FolderController::class, 'getFileDocumentsData']);
    Route::get('/sub_folders/{id}', [FolderController::class, 'getSubFolders']);


    Route::Resource('files', FileController::class);
    Route::Resource('folders', FolderController::class);
    Route::Resource('system_users', AccountController::class);
    Route::Resource('tasks', TaskController::class);
    Route::Resource('documents', DocumentController::class);
    Route::Resource('doc_comments', DocumentCommentController::class);
    Route::Resource('file_comments', FolderCommentController::class);    
    Route::Resource('payment_transactions', FinanceController::class);


    Route::middleware(['auth', 'role:manager'])->group(function () {
        Route::post('/tasks/approve/{id}', [TaskController::class, 'approveSingle'])->name('tasks.approve.single');
        Route::post('/tasks/approve-bulk', [TaskController::class, 'approveBulk'])->name('tasks.approve.bulk');
    });

    
    Route::get('/uploaded_file/{id}', [FolderController::class, 'viewFileAsPdf'])->name('view_uploaded_file');


    Route::get('/my_tasks_board', [TaskController::class, 'myTasksBoard']);

    Route::get('/all_tasks', [TaskController::class, 'allTasks']);
    Route::get('/pending_tasks', [TaskController::class, 'pendingTasks']);

    Route::post('/upload-folder', [FolderController::class, 'uploadFolder'])->name('upload.folder');

    Route::get('/filerrrr', [TestController::class, 'show'])->name('file.show');

});





