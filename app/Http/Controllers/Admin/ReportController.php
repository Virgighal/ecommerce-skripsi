<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderReportClass;
use App\Http\Controllers\Controller;
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
}
