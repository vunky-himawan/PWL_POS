<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    private $year;
    private $month;

    public function __construct()
    {
        $this->year = Carbon::now()->year;
        $this->month = Carbon::now()->month;
    }

    public function index(): Response
    {
        $transactions = $this->getTenLatestTransactions();
        $expense = $this->getTotalExpenses();
        $thisYearTotalTransaction = $this->getThisYearTotalTransaction();
        $revenue = $this->getTotalRevenue();
        $expenses = $this->getTotalMonthlyExpenses();
        $incomes = $this->getTotalMonthlyIncome();
        $popularProducts = $this->getPopularProducts();

        $breadcrumb = (object) [
            'title' => "Selamat Datang",
            "list" => ["Home", "Welcome"]
        ];

        $activeMenu = 'dashboard';

        return response()->view('welcome', [
            'year' => $this->year,
            'month' => Carbon::now()->month($this->month)->format('F'),
            'popularProducts' => $popularProducts,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'revenue' => $revenue,
            'transactions' => $transactions,
            'totalTransaction' => $thisYearTotalTransaction,
            'expense' => $expense,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function getTenLatestTransactions(): Collection
    {
        $transactions = TransaksiModel::with('detail')
            ->orderBy('penjualan_id', 'desc')
            ->take(10)
            ->get();

        $transactions->each(function ($transaction) {
            $totalHarga = $transaction->detail->sum('harga');
            $transaction->total_harga = $totalHarga;
        });

        return $transactions;
    }

    public function getThisYearTotalTransaction(): int
    {
        return TransaksiModel::whereYear('penjualan_tanggal', $this->year)->count();
    }

    public function getTotalExpenses(): int
    {
        $expenses = BarangModel::with([
            'stok' => function ($query) {
                $query->whereYear('stok_tanggal', $this->year);
            }
        ])->get();

        $expense = $expenses->each(function ($expense) {
            $totalHarga = $expense->stok->sum('stok_jumlah') * $expense->harga_beli;
            $expense->total_harga = $totalHarga;
        });

        return $expense->sum('total_harga');
    }

    public function getTotalMonthlyExpenses(): array
    {
        $expenses = BarangModel::with([
            'stok' => function ($query) {
                $query->whereYear('stok_tanggal', $this->year);
            }
        ])->get();

        $monthlyExpenses = [];

        $range = range(1, 12);

        foreach ($range as $month) {
            $monthlyExpenses[$month] = 0;
        }

        $expenses->each(function ($expense) use (&$monthlyExpenses) {
            $expense->stok->each(function ($stok) use (&$monthlyExpenses, $expense) {
                $bulan = (int) date('m', strtotime($stok->stok_tanggal));
                $monthlyExpenses[$bulan] += $stok->stok_jumlah * $expense->harga_beli;
            });
        });

        return $monthlyExpenses;
    }

    public function getPopularProducts(): array
    {
        $popularProducts = [];
        $products = DB::table('t_penjualan')
            ->whereYear('penjualan_tanggal', $this->year)
            ->whereMonth('penjualan_tanggal', $this->month)
            ->join('t_penjualan_detail', 't_penjualan.penjualan_id', '=', 't_penjualan_detail.penjualan_id')
            ->join('m_barang', 't_penjualan_detail.barang_id', '=', 'm_barang.barang_id')
            ->select('m_barang.*', DB::raw('SUM(t_penjualan_detail.jumlah) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('t_penjualan_detail.barang_id')
            ->take(5)
            ->get();


        $products->each(function ($product) use (&$popularProducts) {
            $popularProducts['nama'][] = $product->barang_nama;
            $popularProducts['total'][] = $product->total;
        });

        return $popularProducts;
    }

    public function getTotalMonthlyIncome(): array
    {
        $incomes = TransaksiModel::with(['detail'])
            ->whereYear('penjualan_tanggal', $this->year)
            ->get();


        $montlyIncome = [];

        $range = range(1, 12);

        foreach ($range as $month) {
            $montlyIncome[$month] = 0;
        }

        $incomes->each(function ($income) use (&$montlyIncome) {
            $income->detail->each(function ($detail) use (&$montlyIncome, $income) {
                $bulan = (int) date('m', strtotime($income->penjualan_tanggal));
                $montlyIncome[$bulan] += $detail->harga;
            });
        });

        return $montlyIncome;
    }

    public function getTotalRevenue(): int
    {
        $transactions = TransaksiModel::with(['detail'])
            ->whereYear('penjualan_tanggal', $this->year)
            ->get();


        $transactions->each(function ($transaction) {
            $totalHarga = $transaction->detail->sum('harga');
            $transaction->total_harga = $totalHarga;
        });

        return $transactions->sum('total_harga');
    }
}
