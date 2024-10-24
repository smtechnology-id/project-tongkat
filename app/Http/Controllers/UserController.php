<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\FinalExam;
use App\Models\ExamSchedule;
use Illuminate\Http\Request;
use App\Models\ProposalSchedule;
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
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file_proposal'), $file_name);
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
            'file_1' => 'required|mimes:pdf|max:10048',
            'file_2' => 'required|mimes:pdf|max:10048',
            'file_3' => 'required|mimes:pdf|max:10048',
            'file_4' => 'required|mimes:pdf|max:10048',
            'pembimbing_1' => 'required',
            'pembimbing_2' => 'required',
            'penguji_1' => 'required',
            'penguji_2' => 'required',
            'penguji_3' => 'required',
        ]);
        // Text Validasi error
        $messages = [
            'file_1.max' => 'File Dokumen Skripsi maksimal 1 MB',
            'file_2.max' => 'File Surat Keterangan Persetujuan Tugas Akhir maksimal 1 MB',
            'file_3.max' => 'File Kartu Kehadiran Ujian Proposal Tugas Akhir maksimal 1 MB',
            'file_4.max' => 'File Logbook Kegiatan Tugas Akhir maksimal 1 MB',
        ];


        $status = 'pending';
        $user_id = Auth::user()->id;

        // Upload File Dengan Artisan Storage Link
        if ($request->hasFile('file_1')) {
            $file = $request->file('file_1');
            $file_name_1 = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/final_exam', $file_name_1);
        }
        if ($request->hasFile('file_2')) {
            $file = $request->file('file_2');
            $file_name_2 = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/final_exam', $file_name_2);
        }

        if ($request->hasFile('file_3')) {
            $file = $request->file('file_3');
            $file_name_3 = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/final_exam', $file_name_3);
        }
        if ($request->hasFile('file_4')) {
            $file = $request->file('file_4');
            $file_name_4 = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/final_exam', $file_name_4);
        }
        $final_exam = FinalExam::create([
            'user_id' => $user_id,
            'status' => $status,
            'judul' => $request->judul,
            'pembimbing_1' => $request->pembimbing_1,
            'pembimbing_2' => $request->pembimbing_2,
            'penguji_1' => $request->penguji_1,
            'penguji_2' => $request->penguji_2,
            'penguji_3' => $request->penguji_3,
            'file_1' => $file_name_1,
            'file_2' => $file_name_2,
            'file_3' => $file_name_3,
            'file_4' => $file_name_4,
        ]);

        return redirect()->back()->with('success', 'Pengajuan Ujian Tugas Akhir berhasil dikirim, Silahkan tunggu konfirmasi dari admin');
    }
}
