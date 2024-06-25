<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de Vendas
        $totalSales = Order::sum('total_amount');

        // Vendas do Mês Atual
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $monthlySales = Order::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->sum('total_amount');

        // Total de Produtos em Estoque
        $totalProductsInStock = Product::where('stock_quantity', '>', 0)->count();

        // Produtos Fora de Estoque
        $outOfStockProducts = Product::where('stock_quantity', '=', 0)->count();

        // Pedidos Recentes
        $recentOrders = Order::orderBy('created_at', 'desc')->take(3)->get(['id', 'total_amount']);

        // Melhores Vendedores do Mês Atual
        $topSellers = Order::select('user_id', DB::raw('SUM(total_amount) as monthly_sales'))
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->groupBy('user_id')
        ->orderByDesc('monthly_sales')
        ->take(3)
        ->with('user:id,name')
        ->get()
        ->map(function ($order) {
            return [
                'id' => $order->user->id,
                'name' => $order->user->name,
                'monthly_sales' => $order->monthly_sales,
            ];
        });

        // Retornar os dados para o dashboard
        return response()->json([
            'total_sales' => $totalSales,
            'monthly_sales' => $monthlySales,

            'total_products_in_stock' => $totalProductsInStock,
            'out_of_stock_products' => $outOfStockProducts,

            'recent_orders' => $recentOrders,

            'top_sellers' => $topSellers,
        ]);
    }

    // Retorna os dados para o gráfico de vendas
    public function getSalesDataForChart()
    {
        $currentYear = Carbon::now()->year;

        $monthlySalesData = Order::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as month'),
            DB::raw('SUM(total_amount) as total_sales')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->orderBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->get();

            $salesData = array_fill(0, 12, 0);

            foreach ($monthlySalesData as $data) {
                $salesData[$data->month - 1] = $data->total_sales;
            }

            return response()->json($salesData);
        }
    }
