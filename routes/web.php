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

//Routes for login
Route::get('/','LoginController@index')->name('/');
Route::post('/login-verification','LoginController@loginVerification')->name('login-verification');
Route::get('/logout','LoginController@logout')->name('logout');

// Routes for adding users
Route::get('/user-add','EmployeeController@index')->name('user-add')->middleware('admin','check-checkin');
Route::post('/store-user','EmployeeController@store')->name('store-user')->middleware('admin','check-checkin');
Route::get('/user-show','EmployeeController@show')->name('user-show')->middleware('admin','check-checkin');
Route::get('/user-delete/{id}','EmployeeController@destroy')->name('user-delete')->middleware('admin','check-checkin');
Route::get('/user-change-status/{id}','EmployeeController@changeStatus')->name('user-change-status','check-checkin')->middleware('admin');
Route::get('/user-change-role/{id}','EmployeeController@changeRole')->name('user-change-role')->middleware('admin','check-checkin');
Route::get('/user-edit-information/{id}','EmployeeController@edit')->name('user-edit-information')->middleware('admin','check-checkin');
Route::post('user-update-information/{id}','EmployeeController@update')->name('user-update-information')->middleware('admin','check-checkin');


// Routes for checkin and checkout
Route::get('/checkin-checkout-view','CheckinController@index')->name('checkin-checkout-view')->middleware('check-login');
Route::get('/checkin','CheckinController@checkin')->name('checkin')->middleware('check-login');
Route::post('/checkout','CheckinController@checkout')->name('checkout')->middleware('check-login','check-checkin');


// View Attendances
Route::get('today-attendance','CheckinController@todayAttendance')->name('today-attendance')->middleware('admin','check-checkin');
Route::get('attendance-by-users','CheckinController@attendanceByUsers')->name('attendance-by-users')->middleware('admin','check-checkin');
Route::post('attendance-by-date/{id}','CheckinController@attendanceByDate')->name('attendance-by-date')->middleware('admin','check-checkin');
Route::get('attendance-individual-date','CheckinController@attendanceIndividualDate')->name('attendance-individual-date')->middleware('admin','check-checkin');
Route::post('/attendance-individual-show','CheckinController@attendanceIndividualShow')->name('attendance-individual-show')->middleware('admin','check-checkin');

// Create A Project
Route::get('/create-a-project','ProjectController@index')->name('create-a-project')->middleware('admin','check-checkin');
Route::post('/store-project','ProjectController@store')->name('store-project')->middleware('admin','check-checkin');
Route::get('/view-projects','ProjectController@showAll')->name('view-projects')->middleware('admin','check-checkin');
Route::get('/project-delete/{id}','ProjectController@destroy')->name('project-delete')->middleware('admin','check-checkin');
Route::get('/project-edit/{id}','ProjectController@edit')->name('project-edit')->middleware('admin','check-checkin');
Route::post('/update-project/{id}','ProjectController@update')->name('update-project')->middleware('admin','check-checkin');
Route::get('/manage-project/{id}','ProjectController@show')->name('manage-project')->middleware('admin','check-checkin');
Route::post('/change-project-status/{id}','ProjectController@changeStatus')->name('change-project-status')->middleware('admin','check-checkin');
Route::post('/add-project-members/{id}','ProjectController@addMembers')->name('add-project-members')->middleware('admin','check-checkin');


// Routes For Tasks
Route::get('/tasks-by-projects','TasksController@tasksByProjectView')->name('tasks-by-projects')->middleware('manager','check-checkin');
Route::get('/task-assign/{id}','TasksController@tasksByProject')->name('task-assign')->middleware('manager','check-checkin');
Route::post('/task-store/{id}','TasksController@storeTasks')->name('task-store')->middleware('manager','check-checkin');
Route::get('/get-by-users','TasksController@getByUser')->name('get-by-users')->middleware('manager','check-checkin');
Route::get('/get-task-by-users/{id}','TasksController@getTasksByUser')->name('get-task-by-user')->middleware('manager','check-checkin');
Route::get('/project-get-task','TasksController@getProjects')->name('project-get-task')->middleware('manager','check-checkin');
Route::get('/get-tasks-by-project/{id}','TasksController@getTasksByProject')->name('get-tasks-by-project')->middleware('manager','check-checkin');
Route::get('/change-task-status/{id}','TasksController@changeTaskStatus')->name('change-task-status')->middleware('manager','check-checkin');
Route::get('/change-task-priority/{id}','TasksController@changeTaskPriority')->name('change-task-priority')->middleware('manager','check-checkin');
Route::get('/task-delete/{id}','TasksController@destroy')->name('task-delete')->middleware('manager','check-checkin');
Route::get('extend-task-deadline/{id}','TasksController@extendDeadlineView')->name('extend-task-deadline')->middleware('manager','check-checkin');
Route::post('new-deadline/{id}','TasksController@extendDeadline')->name('new-deadline')->middleware('manager','check-checkin');

// Routes for assigned tasks
Route::get('/get-projects-user','AssignedTasksController@getProject')->name('get-projects-user')->middleware('member','check-checkin');
Route::get('/tasks-by-project/{id}','AssignedTasksController@tasksByProject')->name('tasks-by-project')->middleware('member','check-checkin');
Route::get('/tasks-by-deadline','AssignedTasksController@tasksByDeadline')->name('tasks-by-deadline')->middleware('member','check-checkin');
Route::get('/change-task-status-member/{id}','AssignedTasksController@changeTaskStatus')->name('change-task-status-member')->middleware('member','check-checkin');
Route::get('/task-send-message/{id}','AssignedTasksController@taskMessageView')->name('task-send-message')->middleware('member','check-checkin');
Route::post('/send-task-mail/{id}','AssignedTasksController@sendMail')->name('send-task-mail')->middleware('member','check-checkin');
// Assigned Tasks of project manager below
Route::get('/manager-tasks-by-deadline','TasksController@tasksByDeadlineView')->name('manager-tasks-by-deadline')->middleware('manager','check-checkin');
Route::get('/change-task-status/{id}','TasksController@changeStatus')->name('change-task-status')->middleware('manager','check-checkin');
Route::get('/task-send-message-manager/{id}','TasksController@sendMessage')->name('task-send-message-manager')->middleware('manager','check-checkin');
Route::post('/send-task-mail-manager/{id}','TasksController@sendMail')->name('send-task-mail-manager')->middleware('manager','check-checkin');
Route::get('/manager-assigned-tasks-project','TasksController@assignedTasksProject')->name('manager-assigned-tasks-project')->middleware('manager','check-checkin');
Route::get('/tasks-by-project-manager/{id}','TasksController@assignedByProject')->name('tasks-by-project-manager')->middleware('manager','check-checkin');
Route::get('check-birthday','EmployeeController@checkBirthday')->name('check-birthday')->middleware('check-checkin','check-login');