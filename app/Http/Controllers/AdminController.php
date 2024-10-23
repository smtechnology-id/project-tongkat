<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\ProposalSchedule;
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
}
