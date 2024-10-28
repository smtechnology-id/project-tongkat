<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposal;
use App\Models\FinalExam;
use App\Models\ExamSchedule;
use Illuminate\Http\Request;
use App\Models\ProposalSchedule;
use App\Models\FinalDocument;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // User
    public function user()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil diupdate');
    }

    // Proposal
    public function proposal()
    {
        $pending = Proposal::where('status', 'pending')->get();
        $approved = Proposal::where('status', 'approved')->get();
        $rejected = Proposal::where('status', 'rejected')->get();
        return view('admin.proposal', compact('pending', 'approved', 'rejected'));
    }

    // Approve Proposal
    public function proposalApprove(Request $request)
    {
        $proposal = Proposal::find($request->id);
        $proposal->status = 'approved';
        $proposal->catatan_admin = $request->catatan_admin;
        $proposal->save();
        return redirect()->back()->with('success', 'Proposal berhasil disetujui');
    }

    // Reject Proposal
    public function proposalReject(Request $request)
    {
        $proposal = Proposal::find($request->id);
        $proposal->status = 'rejected';
        $proposal->catatan_admin = $request->catatan_admin;
        $proposal->save();
        return redirect()->back()->with('success', 'Proposal berhasil ditolak');
    }


    // Jadwal
    public function jadwal()
    {
        return view('admin.jadwal');
    }

    // Jadwal Seminar Proposal
    public function jadwalProposal()
    {
        $proposals = Proposal::where('status', 'approved')->get();
        $jadwal = ProposalSchedule::orderBy('created_at', 'desc')->get();
        return view('admin.jadwal-proposal', compact('proposals', 'jadwal'));
    }

    public function jadwalProposalStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'proposal_id' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'dosen1' => 'required',
            'dosen2' => 'required',
            'dosen3' => 'required',
            'keterangan' => 'required',
        ]);

        ProposalSchedule::create([
            'user_id' => $request->user_id,
            'proposal_id' => $request->proposal_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'dosen1' => $request->dosen1,
            'dosen2' => $request->dosen2,
            'dosen3' => $request->dosen3,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Jadwal berhasil dibuat');
    }

    // Final Exam
    public function finalExam()
    {
        $pending = FinalExam::where('status', 'pending')->get();
        $approved = FinalExam::where('status', 'approved')->get();
        $rejected = FinalExam::where('status', 'rejected')->get();
        return view('admin.final-exams', compact('pending', 'approved', 'rejected'));
    }

    // Approve Final Exam
    public function finalExamApprove(Request $request)
    {
        $finalExam = FinalExam::find($request->id);
        $finalExam->status = 'approved';
        $finalExam->catatan_admin = $request->catatan_admin;
        $finalExam->save();
        return redirect()->back()->with('success', 'Ujian Tugas Akhir berhasil disetujui');
    }

    // Reject Final Exam
    public function finalExamReject(Request $request)
    {
        $finalExam = FinalExam::find($request->id);
        $finalExam->status = 'rejected';
        $finalExam->catatan_admin = $request->catatan_admin;
        $finalExam->save();
        return redirect()->back()->with('success', 'Ujian Tugas Akhir berhasil ditolak');
    }

    // Jadwal Ujian Skripsi
    public function jadwalFinalExam()
    {
        $finalExams = FinalExam::where('status', 'approved')->get();
        $jadwal = ExamSchedule::orderBy('created_at', 'desc')->get();
        return view('admin.jadwal-exams', compact('finalExams', 'jadwal'));
    }

    public function jadwalFinalExamStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'final_exam_id' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
        ]);

        ExamSchedule::create([
            'user_id' => $request->user_id,
            'final_exam_id' => $request->final_exam_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Jadwal berhasil dibuat');
    }

    public function proposalPengumuman()
    {
        $proposals = Proposal::where('status', 'approved')->where('status_kelulusan', 'pending')->get();
        $lulus = Proposal::where('status', 'approved')->where('status_kelulusan', 'lulus')->get();
        $tidak_lulus = Proposal::where('status', 'approved')->where('status_kelulusan', 'tidak lulus')->get();
        return view('admin.proposal-pengumuman', compact('proposals', 'lulus', 'tidak_lulus'));
    }

    // Proposal Lulus
    public function proposalLulus(Request $request)
    {

        $proposal = Proposal::find($request->id);
        $proposal->status_kelulusan = 'lulus';
        $proposal->save();
        return redirect()->back()->with('success', 'Proposal berhasil diluluskan');
    }

    // Proposal Tidak Lulus
    public function proposalTidakLulus(Request $request)
    {
        $proposal = Proposal::find($request->id);
        $proposal->status_kelulusan = 'tidak lulus';
        $proposal->status = 'rejected';
        $proposal->save();

        $delete = ProposalSchedule::where('proposal_id', $proposal->id)->delete();
        return redirect()->back()->with('success', 'Proposal berhasil ditidak luluskan');   
    }


    public function finalExamPengumuman()
    {
        $pending = FinalExam::where('status_kelulusan', 'pending')->get();
        $lulus = FinalExam::where('status_kelulusan', 'lulus')->get();
        $tidak_lulus = FinalExam::where('status_kelulusan', 'tidak lulus')->get();
        return view('admin.final-exam-pengumuman', compact('pending', 'lulus', 'tidak_lulus'));
    }

    // Final Exam Lulus
    public function finalExamLulus(Request $request)
    {
        $finalExam = FinalExam::find($request->id);
        $finalExam->status_kelulusan = 'lulus';
        $finalExam->save();
        return redirect()->back()->with('success', 'Ujian Tugas Akhir berhasil diluluskan');
    }

    // Final Exam Tidak Lulus
    public function finalExamTidakLulus(Request $request)
    {
        $finalExam = FinalExam::find($request->id);
        $finalExam->status_kelulusan = 'tidak lulus';
        $finalExam->status = 'rejected';
        $finalExam->save();
        return redirect()->back()->with('success', 'Ujian Tugas Akhir berhasil ditidak luluskan');
    }

    // Final Document   
    public function finalDocument()
    {
        $finalDocuments = FinalDocument::all();
        return view('admin.final-document', compact('finalDocuments'));
    }
}
