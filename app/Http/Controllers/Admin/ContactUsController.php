<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $query = ContactUs::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        $contacts = $query->latest()->paginate(10);

        return view('admin.contact_us.index', compact('contacts', 'search'));
    }

    public function show($id)
    {
        $contactUs = ContactUs::findOrFail($id);
        return view('admin.contact_us.show', compact('contactUs'));
    }

    public function destroy($id)
    {
        $contactUs = ContactUs::findOrFail($id);
        $contactUs->delete();
        return redirect()->route('admin.contact_us.index')->with('success', 'Contact request deleted successfully.');
    }
}
