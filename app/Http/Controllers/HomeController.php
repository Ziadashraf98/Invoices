<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $count_all = Invoice::count();
      $paid_invoices = Invoice::where('status_value', 1)->count();
      $unpaid_invoices = Invoice::where('status_value', 2)->count();
      $partially_paid_invoices = Invoice::where('status_value', 3)->count();

      #$a = dd(round($paid_invoices / $count_all * 100));
      
      $a = round($paid_invoices / $count_all * 100);
      $b = round($unpaid_invoices / $count_all * 100);
      $c = round($partially_paid_invoices / $count_all * 100);


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#DC143C'],
                    'data' => [$b]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#8FBC8F'],
                    'data' => [$a ]
                   
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#FFA500'],
                    'data' => [$c]
                ],

            ])
            
            ->options([]);


        $chartjs1 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#DC143C', '#8FBC8F','#FFA500'],
                    'data' => [$b, $a , $c]
                ]
            ])
            
            ->options([]);

            return view('index', compact('chartjs','chartjs1'));
    }
}