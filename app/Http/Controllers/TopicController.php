<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return view('topics.index',[
            'topics' => Topic::all()
        ]);
    }

    public function create()
    {
        return view('topics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        Topic::create([
            "title" => $request->title,
        ]);

        return redirect()->route("topics.index");
    }

    // public function edit(Topic $topic)
    // {
    //     return view('topics.edit', [
    //         'topic'=>$topic,
    //     ]);
    // }

    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'title'=>'required|string',
        ]);

        $topic->update([
            'title'=>$request->title,
        ]);

        return redirect()->route('topics.index');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route("topics.index");
    }
}
