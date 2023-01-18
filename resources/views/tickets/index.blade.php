@extends('layout.layout')

@section('title', 'LadyBug | Manage Tickets')

@section('content')
<div class="container mt-5 py-5">
    <div class=" card card-shadow border-0 rounded-20 ">
        <div class="card-body my-3">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3">Tickets</h5>
            <h3 class="fw-bold my-3 c-text-1">Ticket List</h3>  
            <hr>
            <div class="table-responsive py-3">
                <table id="myTable" class="table table-bordered table-sm table-striped no-footer">
                <thead class="thead-light">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Type</th>
                    <th class="align-middle text-center">Topic</th>
                    <th class="align-middle text-center">Title</th>
                    <th class="align-middle text-center">Submitted by</th>
                    <th scope="col" class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="align-middle text-center">{{ $ticket->id }}</td>
                            <td class="align-middle text-center">{{ $ticket->submission->type }}</td>
                            <td class="align-middle text-center">{{ $ticket->submission->topic }}</td>
                            <td class="align-middle text-center">{{ $ticket->submission->title }}</td>
                            <td class="align-middle text-center">{{ $ticket->submission->user->name}}</td>
                            <td class="align-middle text-center d-flex justify-content-center">
                                <a class="btn btn-sm btn-block btn-info text-white"
                                    target="_blank" href="/storage/images/submissions/{{ $ticket->submission->image }}"
                                    style="margin-inline: 0.4vw">Screenshot</a>
                                <button type="button" class="btn btn-sm btn-block btn-primary text-white" style="margin-inline: 0.4vw"
                                data-bs-toggle="modal" data-bs-target="#assign{{$ticket->id}}">
                                    Update Status
                                </button>
                                {{-- <a class="btn btn-sm btn-block btn-warning text-white"
                                    href="{{ route('submissions.edit', $ticket->id) }}"
                                    style="margin-inline: 0.4vw">Edit</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
</div> 

{{-- Update Ticket Status Modal --}}
@foreach ($tickets as $ticket)
<div class="modal fade" id="assign{{$ticket->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Ticket Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('tickets.status-update', $ticket->id)}}" enctype="multipart/form-data">
                @csrf
                @method('UPDATE')
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group row mb-0 mb-sm-3">
                            <label for="status" class="col-sm-3 col-form-label text-sm-left">
                                Status</label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-select rounded-pill"
                                    placeholder="">
                                    <option value="" disabled>Choose...
                                    </option>
                                    <option value="Pending" @if ($ticket->status == "Pending") selected @endif>
                                        Pending
                                    </option>
                                    <option value="In Progress" @if ($ticket->status == "In Progress") selected @endif>
                                        In Progress
                                    </option>
                                    <option value="In Review" @if ($ticket->status == "In Review") selected @endif>
                                        In Review
                                    </option>
                                    <option value="Resolved" @if ($ticket->status == "Resolved") selected @endif>
                                        Resolved
                                    </option>
                                </select>
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
</div>
@endforeach
@endsection