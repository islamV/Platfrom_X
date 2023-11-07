<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorAuthController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\FileController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/ContactUs', [HomeController::class, 'contactUs'])->name('contactUs');
Route::post('/ContactUs', [HomeController::class, 'contactUsPost'])->name('contactUs.post');
Route::get('/iamteacher', [HomeController::class, 'iamteacher'])->name('iamteacher');
Route::get('/iamstudent', [HomeController::class, 'iamstudent'])->name('iamstudent');

//---------------------------------Student-----------------------------------//
//--public
Route::prefix('student')->group(function () {
    Route::get('/login', [UserAuthController::class, 'login'])->name('student_login');
    Route::post('/login', [UserAuthController::class, 'loginPost'])->name('student_login.post');
    Route::get('/register', [UserAuthController::class, 'register'])->name('student_register');
    Route::post('/register', [UserAuthController::class, 'registerPost'])->name('student_register.post');
   
});

//--private
Route::prefix('student')->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('student_logout');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('student_dashboard');
    Route::get('/get_profile_image', [UserController::class, 'getProfileImage'])->name('student_get_profile_image');
    Route::prefix('/profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('student_profile');
        Route::get('/edit', [UserController::class, 'profileEdit'])->name('student_profile.edit');
        Route::post('/edit', [UserController::class, 'profileEditPost'])->name('student_profile.edit.post');
        Route::post('/delete', [UserController::class, 'profileDelete'])->name('student_profile.delete');
    });
    Route::prefix('/classrooms')->group(function () {
        Route::post('/join', [UserController::class, 'classroomJoin'])->name('student_classroom.join');
        Route::get('/{slug}/leave', [UserController::class, 'classroomLeave'])->name('student_classroom.leave');
        Route::prefix('/{slug}')->group(function () {
            Route::get('/', [UserController::class, 'classroomShow'])->name('student_classroom.show');
            Route::get('/results', [UserController::class, 'showResults'])->name('student_classroom.showResults');
            Route::get('/results/{exam_id}', [UserController::class, 'viewSubmission'])->name('student_classroom.viewSubmission');
            Route::get('/exam/{exam_id}/verify-image', [UserController::class, 'showVerifyImagePage'])->name('student_classroom.verify-image');
            Route::get('/exam/{exam_id}', [UserController::class, 'takeExam'])->name('student_classroom.take-exam');
            Route::post('/exam/{exam_id}/submit', [UserController::class, 'submitExam'])->name('student_classroom.submit-exam');
            Route::post('/announce', [UserController::class, 'classroomAnnounce'])->name('student_classroom.announce');
            Route::get('/announcement_comments/{id}', [UserController::class, 'classroomAnnouncementcomments'])->name('student_classroom.announcements.comments');
            Route::post('/comment/{id}', [UserController::class, 'classroomComment'])->name('student_classroom.comment');
            Route::get('/get-user/{role}/{id}', [UserController::class, 'getUser'])->name('student_get_user');
            Route::prefix('/students')->group(function () {
                Route::get('/', [UserController::class, 'classroomStudents'])->name('student_classrooms.students');
            });
        });
    });
});


//---------------------------------Instructor-----------------------------------//
//--public
Route::prefix('instructor')->group(function () {
    Route::get('/login', [InstructorAuthController::class, 'login'])->name('instructor_login');
    Route::post('/login', [InstructorAuthController::class, 'loginPost'])->name('instructor_login.post');
    Route::get('/register', [InstructorAuthController::class, 'register'])->name('instructor_register');
    Route::post('/register', [InstructorAuthController::class, 'registerPost'])->name('instructor_register.post');
   
});

