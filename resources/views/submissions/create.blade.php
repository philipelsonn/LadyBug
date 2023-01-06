@extends('layout.layout')

@section('title', 'LadyBug | Create Submission')

@section('content')
<div class="container mt-5 py-5">
    <div class=" card card-shadow border-0 rounded-20 ">
        <div class="card-body my-3">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3">Submissions</h5>
            <h3 class="fw-bold my-3 c-text-1">Create New Submission</h3>
            <hr>
            <form method="POST" action="{{route('submissions.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="type" class="col-sm-3 col-form-label text-sm-left">
                                Type</label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="form-select rounded-pill"
                                    placeholder="">
                                    <option value="" selected disabled>Choose...
                                    </option>
                                    <option value="FEEDBACK">
                                        Feedback
                                    </option>
                                    <option value="BUG">
                                        Bug/Error/Issue
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="topic" class="col-sm-3 col-form-label text-sm-left">
                                Topic</label>
                            <div class="col-sm-9">
                                <select name="topic" id="topic" class="form-select rounded-pill" 
                                    placeholder="" >
                                    <option value="" selected disabled>Choose...
                                    </option>
                                    @foreach ($topics as $topic)
                                    <option value="{{$topic->title}}">
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
                                <textarea rows="5" type="text" id="description" name="description" class="form-control placeholder="Enter Item Description" required>{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="image" class="col-sm-3 col-form-label text-sm-left">
                                Attach a screenshot</label>
                            <div class="col-md-12">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="d-grid gap-2">
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