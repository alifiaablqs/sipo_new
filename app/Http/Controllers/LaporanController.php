<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\Memo;
use App\Models\Undangan;
use App\Models\Risalah;
use App\Models\Role;
use App\Models\Seri;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Http\Controllers\MemoController;

class LaporanController extends Controller
{

    public function filterMemosByDate(Request $request)
    {
        $divisi = Divisi::all();
        $kode = Memo::whereNotNull('kode')
            ->pluck('kode')
            ->unique();
        $memoController = new MemoController();
        $kodeUser = null;
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc') === 'asc' ? 'asc' : 'desc';
        $allowedSortColumns = ['created_at', 'tgl_disahkan', 'tgl_dibuat', 'nomor_memo', 'judul'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        if (Auth::user()->role->nm_role == 'admin') {
            $kodeUser = $memoController->getDivDeptKode(Auth::user());
        }
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal'
        ]);

        $request->session()->put('filter_dates', [
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir
        ]);

        $memos = Memo::where(function ($query) use ($request, $kodeUser) {
            if (!$kodeUser) {
                if ($request->filled('kode') && $request->kode != 'pilih') {
                    $query->where('kode', $request->kode);
                    $kodeUser = $request->kode;
                }
            } else {
                $query->where('kode', $kodeUser);
            }
        })
        ->whereDate('tgl_dibuat', '>=', $request->tgl_awal)
        ->whereDate('tgl_dibuat', '<=', $request->tgl_akhir)
        ->orderBy($sortBy, $sortDirection)
        ->get();

