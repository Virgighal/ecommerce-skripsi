<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderReportClass;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * index
     *
     */
    public function index()
    {
        return view('admin.report.index');
    }

    /**
     * report
     *
     * @param Request $request
     * 
     */
    public function report(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $transactionNumber = $request->transaction_number;
        $productName = $request->product_name;

        if(!empty($startDate)) {
            if(empty($endDate)) {
                return redirect()->back()->with('error_message', 'Please select end date!');
            }
        }

        if(!empty($endDate)) {
            if(empty($startDate)) {
                return redirect()->back()->with('error_message', 'Please select start date!');
            }
        }

        $startDateFormatted = NULL;
        $endDateFormatted = NULL;
        if(!empty($startDate) && !empty($endDate)) {
            $startDateFormatted = Carbon::createFromFormat('Y-m-d', $startDate)->format('Y-m-d 00:00:00');
            $endDateFormatted = Carbon::createFromFormat('Y-m-d', $endDate)->format('Y-m-d 23:59:59');
        }

        $filename = 'LAPORAN_PENJUALAN.xlsx';

        return Excel::download(new OrderReportClass($startDateFormatted, $endDateFormatted, $transactionNumber, $productName), $filename);
    }
    
    /**
     * Print PDF
     *
     * @param Request $request
     * @return view
     */
    public function printPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $transactionNumber = $request->transaction_number;
        $productName = $request->product_name;

        if(!empty($startDate)) {
            if(empty($endDate)) {
                return redirect()->back()->with('error_message', 'Please select end date!');
            }
        }

        if(!empty($endDate)) {
            if(empty($startDate)) {
                return redirect()->back()->with('error_message', 'Please select start date!');
            }
        }

        $products = Product::orderBy('name', 'ASC');
        if(!empty($productName)) {
            $products = $products->where('name', 'LIKE', '%'.$productName.'%');
        }
        $products = $products->get();

        $dataToReturn = [];

        if(!empty($startDate) && !empty($endDate)) {
            $dataToReturn["date"] = [
                'Tanggal '. Carbon::createFromFormat('Y-m-d', $startDate)->translatedFormat('d F Y').' s/d '. Carbon::createFromFormat('Y-m-d', $endDate)->translatedFormat('d F Y')
            ];
        }

        $header = [
            'NO',
            'PRODUK',
            'JUMLAH STOK TERSEDIA',
            'JUMLAH STOK TERJUAL',
            'HARGA PRODUK',
            'TOTAL PENJUALAN'
        ];

        $dataToReturn['header'] = $header;
        
        $contents = [];
        $grandTotal = 0;
        $no = 1;
        foreach($products as $product) {
            $totalSelledStock = OrderItem::where('product_id', $product->id);
            if(!empty($transactionNumber)) {
                $order = Order::where('transaction_number', $transactionNumber)->first();
                if(!empty($order)) {
                    $totalSelledStock = $totalSelledStock->where('order_id', $order->id);
                }
            }

            if(!empty($startDate) && !empty($endDate)) {
                $totalSelledStock = $totalSelledStock->whereBetween('created_at', [
                    $startDate, $endDate
                ]);
            }

            $totalSelledStock = $totalSelledStock->sum('quantity');

            $totalSalesPerProduct = $totalSelledStock * $product->price;

            $grandTotal += $totalSalesPerProduct;

            $contents[] = [
                $no++,
                $product->name,
                $product->stock,
                $totalSelledStock ?? '0',
                'Rp. '.number_format($product->price),
                'Rp. '.number_format($totalSalesPerProduct),
            ];
        }

        $dataToReturn['content'] = $contents;

        $footer_1 = [
            '',
            '',
            '',
            '',
            'GRAND TOTAL',
        ];

        $footer_1[] = 'Rp. '.number_format($grandTotal);
        $dataToReturn['footer_1'] = $footer_1;

        return view('admin.report.print')->with('datas', $dataToReturn);
    }
}
