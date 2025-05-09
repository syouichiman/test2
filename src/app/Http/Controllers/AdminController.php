<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    // 表示用
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                  ->orWhere('last_name', 'like', '%' . $keyword . '%')
                  ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $contacts = $query->with('category')->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    // CSV出力用
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                  ->orWhere('last_name', 'like', '%' . $keyword . '%')
                  ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $contacts = $query->with('category')->get();

        $csvHeader = [
            'ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種類', 'お問い合わせ内容', '登録日時'
        ];

        $response = new StreamedResponse(function () use ($contacts, $csvHeader) {
            $stream = fopen('php://output', 'w');
            fputcsv($stream, $csvHeader);

            foreach ($contacts as $contact) {
                fputcsv($stream, [
                    $contact->id,
                    $contact->last_name,
                    $contact->first_name,
                    $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '未分類',
                    $contact->content,
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($stream);
        });

        $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

        return $response;
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', 'データを削除しました');
    }
}