//--private
Route::prefix('instructor')->group(function () {
    Route::get('/logout', [InstructorAuthController::class, 'logout'])->name('instructor_logout');
    Route::get('/dashboard', [InstructorController::class, 'classrooms'])->name('instructor_dashboard');
    Route::prefix('/profile')->group(function () {
        Route::get('/', [InstructorController::class, 'profile'])->name('instructor_profile');
        Route::get('/edit', [InstructorController::class, 'profileEdit'])->name('instructor_profile.edit');
        Route::post('/edit', [InstructorController::class, 'profileEditPost'])->name('instructor_profile.edit.post');
        Route::post('/delete', [InstructorController::class, 'profileDelete'])->name('instructor_profile.delete');
    });
    Route::prefix('/classrooms')->group(function () {
        Route::get('/create', [InstructorController::class, 'classroomCreate'])->name('instructor_classrooms.create');
        Route::post('/create', [InstructorController::class, 'classroomCreatePost'])->name('instructor_classrooms.create.post');
        Route::get('/edit/{slug}', [InstructorController::class, 'classroomEdit'])->name('instructor_classrooms.edit');
        Route::post('/edit/{slug}', [InstructorController::class, 'classroomEditPost'])->name('instructor_classrooms.edit.post');
        Route::post('/delete/{slug}', [InstructorController::class, 'classroomDelete'])->name('instructor_classrooms.delete');
        Route::post('/regenerate-code/{slug}', [InstructorController::class, 'classroomCodeRegenerate'])->name('instructor_classrooms.regenerate_code');
        Route::prefix('/{slug}')->group(function () {
            Route::get('/', [InstructorController::class, 'classroomShow'])->name('instructor_classrooms.show');
            Route::post('/announce', [InstructorController::class, 'classroomAnnounce'])->name('instructor_classrooms.announce');
            Route::get('/announcement_comments/{id}', [InstructorController::class, 'classroomAnnouncementcomments'])->name('instructor_classrooms.announcements.comments');
            Route::post('/comment/{id}', [InstructorController::class, 'classroomComment'])->name('instructor_classrooms.comment');
            Route::get('/get-user/{role}/{id}', [InstructorController::class, 'getUser'])->name('instructor_get_user');
            Route::prefix('/students')->group(function () {
                Route::get('/', [InstructorController::class, 'classroomStudents'])->name('instructor_classrooms.students');
                Route::post('/delete', [InstructorController::class, 'classroomStudentsDelete'])->name('instructor_classrooms.students.delete');
                Route::post('/cheat/{student_slug}', [InstructorController::class, 'classroomStudentsCheat'])->name('instructor_classrooms.students.cheat');
                Route::get('/{student_slug}', [InstructorController::class, 'classroomStudentsShow'])->name('instructor_classrooms.students.show');
            });
            Route::prefix('/questions')->group(function () {
                Route::get('/', [InstructorController::class, 'questions'])->name('instructor_questions'); ## The qusetion bank
                Route::get('/create/{type_name}', [InstructorController::class, 'questionsCreate'])->name('instructor_questions.create');
                Route::post('/create', [InstructorController::class, 'questionsCreatePost'])->name('instructor_questions.create.post');
                Route::get('/edit/{question_slug}', [InstructorController::class, 'questionsEdit'])->name('instructor_questions.edit');
                Route::post('/edit/{question_slug}', [InstructorController::class, 'questionsEditPost'])->name('instructor_questions.edit.post');
                Route::get('/delete/{question_slug}', [InstructorController::class, 'questionsDelete'])->name('instructor_questions.delete');
            });
            Route::prefix('/exams')->group(function () {
                Route::get('/', [InstructorController::class, 'classroomExams'])->name('instructor_classrooms.exams');
                Route::get('/create', [InstructorController::class, 'classroomExamsCreate'])->name('instructor_classrooms.exams.create');
                Route::post('/create', [InstructorController::class, 'classroomExamsCreatePost'])->name('instructor_classrooms.exams.create.post');
                Route::get('/publish/{exam_slug}', [InstructorController::class, 'classroomExamsPublish'])->name('instructor_classrooms.exams.publish');
                Route::post('/edit/{exam_slug}', [InstructorController::class, 'classroomExamsEditPost'])->name('instructor_classrooms.exams.edit');
                Route::post('/delete/{exam_slug}', [InstructorController::class, 'classroomExamsDelete'])->name('instructor_classrooms.exams.delete');
                Route::get('/{exam_slug}', [InstructorController::class, 'classroomExamsShow'])->name('instructor_classrooms.exams.show');
                Route::prefix('/{exam_slug}/questions')->group(function () {
                    Route::get('/', [InstructorController::class, 'classroomExamsQuestions'])->name('instructor_classrooms.exams.questions');
                    Route::get('/add', [InstructorController::class, 'classroomExamsQuestionsAdd'])->name('instructor_classrooms.exams.questions.add');
                    Route::post('/add', [InstructorController::class, 'classroomExamsQuestionsAddPost'])->name('instructor_classrooms.exams.questions.add.post');
                    Route::post('/delete', [InstructorController::class, 'classroomExamsQuestionsDelete'])->name('instructor_classrooms.exams.questions.delete');

                });
            });
        });
    });
});
Route::get('/download/{attachment}',function($attachment){
    $filePath = 'attachments/' . $attachment;
    // dd($filePath);
// dd(file_exists($filePath));
    // Check if the file exists
    if (file_exists($filePath)) {
        // Return the file as a download response
        return response()->download($filePath, $attachment);
    } else {
        // Handle the case where the file doesn't exist
        abort(404);
    }
})->name('download');
