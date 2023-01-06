@extends('layout.layout')

@section('title', 'LadyBug | Edit Submission')

@section('content')
<div class="container mt-5 py-5">
    <div class=" card card-shadow border-0 rounded-20 ">
        <div class="card-body my-3">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3">Submissions</h5>
            <h3 class="fw-bold my-3 c-text-1">Edit Submission</h3>
            <hr>
            <form method="POST" action="{{route('submissions.update', $submission->id)}}" enctype="multipart/form-data">
                @csrf
                @method('UPDATE')
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="type" class="col-sm-3 col-form-label text-sm-left">
                                Type</label>
                            <div class="col-sm-9">
                                <select name="type" class="form-select rounded-pill" 
                                    placeholder="">
                                    <option value="" selected disabled>Choose...
                                    </option>
                                    <option value="FEEDBACK" @if($submission->type == "FEEDBACK") selected @endif>
                                        Feedback
                                    </option>
                                    <option value="BUG" @if($submission->type == "BUG") selected @endif>
                                        Bug/Error/Issue
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="topic" class="col-sm-3 col-form-label text-sm-left">
                                Topic</label>
                            <div class="col-sm-9">
                                <select name="topic" class="form-select rounded-pill" 
                                    placeholder="">
                                    <option value="" selected disabled>Choose...
                                    </option>
                                    @foreach ($topics as $topic)
                                    <option value="{{$topic->title}}" @if($submission->topic == $topic->title) selected @endif>
                                        {{$topic->title}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="description" class="col-sm-3 col-form-label text-sm-left">
                                Description</label>
                            <div class="col-sm-9">
                                <textarea id="description" name="description" class="form-control" rows="5" required>{{ $submission->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="image" class="col-md-3 col-form-label text-sm-left">
                                Screenshot</label>
                            <img src="/storage/images/submissions/{{ $submission->image }}" alt="" style="height: 70px; width: 100px">
                            <div class="col-md-9">
                                <input class="form-control rounded-pill" type="text" id="image_old"
                                    name="image_old" value="{{ $submission->image }}" hidden>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="image" class="col-md-3 col-form-label text-sm-left">
                                New Screenshot</label>
                            <div class="input-group">
                                <input type="file" name="image_new" class="form-control rounded-20 image-file-input @error('image_new')
                                    is-invalid
                                @enderror" id="image_new" accept="image/png, image/jpeg, image/jpg">
                                @error('image_new')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <div class="d-grid gap-2">
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-1 rounded-20">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection