@extends('layout.layout')

@section('title', 'LadyBug | Create Submission')

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
                            <label for="title" class="col-sm-3 col-form-label text-sm-left">
                                Title</label>
                            <div class="col-sm-9">
                                <input type="text" id="title" name="title" class="form-control" required>
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