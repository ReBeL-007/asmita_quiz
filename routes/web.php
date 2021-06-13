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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/about', function () {
//     return view('aboutus');
// });
// Route::get('/courses', function () {
//     return view('courses');
// });
// Route::get('/pricing', function () {
//     return view('pricing');
// });
// Route::get('/contact', function () {
//     return view('contact');
// });
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'QuizController@index')->name('quiz_index');
Route::get('/mycourses', 'HomeController@courses')->name('courses');
Route::get('/notification', 'HomeController@get_notifications')->name('get_notifications');
Route::get('/notification/show/{id}', 'HomeController@show_notifications')->name('show_notifications');
Route::get('/notification/readall', 'HomeController@read_all_notifications')->name('read_all_notifications');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/contact_us', 'HomeController@contactUs')->name('contact_us');
Route::get('/courseDetail/{course}','HomeController@courseDetail')->name('course_detail');
Route::get('/lesson/{lesson}','HomeController@getLesson')->name('lesson_api');
Route::get('getspecificcourses', 'HomeController@getspecificCourses')->name('getspecificCourses');

Route::get('/test/{quiz}', 'TestController@index')->name('test')->middleware('signed');
Route::get('/quiz/{id}', 'TestController@quizUrl')->name('quizUrl');
Route::get('/attempts', 'TestController@getAttempts')->name('attempts');
Route::get('/attempts/{id}', 'TestController@showAttempts')->name('view_attempts');
Route::post('/test', 'TestController@store')->name('test_store');
Route::post('/test/update', 'TestController@update')->name('test_update');
Route::post('/test/image', 'TestController@saveImageAsTemp')->name('image_save');
Route::post('/test/image/remove', 'TestController@removeImage')->name('image_remove');
Route::post('/test/get/images/', 'TestController@getImageFromTemp')->name('get_image');
Route::get('/response/{id}', 'TestController@quizResponse')->name('response');
Route::get('/quiz/stat/{id}', 'TestController@attemptStat')->name('stat');
Route::get('/gradeSheet', 'TestController@gradeSheet')->name('gradeSheet');


