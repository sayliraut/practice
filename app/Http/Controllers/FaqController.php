<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::all();
        return view('Faq.list', compact('faqs'));
    }

    public function create(){
        return view('Faq.create');
    }

    public function store(Request $request){
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return response()->json(['status' => 200]);
    }   
}
