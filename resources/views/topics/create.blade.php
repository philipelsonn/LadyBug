@extends('layout.layout')

@section('title', 'LadyBug | Create Topic')

@section('content')
<div class="container mt-5 py-5">
    <div class=" card card-shadow border-0 rounded-20 ">
        <div class="card-body my-3">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3">Topics</h5>
            <h3 class="fw-bold my-3 c-text-1">Create New Topic</h3>
            <hr>
            <form method="POST" action="{{route('topics.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="title" class="col-sm-3 col-form-label text-sm-left">
                                Title</label>
                            <div class="col-sm-9">
                                <input type="text" id="title" name="title" class="form-control rounded-pill" required>
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