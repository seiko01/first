<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Contact;
    use App\Models\Category;


    class AdminController extends Controller
{
    public function index()
    {
        $contact = Contact::paginate(7);
        return view('admin', ['contacts' => $contact]);
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')
        ->CategorySearch($request->category_id)
        ->GenderSearch($request->gender)
        ->NameSearch($request->name)
        ->DateSearch($request->date)
        ->paginate(7);

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}

