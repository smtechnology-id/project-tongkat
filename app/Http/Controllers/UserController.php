<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
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
        $proposals = Proposal::where('user_id', Auth::user()->id)->get();
        $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
        $jadwal = ProposalSchedule::where('user_id', Auth::user()->id)->first();
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
}
