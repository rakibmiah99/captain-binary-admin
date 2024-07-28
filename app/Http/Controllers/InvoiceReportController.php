<?php

namespace App\Http\Controllers;

use App\Enums\ExportFormat;
use App\Helper;
use App\Models\Company;
use App\Models\Hotel;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceReportController extends Controller
{
    public function index()
    {
        $columns = array_keys(__('db.report.invoice'));
        $hotels = Hotel::get();
        $companies = Company::get();
//        return Order::latest()->first()->order_monitoring->unique('meal_date')->count();
        $data = Invoice::ReportFilter()->paginate(Helper::PerPage())->withQueryString();
        return view('reports.invoice.index', compact('columns', 'data', 'hotels', 'companies'));
    }

    public function export(Request $request){
        if ($request->get('export-type') == "excel"){
            return Excel::download(new \App\Exports\PDF\ExportInvoiceReport(), Helper::GenerateFileName('invoice_report', ExportFormat::XLSX->value));
        }
        else if($request->get('export-type') == "pdf"){
            return Excel::download(new \App\Exports\PDF\ExportInvoiceReport(), Helper::GenerateFileName('invoice_report', ExportFormat::PDF->value), \Maatwebsite\Excel\Excel::DOMPDF);
        }
    }

    public function show($invoice_id)
    {
        $columns = array_keys(__('db.report.invoice'));
        $invoice = Invoice::find($invoice_id);
        return view('reports.invoice.show', compact('columns', 'invoice'));
    }
}
