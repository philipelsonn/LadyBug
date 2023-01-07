@extends('layout.layout')

@section('title', 'LadyBug | Manage Submissions')

@section('content')
<div class="container mt-5 py-5">
    <div class=" card card-shadow border-0 rounded-20 ">
        <div class="card-body my-3">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3">Submissions</h5>
            <h3 class="fw-bold my-3 c-text-1">Submission List</h3>
            <a class="btn btn-md my-2 rounded-20 btn-outline-1" href="{{ route('submissions.create') }}">Add</a>  
            <hr>
            <div class="table-responsive py-3">
                <table class="table table-bordered table-sm table-striped no-footer">
                    <thead class="thead-light">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Type</th>
                    <th class="align-middle text-center">Topic</th>
                    <th class="align-middle text-center">Description</th>
                    <th class="align-middle text-center">Submitted by</th>
                    <th scope="col" class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($submissions as $submission)
                        <tr>
                            <td class="align-middle text-center">{{ $submission->id }}</td>
                            <td class="align-middle text-center">{{ $submission->type }}</td>
                            <td class="align-middle text-center">{{ $submission->topic }}</td>
                            <td class="align-middle text-center">{{ $submission->description }}</td>
                            <td class="align-middle text-center">{{ $submission->user->name}}</td>
                            <td class="align-middle text-center d-flex justify-content-center">
                                <a class="btn btn-sm btn-block btn-info text-white"
                                    target="_blank" href="/storage/images/submissions/{{ $submission->image }}"
                                    style="margin-inline: 0.4vw">Screenshot</a>
                                <button type="button" class="btn btn-sm btn-block btn-primary text-white" style="margin-inline: 0.4vw"
                                data-bs-toggle="modal" data-bs-target="#assign{{$submission->id}}">
                                    Assign
                                </button>
                                <a class="btn btn-sm btn-block btn-warning text-white"
                                    href="{{ route('submissions.edit', $submission->id) }}"
                                    style="margin-inline: 0.4vw">Edit</a>
                                <form method="POST" action="{{ route('submissions.destroy', $submission->id) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value='DELETE'>
                                    <button type="submit" class="btn btn-sm btn-block btn-danger text-white"
                                    onclick="return confirm('Are you sure you want to permanently delete the data?')">
                                    Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
</div> 
{{-- Assign Ticket Modal --}}
@foreach ($submissions as $submission)
<div class="modal fade" id="assign{{$submission->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assign Ticket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('tickets.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="priority" class="col-sm-3 col-form-label text-sm-left">
                                Priority</label>
                            <div class="col-sm-9">
                                <select name="priority" id="priority" class="form-select rounded-pill"
                                    placeholder="">
                                    <option value="" selected disabled>Choose...
                                    </option>
                                    <option value="LOW">
                                        Low
                                    </option>
                                    <option value="MEDIUM">
                                        Medium
                                    </option>
                                    <option value="High">
                                        High
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="user_id" class="col-sm-3 col-form-label text-sm-left">
                                Staff</label>
                            <div class="col-sm-9">
                                <select name="user_id" id="user_id" class="form-select rounded-pill" 
                                    placeholder="" >
                                    <option value="" selected disabled>Choose...
                                    </option>
                                    @foreach ($staffs as $staff)
                                    <option value="{{$staff->id}}">
                                        {{$staff->name}}
                                    </option>
                                    @endforeach
                                </select>
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
</div>
@endforeach
@endsection