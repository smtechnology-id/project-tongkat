<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('registerPost');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth.check:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Proposal
    Route::get('/admin/proposal', [AdminController::class, 'proposal'])->name('admin.proposal');

    // User
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('/admin/user/update', [AdminController::class, 'updateUser'])->name('admin.user.update');

    // Proposal Approve
    Route::post('/admin/proposal/approve', [AdminController::class, 'proposalApprove'])->name('admin.proposal.approve');
    // Proposal Reject
    Route::post('/admin/proposal/reject', [AdminController::class, 'proposalReject'])->name('admin.proposal.reject');

    // Jadwal
    Route::get('/admin/jadwal', [AdminController::class, 'jadwal'])->name('admin.jadwal');

    // Jadwal Seminar Proposal
    Route::get('/admin/jadwal/proposal', [AdminController::class, 'jadwalProposal'])->name('admin.jadwal.proposal');
    Route::post('/admin/jadwal/proposal/store', [AdminController::class, 'jadwalProposalStore'])->name('admin.jadwal.proposal.store');

    // Final Exam
    Route::get('/admin/final_exam', [AdminController::class, 'finalExam'])->name('admin.final_exam');
    Route::post('/admin/final_exam/approve', [AdminController::class, 'finalExamApprove'])->name('admin.final-exam-approve');
    Route::post('/admin/final_exam/reject', [AdminController::class, 'finalExamReject'])->name('admin.final-exam-reject');
    Route::post('/admin/final_exam/updateDosen', [AdminController::class, 'finalExamUpdateDosen'])->name('admin.final-exam.updateDosen');

    // Jadwal Ujian Skripsi
    Route::get('/admin/jadwal/final-exam', [AdminController::class, 'jadwalFinalExam'])->name('admin.jadwal.final-exam');
    Route::post('/admin/jadwal/final-exam/store', [AdminController::class, 'jadwalFinalExamStore'])->name('admin.jadwal.exams.store');
    Route::post('/admin/jadwal/final-exam/update', [AdminController::class, 'jadwalFinalExamUpdate'])->name('admin.jadwal.exams.update');

    // Pengumuman Proposal
    Route::get('/admin/proposal/pengumuman', [AdminController::class, 'proposalPengumuman'])->name('admin.proposal.pengumuman');
    Route::post('/admin/proposal/lulus', [AdminController::class, 'proposalLulus'])->name('admin.proposal.lulus');
    Route::post('/admin/proposal/tidak-lulus', [AdminController::class, 'proposalTidakLulus'])->name('admin.proposal.tidak-lulus');

    // Pengumuman Tugas Akhir
    Route::get('/admin/final_exam/pengumuman', [AdminController::class, 'finalExamPengumuman'])->name('admin.final_exam.pengumuman');
    Route::post('/admin/final_exam/lulus', [AdminController::class, 'finalExamLulus'])->name('admin.final-exam.lulus');
    Route::post('/admin/final_exam/tidak-lulus', [AdminController::class, 'finalExamTidakLulus'])->name('admin.final-exam.tidak-lulus');

    // Final Document
    Route::get('/admin/final_document', [AdminController::class, 'finalDocument'])->name('admin.final_document');
});

Route::group(['middleware' => ['auth.check:user']], function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Proposal
    Route::get('/user/proposal', [UserController::class, 'proposal'])->name('user.proposal');
    Route::post('/user/proposal/post', [UserController::class, 'proposalPost'])->name('user.proposalPost');

    // Final Exam
    Route::get('/user/final_exam', [UserController::class, 'finalExam'])->name('user.final_exam');
    Route::post('/user/final_examPost', [UserController::class, 'examPost'])->name('user.examPost');

    // Final Document
    Route::get('/user/final_document', [UserController::class, 'finalDocument'])->name('user.final_document');
    Route::post('/user/final_document/store', [UserController::class, 'finalDocumentStore'])->name('user.final-document.store');
    Route::post('/user/final_document/update', [UserController::class, 'finalDocumentUpdate'])->name('user.final-document.update');
});
