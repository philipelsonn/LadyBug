@extends('layout.layout')

@section('title', 'LadyBug | Create Submission')

@section('content')
    <h2 class="fw-bold text-center mt-4">Create Submission</h2>
    <div class="container mt-4">
        <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <label for="type" class="col-md-4 col-form-label text-sm-left fw-bold">
                        {{_('Submission Type')}}</label>
                    <select name="type" class="form-select @error('type')
                        is-invalid
                    @enderror" required>
                        <option value="Select" selected disabled>Select Submission Type</option>
                        <option value="Feedback" @if (old('type') == 'Feedback')
                            selected
                        @endif>Feedback</option>
                        <option value="Bug/Error" @if (old('type') == 'Bug/Error')
                            selected
                        @endif>Bug/Error</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="type" class="col-md-4 col-form-label text-sm-left fw-bold">
                        {{_('Submission Topic')}}</label>
                    <select name="topic" class="form-select @error('topic')
                        is-invalid
                    @enderror" required>
                        <option value="Select" selected disabled>Select Submission Topic</option>
                        @foreach ($topics as $topic)
                            <option value="{{ $topic->title }}" @if (old('topic') == $topic->title)
                                selected
                            @endif>{{ $topic->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8 form-floating mx-auto mt-3">
                <input type="text" id="title" name="title" class="form-control @error('title')
                    is-invalid
                @enderror" placeholder="Submission Title" value="{{ old('title') }}" required>
                <label for="title">Submission Title</label>
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-8 form-floating mx-auto mt-3">
                <textarea rows="3" type="text" id="description" name="description" class="form-control @error('description')
                    is-invalid
                @enderror" placeholder="Description" required>{{ old('description') }}</textarea>
                <label for="description">Description</label>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-8 mx-auto mt-3">
                <input type="file" id="image" name="image" class="form-control @error('image')
                    is-invalid
                @enderror">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn rounded-20 bg-warning fw-bold">Create</button>
            </div>
        </form>
    </div>
@endsection
