<?php

namespace App\Http\Controllers;

use App\Enums\ContactStatus;
use App\Helper;
use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
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
        $contact =  Contact::find($id);
        if (!$contact){
            abort(404);
        }

        $contact->status = $contact->status == ContactStatus::PENDING->value ? ContactStatus::SOLVED->value : ContactStatus::PENDING->value;
        $contact->save();
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
