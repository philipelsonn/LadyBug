@extends('layout.layout')

@section('title', 'LadyBug | Edit Submission')

@section('content')
<style>
  body {
    font-family: "Open Sans", sans-serif;
  }
  
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
  }
  
  .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    background: #fff;
  }
  
  .card-shadow {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  }
  
  .rounded-20 {
    border-radius: 20px;
  }
  
  .title-line {
  border-bottom: 1px solid #ccc;
  width: 100px;
  margin: 0 auto 20px;
  }

  .subheading-text {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .c-text-1 {
    font-size: 20px;
    color: #333;
  }
  
  .fw-bold {
    font-weight: bold;
    font-size: 24px;
  }
  
  .form-select {
  appearance: none;
  border: none;
  background: #fafafa;
  border-radius: 20px;
  font-size: 16px;
  padding: 10px 20px;
  width: 250px;
  }
  
  .form-control {
    border-radius: 20px;
    border: 1px solid #ccc;
    font-size: 16px;
    padding: 20px;
    width: 100%;
  }
  
  .btn-outline-1 {
  border: 0.5px solid #333;
  border-radius: 10px;
  color: #333;
  font-size: 14px;
  padding: 5px 10px;
  text-transform: uppercase;
  transition: all 0.3s ease;
  }
  
  .btn-outline-1:hover {
    background: #333;
    color: #fff;
  }
  
  .form-group {
      display: flex;
      align-items: center;
      padding: 5px;
      margin-bottom: 5px;
      padding-left: 20px;
      padding-bottom: 10px;
  }
  
  .form-group label {
    width: 120px;
    font-weight: bold;
    font-size: 16px;
  }
  
  .form-group .form-select,
  .form-group .form-control {
    flex: 1;
  }
  
  .subheading-text {
    font-size: 18px;
    padding-left: 20px;
  }
  
  .c-text-1 {
    font-size: 20px;
    padding-left: 20px;
  }
  
  textarea.form-control {
    height: 100%;
    width: 200%;
  }
  
  .container {
  background: #f5f5f5;
  }

  .card {
    background: #ffffff;
  }
  
  .c-text-1 {
    color: #1e90ff;
  }

  .form-select {
    border-color: #1e90ff;
  }

  .btn-outline-1 {
    background: #1e90ff;
    color: #fff;
    border-color: #1e90ff;
  }

  .btn-outline-1:hover {
    background: #fff;
    color: #1e90ff;
  }
</style>

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