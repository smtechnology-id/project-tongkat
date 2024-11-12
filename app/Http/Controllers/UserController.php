<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\FinalExam;
use App\Models\ExamSchedule;
use Illuminate\Http\Request;
use App\Models\ProposalSchedule;
use App\Models\FinalDocument;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function proposal()
    {
        $proposals = Proposal::where('user_id', Auth::user()->id)->latest()->get();
        $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();

        $jadwal = ProposalSchedule::where('user_id', Auth::user()->id)->latest()->first();
        return view('user.proposal', compact('proposals', 'proposal', 'jadwal'));
    }

    public function proposalPost(Request $request)
    {
        // Cek Jika Sudah Pernah Mengajukan Proposal
        $proposal = Proposal::where('user_id', Auth::user()->id)->where('status', 'pending')->latest()->first();
        if ($proposal) {
            return redirect()->back()->with('error', 'Anda sudah pernah mengajukan proposal');
        }
        $request->validate([
            'judul' => 'required',
            'dosen_pembimbing1' => 'required',
            'dosen_pembimbing2' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
            'catatan_mahasiswa' => 'nullable',
        ]);

        //   user_id
        $user_id = Auth::user()->id;
        $status = 'pending';

        // Updload File Dengan Artisan Storage Link
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/file_proposal', $file_name);
        }

        $proposal = Proposal::create([
            'user_id' => $user_id,
            'status' => $status,
            'file' => $file_name,
            'judul' => $request->judul,
            'pembimbing1' => $request->dosen_pembimbing1,
            'pembimbing2' => $request->dosen_pembimbing2,
            'catatan_mahasiswa' => $request->catatan_mahasiswa,
        ]);

        return redirect()->route('user.proposal')->with('success', 'Proposal berhasil dikirim, Silahkan tunggu konfirmasi dari admin');
    }

    // Final Exam
    public function finalExam()
    {
        $proposal = Proposal::where('user_id', Auth::user()->id)->where('status', 'approved')->latest()->first();
        $jadwal = ProposalSchedule::where('user_id', Auth::user()->id)->first();
        $final_exams = FinalExam::where('user_id', Auth::user()->id)->get();
        $final_exam = FinalExam::where('user_id', Auth::user()->id)->latest()->first();
        $jadwal_exam = ExamSchedule::where('user_id', Auth::user()->id)->first();
        return view('user.final_exam', compact('final_exams', 'proposal', 'jadwal', 'final_exam', 'jadwal_exam'));
    }

    public function examPost(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pembimbing_1' => 'required',
            'pembimbing_2' => 'required',
            'penguji_1' => 'required',
            'penguji_2' => 'required',
            'penguji_3' => 'required',
            'catatan_mahasiswa' => 'nullable',
        ]);

        $status = 'pending';
        $status_kelengkapan_dokumen = 'belum lengkap';
        $user_id = Auth::user()->id;
        // Upload File Dengan Artisan Storage Link
        // if ($request->hasFile('file_1')) {
        //     $file = $request->file('file_1');
        //     $file_name_1 = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/final_exam', $file_name_1);
        // }
        // if ($request->hasFile('file_2')) {
        //     $file = $request->file('file_2');
        //     $file_name_2 = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/final_exam', $file_name_2);
        // }

        // if ($request->hasFile('file_3')) {
        //     $file = $request->file('file_3');
        //     $file_name_3 = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/final_exam', $file_name_3);
        // }
        // if ($request->hasFile('file_4')) {
        //     $file = $request->file('file_4');
        //     $file_name_4 = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/final_exam', $file_name_4);
        // }
        $final_exam = FinalExam::create([
            'user_id' => $user_id,
            'status' => $status,
            'judul' => $request->judul,
            'pembimbing_1' => $request->pembimbing_1,
            'pembimbing_2' => $request->pembimbing_2,
            'penguji_1' => $request->penguji_1,
            'penguji_2' => $request->penguji_2,
            'penguji_3' => $request->penguji_3,
            'status_kelengkapan_dokumen' => $status_kelengkapan_dokumen,
            'catatan_mahasiswa' => $request->catatan_mahasiswa,
        ]);

        return redirect()->back()->with('success', 'Pengajuan Ujian Tugas Akhir berhasil dikirim, Silahkan tunggu konfirmasi dari admin');
    }

    public function uploadFile1(Request $request)
    {
        $request->validate([
            'file_1' => 'required|mimes:pdf|max:10048',
        ]);
    }


    // Final Document
    public function finalDocument()
    {
        $final_documents = FinalDocument::where('user_id', Auth::user()->id)->first();
        $final_exam = FinalExam::where('user_id', Auth::user()->id)->latest()->first();
        return view('user.final-document', compact('final_documents', 'final_exam'));
    }

    // Final Document Store
    public function finalDocumentStore(Request $request)
    {

        $request->validate([
            'file_1' => 'required|image|max:10048',
            'file_2' => 'required|mimes:pdf|max:10048',
            'file_3' => 'required|mimes:pdf|max:10048',
            'file_4' => 'required|mimes:pdf|max:10048',
            'file_5' => 'required|mimes:pdf|max:10048',
            'file_6' => 'required|mimes:pdf|max:10048',
            'file_7' => 'required|mimes:pdf|max:10048',
            'file_8' => 'required|mimes:pdf|max:10048',
            'file_9' => 'required|mimes:pdf|max:10048',
            'file_10' => 'required|mimes:pdf|max:10048',
            'file_11' => 'required|mimes:pdf|max:10048',
            'file_12' => 'required|mimes:pdf|max:10048',
            'file_13' => 'required|mimes:pdf|max:10048',
            'file_14' => 'required|mimes:pdf|max:10048',
        ]);

        $files = [
            'file_1',
            'file_2',
            'file_3',
            'file_4',
            'file_5',
            'file_6',
            'file_7',
            'file_8',
            'file_9',
            'file_10',
            'file_11',
            'file_12',
            'file_13',
            'file_14',
        ];

        $fileData = [];

        $proposal_id = Proposal::where('user_id', Auth::user()->id)->latest()->first()->id;
        $final_exam_id = FinalExam::where('user_id', Auth::user()->id)->latest()->first()->id;
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $uploadedFile = $request->file($file);
                $fileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->storeAs('public/final_document', $fileName);
                $fileData[$file] = $fileName;
            }
        }

        $finalDocument = FinalDocument::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'proposal_id' => $proposal_id,
            'final_exam_id' => $final_exam_id,
        ] + $fileData);

        return redirect()->back()->with('success', 'Dokumen akhir berhasil diunggah. Silakan tunggu konfirmasi dari admin.');
    }

    // Final Document Update
    public function finalDocumentUpdate(Request $request)
    {
        $request->validate([
            'file_1' => 'nullable|image|max:10048',
            'file_2' => 'nullable|mimes:pdf|max:10048',
            'file_3' => 'nullable|mimes:pdf|max:10048',
            'file_4' => 'nullable|mimes:pdf|max:10048',
            'file_5' => 'nullable|mimes:pdf|max:10048',
            'file_6' => 'nullable|mimes:pdf|max:10048',
            'file_7' => 'nullable|mimes:pdf|max:10048',
            'file_8' => 'nullable|mimes:pdf|max:10048',
            'file_9' => 'nullable|mimes:pdf|max:10048',
            'file_10' => 'nullable|mimes:pdf|max:10048',
            'file_11' => 'nullable|mimes:pdf|max:10048',
            'file_12' => 'nullable|mimes:pdf|max:10048',
            'file_13' => 'nullable|mimes:pdf|max:10048',
            'file_14' => 'nullable|mimes:pdf|max:10048',
        ]);

        $finalDocument = FinalDocument::where('user_id', Auth::id())->first();

        if (!$finalDocument) {
            return redirect()->back()->with('error', 'Dokumen akhir tidak ditemukan.');
        }

        $files = [
            'file_1',
            'file_2',
            'file_3',
            'file_4',
            'file_5',
            'file_6',
            'file_7',
            'file_8',
            'file_9',
            'file_10',
            'file_11',
            'file_12',
            'file_13',
            'file_14',
        ];

        $updateData = [];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $uploadedFile = $request->file($file);
                $fileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->storeAs('public/final_document', $fileName);
                $updateData[$file] = $fileName;
            }
        }

        $finalDocument->update($updateData);

        return redirect()->back()->with('success', 'Dokumen akhir berhasil diperbarui. Silakan tunggu konfirmasi dari admin.');
    }
}
