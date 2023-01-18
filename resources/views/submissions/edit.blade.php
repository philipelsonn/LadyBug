@extends('layout.layout')

@section('title', 'LadyBug | Edit Submission')

@section('content')
    <div class="container mt-5">
        <div class="card bg-light p-4 mt-3">
            <h2 class="fw-bold text-center mt-2">Create Submission</h2>
            <form action="{{route('submissions.update', $submission->id)}}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                @method('UPDATE')
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <label for="type" class="col-md-4 col-form-label text-sm-left fw-bold">
                            {{_('Submission Type')}}</label>
                        <select name="type" class="form-select @error('type')
                            is-invalid
                        @enderror" required>
                            <option value="Select" selected disabled>Select Submission Type</option>
                            <option value="Feedback" @if ($submission->type == 'Feedback')
                                selected
                            @endif>Feedback</option>
                            <option value="Bug/Error" @if ($submission->type == 'Bug/Error')
                                selected
                            @endif>Bug/Error</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="type" class="col-md-4 col-form-label text-sm-left fw-bold">
                            {{_('Submission Topic')}}</label>
                        <select name="topic" class="form-select @error('topic')
                            is-invalid
                        @enderror" required>
                            <option value="Select" selected disabled>Select Submission Topic</option>
                            @foreach ($topics as $topic)
                                <option value="{{ $topic->title }}" @if ($submission->topic == $topic->title)
                                    selected
                                @endif>{{ $topic->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-10 form-floating mx-auto mt-3">
                    <input type="text" id="title" name="title" class="form-control @error('title')
                        is-invalid
                    @enderror" placeholder="Submission Title" value="{{ $submission->title }}" required>
                    <label for="title">Submission Title</label>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-10 form-floating mx-auto mt-3">
                    <textarea rows="3" type="text" id="description" name="description" class="form-control @error('description')
                        is-invalid
                    @enderror" placeholder="Description" required>{{ $submission->description }}</textarea>
                    <label for="description">Description</label>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-10 mx-auto mt-3">
                    <input type="file" id="image_new" name="image_new" class="form-control @error('image_new')
                        is-invalid
                    @enderror">
                    @error('image_new')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center mt-3">
                    @method('PUT')
                    <button type="submit" class="btn rounded-20 bg-warning fw-bold">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