        return view('superadmin.laporan.cetak-laporan-memo', [
            'memos' => $memos,
            'divisi' => $divisi,
            'kode' => $kode,
            'sortDirection' => $sortDirection
        ]);
    }

    public function filterUndanganByDate(Request $request)
    {
        $divisi = Divisi::all();
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal'
        ]);
        $kode = Undangan::whereNotNull('kode')
            ->pluck('kode')
            ->unique();

        $memoController = new MemoController();
        $kodeUser = null;
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc') === 'asc' ? 'asc' : 'desc';
        $allowedSortColumns = ['created_at', 'tgl_disahkan', 'tgl_dibuat', 'nomor_undangan', 'judul'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        if (Auth::user()->role->nm_role == 'admin') {
            $kodeUser = $memoController->getDivDeptKode(Auth::user());
        }
        $request->session()->put('filter_dates', [
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir
        ]);

        $undangans = Undangan::where(function ($query) use ($request, $kodeUser) {
            if (!$kodeUser) {
                if ($request->filled('kode') && $request->kode != 'pilih') {
                    $query->where('kode', $request->kode);
                    $kodeUser = $request->kode;
                }
            } else {
                $query->where('kode', $kodeUser);
            }
        })
        ->whereDate('tgl_dibuat', '>=', $request->tgl_awal)
        ->whereDate('tgl_dibuat', '<=', $request->tgl_akhir)
        ->orderBy($sortBy, $sortDirection)
        ->get();
        return view('superadmin.laporan.cetak-laporan-undangan', [
            'undangans' => $undangans,
            'divisi' => $divisi,
            'kode' => $kode,
            'sortDirection' => $sortDirection
        ]);
    }

    public function filterRisalahByDate(Request $request)
    {
        $divisi = Divisi::all();
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal'
        ]);

        $request->session()->put('filter_dates', [
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir
        ]);
        $kode = Risalah::whereNotNull('kode')
            ->pluck('kode')
            ->unique();

        $memoController = new MemoController();
        $kodeUser = null;
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc') === 'asc' ? 'asc' : 'desc';
        $allowedSortColumns = ['created_at', 'tgl_disahkan', 'tgl_dibuat', 'nomor_risalah', 'judul'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        if (Auth::user()->role->nm_role == 'admin') {
            $kodeUser = $memoController->getDivDeptKode(Auth::user());
        }
        $risalahs = Risalah::where(function ($query) use ($request, $kodeUser) {
            if (!$kodeUser) {
                if ($request->filled('kode') && $request->kode != 'pilih') {
                    $query->where('kode', $request->kode);
                    $kodeUser = $request->kode;
                }
            } else {
                $query->where('kode', $kodeUser);
            }
        })
        ->whereDate('tgl_dibuat', '>=', $request->tgl_awal)
        ->whereDate('tgl_dibuat', '<=', $request->tgl_akhir)
        ->orderBy($sortBy, $sortDirection)
        ->get();

        return view('superadmin.laporan.cetak-laporan-risalah', [
            'risalahs' => $risalahs,
            'divisi' => $divisi,
            'kode' => $kode,
            'sortDirection' => $sortDirection
        ]);
    }

    public function index(Request $request)
    {
        $divisi = Divisi::all();
        $kode = Memo::whereNotNull('kode')
            ->pluck('kode')
            ->filter()
            ->unique()
            ->values();
        $seri = Seri::all();
        $memoController = new MemoController();
        $kodeUser = null;
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc') === 'asc' ? 'asc' : 'desc';
        $allowedSortColumns = ['created_at', 'tgl_disahkan', 'tgl_dibuat', 'nomor_memo', 'judul'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }

        if ($user->role->nm_role == 'admin') {
            $kodeUser = $memoController->getDivDeptKode(Auth::user());
        }

        $memos = Memo::query()
            ->where(function ($query) use ($request, $kodeUser) {
                if (!$kodeUser) {
                    if ($request->filled('kode') && $request->kode != 'pilih') {
                        $query->where('kode', $request->kode);
                        $kodeUser = $request->kode;
                    }
                } else {
                    $query->where('kode', $kodeUser);
                }
            });

        if (session()->has('filter_dates')) {
            $dates = session('filter_dates');
            $memos->whereDate('tgl_dibuat', '>=', $dates['tgl_awal'])
                ->whereDate('tgl_dibuat', '<=', $dates['tgl_akhir']);
        }

        if ($request->filled('divisi_id_divisi')) {
            $memos->where('divisi_id_divisi', $request->divisi_id_divisi);
        }

        if ($request->filled('kode') && $request->kode != 'pilih') {
            $memos->where('kode', $request->kode);
        }

        if ($request->filled('search')) {
            $memos->where('judul', 'like', '%' . $request->search . '%');
        }

        $memos = $memos->orderBy($sortBy, $sortDirection)->get();

        if (request()->route()->getName() === 'cetak-laporan-memo.superadmin' || request()->is('cetak-laporan-memo')) {
            return view('superadmin.laporan.cetak-laporan-memo', [
                'memos' => $memos,
                'divisi' => $divisi,
                'kode' => $kode,
                'sortDirection' => $sortDirection
            ]);
        }
    }


    public function undangan(Request $request)
    {
        $divisi = Divisi::all();
        $kode = Undangan::whereNotNull('kode')
            ->pluck('kode')
            ->filter()
            ->unique()
            ->values();
        $seri = Seri::all();
        $memoController = new MemoController();
        $kodeUser = null;
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc') === 'asc' ? 'asc' : 'desc';
        $allowedSortColumns = ['created_at', 'tgl_disahkan', 'tgl_dibuat', 'nomor_undangan', 'judul'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }

        if ($user->role->nm_role == 'admin') {
            $kodeUser = $memoController->getDivDeptKode(Auth::user());
        }

        $undangans = Undangan::query()
            ->where(function ($query) use ($request, $kodeUser) {
                if (!$kodeUser) {
                    if ($request->filled('kode') && $request->kode != 'pilih') {
                        $query->where('kode', $request->kode);
                        $kodeUser = $request->kode;
                    }
                } else {
                    $query->where('kode', $kodeUser);
                }
            });

        if (session()->has('filter_dates')) {
            $dates = session('filter_dates');
            $undangans->whereDate('tgl_dibuat', '>=', $dates['tgl_awal'])
                ->whereDate('tgl_dibuat', '<=', $dates['tgl_akhir']);
        }

        if ($request->filled('search')) {
            $undangans->where('judul', 'like', '%' . $request->search . '%');
        }

        $undangans = $undangans->orderBy($sortBy, $sortDirection)->get();

        if (request()->route()->getName() === 'cetak-laporan-undangan.superadmin' || request()->is('cetak-laporan-undangan')) {
            return view('superadmin.laporan.cetak-laporan-undangan', [
                'undangans' => $undangans,
                'divisi' => $divisi,
                'kode' => $kode,
                'sortDirection' => $sortDirection
            ]);
        }
    }

    public function risalah(Request $request)
    {
        $divisi = Divisi::all();
        $kode = Risalah::whereNotNull('kode')
            ->pluck('kode')
            ->filter()
            ->unique()
            ->values();
        $seri = Seri::all();
        $memoController = new MemoController();
        $kodeUser = null;
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc') === 'asc' ? 'asc' : 'desc';
        $allowedSortColumns = ['created_at', 'tgl_disahkan', 'tgl_dibuat', 'nomor_risalah', 'judul'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }

        if ($user->role->nm_role == 'admin') {
            $kodeUser = $memoController->getDivDeptKode(Auth::user());
        }

        $risalahs = Risalah::query()
            ->where(function ($query) use ($request, $kodeUser) {
                if (!$kodeUser) {
                    if ($request->filled('kode') && $request->kode != 'pilih') {
                        $query->where('kode', $request->kode);
                        $kodeUser = $request->kode;
                    }
                } else {
                    $query->where('kode', $kodeUser);
                }
            });

        if (session()->has('filter_dates')) {
            $dates = session('filter_dates');
            $risalahs->whereDate('tgl_dibuat', '>=', $dates['tgl_awal'])
                ->whereDate('tgl_dibuat', '<=', $dates['tgl_akhir']);
        }

        if ($request->filled('search')) {
            $risalahs->where('judul', 'like', '%' . $request->search . '%');
        }

        $risalahs = $risalahs->orderBy($sortBy, $sortDirection)->get();

        if (request()->route()->getName() === 'cetak-laporan-risalah.superadmin' || request()->is('cetak-laporan-risalah')) {
            return view('superadmin.laporan.cetak-laporan-risalah', [
                'risalahs' => $risalahs,
                'divisi' => $divisi,
                'kode' => $kode,
                'sortDirection' => $sortDirection
            ]);
        }
    }
}
