<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('pages', 'PagesController');

    Route::get('/index', 'PagesController@index');

    Route::get('/create', 'PagesController@create');
    Route::post('/index', 'PagesController@store');
// Route::get('/upload', 'PagesController@upload');

//Route::post('emailed-received', )

// UPLOAD/EXPORT DATA
    Route::get('csv_file', 'CsvFile@index');
    Route::get('csv_file/export', 'CsvFile@csv_export')->name('export');
    Route::post('csv_file/import', 'CsvFile@csv_import')->name('import');

// FILTER DATA
    Route::resource('daterange', 'FilterController');

// TASKS/NOTES
    Route::patch('/tasks/{task}', 'TasksController@update');

    Route::post('/taskcreate', 'TasksController@store');

// SEND EMAIL
    Route::post('/email', 'EmailController@store');

    Route::get('mailable', function () {
        $invoice = App\email::find(1);

        return new App\Mail\emailSent($invoice);
    });

// SEND SMS
    Route::view('/bulksms', 'bulksms');
    Route::post('/bulksms', 'BulkSmsController@sendSms');

// CALL FUNCTIONS
    Route::get('/call', 'CallController@index')->name('call');

    Route::get('/answer', 'CallController@newCall');

    Route::post('/token', 'CallController@newToken');

//CALL NOTES

    Route::post('/call', 'CallController@Store');

// PLAYBOOKS

    Route::resource('playbook', 'PlaybookController');

// Reporting

    Route::get('reporting', 'ReportingController@index');
    Route::post('reporting', 'ReportingController@show');

});

Route::get('/test', function () {
    $x = App\lead::find(252)->currentPlaybookStep();
    dd($x);

    // $leadsWithPlaybooks = App\lead::with('playbook')->get();

    // $leadIds = [];
    // foreach ($leadsWithPlaybooks as $lead) {
    //     if ($lead->currentPlaybookStep() == 'social') {
    //         $leadIds[] = $lead->id;
    //     }
    // }
    // dd($leadIds);
    // //$leadsWithPlaybooksWithCurretStepCall

    $playbookSteps = App\PlaybookStep::where('type', 'email')->get();

    //dd($playbookSteps);

    $x = App\lead::where(function ($q) use ($playbookSteps) {
        foreach ($playbookSteps as $i => $playbookStep) {
            $q->orWhere('schedule', $playbookStep->playbook_id)->where('current_step', $playbookStep->step);
        }
    })->pluck('id');

    dd($x);

    $playbooks = App\playbook::get();
    dd($playbooks[1]->steps);
});
