<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function index()
    {
        $type = "STAFF";

        return view('submissions.index', [
            'submissions' => Submission::all(),
            'staffs' => User::where('type', $type)->get(),
        ]);
    }

    public function create()
    {
        return view('submissions.create', [
            'topics' => Topic::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'topic' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|required|mimes:jpg,png,jpeg',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = auth()->user()->id . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images/submissions', $file_name);
        }

        Submission::create([
            'type' => $request->type,
            'topic' => $request->topic,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $file_name,
            'submitted_by' => auth()->user()->id,
        ]);

        return redirect()->route('submissions.index');
    }

    public function edit($id)
    {
        return view('submissions.edit', [
            'submission' => Submission::where('id', $id)->get()->first(),
            'topics' => Topic::all()
        ]);
    }

    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'type' => 'required|string',
            'topic' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'image_new' => 'image|nullable|mimes:jpg,png,jpeg',
        ]);

        if ($request->hasFile('image_new')) {
            $extension = $request->file('image_new')->getClientOriginalExtension();
            $file_name = auth()->user()->id . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images/submissions', $file_name);
        } else {
            $file_name = request('image_old');
        }

        $submission->update([
            'type' => $request->type,
            'topic' => $request->topic,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $file_name,
        ]);

        return redirect()->route('submissions.index');
    }

    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect()->route('submissions.index');
    }
}
