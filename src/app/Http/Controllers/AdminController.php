<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Contact;

    class AdminController extends Controller
{
    public function index()
    {
        $contact = Contact::paginate(7);
        return view('admin', ['contacts' => $contact]);
    }
}
