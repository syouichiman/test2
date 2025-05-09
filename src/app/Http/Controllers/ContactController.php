<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
        public function index()
        {
            $contacts = Contact::with('category')->paginate(7);
            return view('contacts.index', compact('contacts'));
        }

        public function create()
        {
            $categories = Category::all();
            return view('contacts.create', compact('categories'));
        }

        public function confirm(ContactRequest $request)
        {
            $data = $request->validated();

            if ($request->input('action') === 'back') {
                return redirect()->route('contact.create')->withInput();
            }

            $data['tel'] = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');

            $data['building'] = $request->input('building', '');

            return view('contacts.confirm', compact('data'));
        }

        public function store(Request $request)
        {
            $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');

            $data = $request->only([
                'last_name', 'first_name', 'gender', 'email',
                'address', 'building', 'category_id', 'detail'
            ]);

            $data['tel'] = $tel;

            Contact::create($data);

            return redirect()->route('contact.thanks');
        }

        public function thanks()
        {
            return view('contacts.thanks');
        }

}