Route::get('/question/{quiz_id}', 'TestController@getQuestions')->name('get_question');
Route::get('/quiz/top/{quiz}', 'HomeController@get_attempt_top')->name('get_top_attempt');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('login');
    Route::get('/', 'Admin\HomeController@index')->name('dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');
    Route::get('/quiz/top/{quiz}', 'Admin\HomeController@get_attempt_top')->name('get_top_attempt');
    Route::get('/notification', 'Admin\HomeController@get_notifications')->name('get_notifications');
    Route::get('/notification/show/{id}', 'Admin\HomeController@show_notifications')->name('show_notifications');
    Route::get('/notification/readall', 'Admin\HomeController@read_all_notifications')->name('read_all_notifications');

     //change password
     Route::get('change-password', 'Admin\ChangePasswordController@create')->name('password.create');
     Route::post('change-password', 'Admin\ChangePasswordController@update')->name('password.update');

     Route::get('users/import', 'Admin\UserImportController@show')->name('users.showImport');
     Route::post('users/import', 'Admin\UserImportController@store')->name('users.importUser');

    //password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');

    // Permissions
    Route::delete('permissions/destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'Admin\PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'Admin\RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'Admin\RolesController');

    // Users
    Route::delete('users/destroy', 'Admin\UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'Admin\UsersController');

    // groups
    Route::delete('groups/destroy', 'Admin\GroupsController@massDestroy')->name('groups.massDestroy');
    Route::resource('groups', 'Admin\GroupsController');

    // Categories
    Route::delete('categories/destroy', 'Admin\CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'Admin\CategoriesController');
    Route::post('categories_restore/{id}', ['uses' => 'Admin\CategoriesController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\CategoriesController@perma_del', 'as' => 'categories.perma_del']);

    // Grades
    Route::delete('grades/destroy', 'Admin\GradesController@massDestroy')->name('grades.massDestroy');
    Route::resource('grades', 'Admin\GradesController');
    Route::post('grades_restore/{id}', ['uses' => 'Admin\GradesController@restore', 'as' => 'grades.restore']);
    Route::delete('grades_perma_del/{id}', ['uses' => 'Admin\GradesController@perma_del', 'as' => 'grades.perma_del']);

    // Courses
    Route::delete('courses_mass_destroy', ['uses' => 'Admin\CoursesController@massDestroy', 'as' => 'courses.mass_destroy']);
    Route::post('courses/media', 'Admin\CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'Admin\CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'Admin\CoursesController');
    Route::post('courses_restore/{id}', ['uses' => 'Admin\CoursesController@restore', 'as' => 'courses.restore']);
    Route::delete('courses_perma_del/{id}', ['uses' => 'Admin\CoursesController@perma_del', 'as' => 'courses.perma_del']);
    Route::get('courses/lessons/{course}', ['uses' => 'Admin\CoursesController@getCourseLesson', 'as' => 'courses.lessons']);

    //lessons
    Route::delete('lessons_mass_destroy', ['uses' => 'Admin\LessonsController@massDestroy', 'as' => 'lessons.mass_destroy']);
    Route::post('lessons/media', 'Admin\LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'Admin\LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'Admin\LessonsController');
    // Route::get('lessons/create','Admin\LessonsController@create')->name('lessons.create');
    Route::post('lessons_restore/{id}', ['uses' => 'Admin\LessonsController@restore', 'as' => 'lessons.restore']);
    Route::delete('lessons_perma_del/{id}', ['uses' => 'Admin\LessonsController@perma_del', 'as' => 'lessons.perma_del']);
    // Route::get('lessons', 'Admin\LessonsController@courseLessons')->name('lessons.courseLessons');

    //media
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');

    //quizzes
    Route::resource('quizzes', 'Admin\QuizzesController');
    Route::delete('quizzes_mass_destroy', ['uses' => 'Admin\QuizzesController@massDestroy', 'as' => 'quizzes.mass_destroy']);
    Route::post('quizzes_restore/{id}', ['uses' => 'Admin\QuizzesController@restore', 'as' => 'quizzes.restore']);
    Route::delete('quizzes_perma_del/{id}', ['uses' => 'Admin\QuizzesController@perma_del', 'as' => 'quizzes.perma_del']);
    Route::get('quizzes/response/{id}', ['uses' => 'Admin\QuizzesController@response', 'as' => 'quizzes.response']);
    Route::post('quizzes/ispublished', ['uses' => 'Admin\QuizzesController@update_publish', 'as' => 'quizzes.updatePublish']);
    Route::post('quizzes/isanswerpublished', ['uses' => 'Admin\QuizzesController@update_answer_publish', 'as' => 'quizzes.updateAnswerPublish']);

    // attempts
    Route::get('quizzes/attempts/view/{id}', 'Admin\QuizzesController@editAttempts')->name('show_attempts');
    Route::post('quizzes/attempts/quiz', 'Admin\QuizzesController@getQuizAttempts')->name('get_quiz_attempts');
    Route::get('quizzes/attempts/quiz/list', 'Admin\QuizzesController@getListAttempt')->name('get_list_quiz_attempts');
    Route::post('quizzes/attempts/answer', 'Admin\QuizzesController@updateAnswer')->name('update_answer');
    Route::post('quizzes/attempts/update', 'Admin\QuizzesController@updateAttempt')->name('update_attempt');

    // assignments
    Route::resource('assignments', 'Admin\AssignmentController');
    Route::post('assignments/media', 'Admin\AssignmentController@storeMedia')->name('assignments.storeMedia');
    Route::get('assignments/pointCriteria', 'Admin\AssignmentController@getPointCriteria')->name('assignments.pointCriteria');

    // Questions
    Route::delete('questions/destroy', 'Admin\QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::resource('questions', 'Admin\QuestionsController');
    Route::post('questions_restore/{id}', ['uses' => 'Admin\QuestionsController@restore', 'as' => 'questions.restore']);
    Route::delete('questions_perma_del/{id}', ['uses' => 'Admin\QuestionsController@perma_del', 'as' => 'questions.perma_del']);
    Route::get('questions/import/questions', 'Admin\QuestionImportController@show')->name('questions.showImport');
    Route::post('questions/import/questions', 'Admin\QuestionImportController@store')->name('questions.importQuestion');

    Route::resource('admitcard', 'AdmitCardController');

    // Responses
    Route::delete('responses/destroy', 'Admin\QuizResponsesController@massDestroy')->name('responses.massDestroy');
    Route::resource('responses', 'Admin\QuizResponsesController');
    Route::post('responses_restore/{id}', ['uses' => 'Admin\QuizResponsesController@restore', 'as' => 'responses.restore']);
    Route::delete('responses_perma_del/{id}', ['uses' => 'Admin\QuizResponsesController@perma_del', 'as' => 'responses.perma_del']);
    Route::get('responses/view/{id}', ['uses' => 'Admin\QuizResponsesController@response', 'as' => 'responses.response']);
    Route::get('responses/view/list/{id}', ['uses' => 'Admin\QuizResponsesController@listResponse', 'as' => 'responses.responseList']);
    Route::get('response/export/{id}', ['uses' => 'Admin\QuizzesController@export', 'as' => 'responses.export']);

    // students
    Route::delete('students/destroy', 'Admin\StudentsController@massDestroy')->name('students.massDestroy');
    Route::resource('students', 'Admin\StudentsController');
    Route::post('students_restore/{id}', ['uses' => 'Admin\StudentsController@restore', 'as' => 'students.restore']);
    Route::delete('students_perma_del/{id}', ['uses' => 'Admin\StudentsController@perma_del', 'as' => 'students.perma_del']);

});
