<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->group_name = 'company';
    }

    public function index(Request $request){
        $columns = array_keys(__('db.contact'));
        $data = Contact::filter()->paginate(Helper::PerPage())->withQueryString();
        return view('contact.index', compact('data', 'columns'));
    }

    public function show($id){
        $contact = Contact::find($id);
        if (!$contact){
            abort(404);
        }
        $columns = array_keys(__('db.contact'));

        return view('contact.details', compact('contact', 'columns'));
    }



    public function delete($id){
        try {
            $contact = Contact::find($id);
            if (!$contact){
                abort(404);
            }
            $contact->delete();
            return redirect()->back()->with('success', Helper::DeletedSuccessFully());
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function changeStatus($id){
        $company =  Company::find($id);
        if (!$company){
            abort(404);
        }

        $company->status = !$company->status;
        $company->save();
        return redirect()->back()->with('success', Helper::StatusChangedSuccessFully());
    }


    //for export to pdf and Excel file
    public function export(Request $request){
        if ($request->get('export-type') == "excel"){
            return Excel::download(new \App\Exports\PDF\CompanyExport(), Helper::GenerateFileName('company', ExportFormat::XLSX->value));
        }
        else if($request->get('export-type') == "pdf"){
            return Excel::download(new \App\Exports\PDF\CompanyExport(), Helper::GenerateFileName('company', ExportFormat::PDF->value), \Maatwebsite\Excel\Excel::DOMPDF);
        }
    }
}
