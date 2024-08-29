<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\ContactStatus;
use App\Helper;
use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function index(Request $request){
        $data = Contact::filter()->paginate(Helper::PerPage())->withQueryString();
        return Helper::SendReponse($data, 'Fetch Successfully');
    }

    public function show($id){
        $contact = Contact::find($id);
        if (!$contact){
            abort(404);
        }
        return Helper::SendReponse($contact, 'Fetch Successfully');
    }



    public function delete($id){
        $contact = Contact::find($id);
        if (!$contact){
            abort(404);
        }
        $contact->delete();
        return Helper::SendReponse($contact, 'Delete Successfully');
    }

    public function changeStatus($id){
        $contact =  Contact::find($id);
        if (!$contact){
            abort(404);
        }

        $contact->status = $contact->status == ContactStatus::PENDING->value ? ContactStatus::SOLVED->value : ContactStatus::PENDING->value;
        $contact->save();
        return Helper::SendReponse($contact, 'Change Status Successfully');
    }

}
