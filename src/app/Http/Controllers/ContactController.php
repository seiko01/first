<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Contact;
    use App\Models\Category;
    use App\Http\Requests\ContactRequest;



    class ContactController extends Controller
    {
        public function index()
        {
            $categories = Category::all();
            return view('index', ['categories' => $categories]);
        }
        public function confirm(ContactRequest $request)
        {
            $contact = $request->only([
            'last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail'
            ]);

            $contact['name'] = $contact['first_name'] . ' ' . $contact['last_name'];
            $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];


            $contact['gender_label'] = $this->GenderLabel($contact['gender']);

            $category = Category::find($contact['category_id']);

            $contact['category_label'] = $category ? $category->content : '未選択';

            return view('confirm', ['contact' => $contact]);
        }

        public function GenderLabel($gender)
        {
            switch ($gender) {
                case 'male':
                    return '男性';
                case 'female':
                    return '女性';
                case 'other':
                    return 'その他';
            }
        }

        public function store(Request $request)
        {
            $contact = $request->only([
            'last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail'
            ]);

            Contact::create($contact);
            return view('thanks');
        }

        public function destroy(Contact $contact)
        {
            $contact->delete();
            return redirect()->route('admin.index');
        }
    }
