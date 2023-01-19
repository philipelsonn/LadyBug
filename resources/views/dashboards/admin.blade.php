@extends('layout.layout')

@section('title', 'LadyBug | Dashboard')

@section('content')
    <div class="container my-auto">
        <div class="card p-4 bg-light mt-3">
            <h2 class="fw-bold text-center mt-2 mb-4">Submissions</h2>
            <table id="myTable" class="table table-striped bg-light">
                <thead>
                    <tr class="">
                        <th class="col-md-1 align-middle">ID</th>
                        <th class="col-md-2 align-middle">Type</th>
                        <th class="col-md-2 align-middle">Topic</th>
                        <th class="col-md-3 align-middle">Title</th>
                        <th class="col-md-2 align-middle">Submitted By</th>
                        <th class="col-md-2 align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($submissions as $submission)
                        <tr class="">
                            <td class="align-middle fw-bold">{{ $submission->id }}</td>
                            <td class="align-middle">
                                {{ $submission->type }}
                            </td>
                            <td class="align-middle">
                                {{ $submission->topic }}
                            </td>
                            <td class="align-middle">{{ $submission->title }}</td>
                            <td class="align-middle">{{ $submission->user->name }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-info text-dark fw-bold me-2" target="_blank" href="/storage/images/submissions/{{ $submission->image }}">Screenshot</a>
                                    <a class="btn btn-sm btn-primary text-dark fw-bold me-2" data-bs-toggle="modal" data-bs-target="#assign{{$submission->id}}">Assign</a>
                                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-block btn-danger text-white fw-bold"
                                        onclick="return confirm('Are you sure you want to permanently delete the data?')">
                                        DELETE</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php($i = $i + 1)
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container my-auto">
        <div class="card p-4 bg-light mt-3 mb-3">
        <h2 class="fw-bold text-center mt-2 mb-4">Resolved</h2>
            <table id="myTable2" class="table table-striped bg-light">
                <thead>
                    <tr class="">
                        <th class="col-md-1 align-middle">ID</th>
                        <th class="col-md-2 align-middle">Type</th>
                        <th class="col-md-2 align-middle">Topic</th>
                        <th class="col-md-3 align-middle">Title</th>
                        <th class="col-md-2 align-middle">Submitted By</th>
                        <th class="col-md-2 align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($submissions as $submission)
                    @if ($submission->ticket)
                        @if ($submission->ticket->status == "Resolved")
                            <tr class="">
                                <td class="align-middle fw-bold">{{ $submission->id }}</td>
                                <td class="align-middle">
                                    {{ $submission->type }}
                                </td>
                                <td class="align-middle">
                                    {{ $submission->topic }}
                                </td>
                                <td class="align-middle">{{ $submission->title }}</td>
                                <td class="align-middle">{{ $submission->user->name }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-sm btn-info text-dark fw-bold me-2" target="_blank" href="/storage/images/submissions/{{ $submission->image }}">Screenshot</a>
                                    </div>
                                </td>
                                </td>
                            </tr>
                            @php($i = $i + 1)
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<h2 class="fw-bold text-center mt-4">Tickets</h2>
<div class="container mt-4">
    <div class="card p-4 bg-light">
        <table id="myTable" class="table table-striped bg-light">
            <thead>
                <tr class="">
                    <th class="col-md-1 align-middle">ID</th>
                    <th class="col-md-1 align-middle">Type</th>
                    <th class="col-md-2 align-middle">Topic</th>
                    <th class="col-md-3 align-middle">Title</th>
                    <th class="col-md-2 align-middle">Submitted By</th>
                    <th class="col-md-1 align-middle">Priority</th>
                    <th class="col-md-2 align-middle">Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($tickets as $ticket)
                    <tr class="">
                        <td class="align-middle fw-bold">{{ $ticket->id }}</td>
                        <td class="align-middle">
                            {{ $ticket->submission->type }}
                        </td>
                        <td class="align-middle">
                            {{ $ticket->submission->topic }}
                        </td>
                        <td class="align-middle">{{ $ticket->submission->title }}</td>
                        <td class="align-middle">{{ $ticket->submission->user->name }}</td>
                        <td class="align-middle @if ($ticket->priority == 'LOW')
                            bg-info
                            @elseif ($ticket->priority == 'MEDIUM')
                            bg-warning
                            @elseif ($ticket->priority == 'HIGH')
                            bg-danger
                            @else
                            bg-success
                        @endif">{{ $ticket->priority }}</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-warning text-dark fw-bold me-2" data-bs-toggle="modal" data-bs-target="#assign{{$ticket->id}}">Update Status</a>
                                <form action="{{ route('submissions.destroy', $ticket->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-block btn-danger text-white fw-bold"
                                    onclick="return confirm('Are you sure you want to permanently delete the data?')">
                                    DELETE</button>
                                </form>
                            </div>
                        </td>
                        </td>
                    </tr>
                    @php($i = $i + 1)
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<h2 class="fw-bold text-center mt-4">Resolved</h2>
<div class="container mt-4">
    <div class="card p-4 bg-light">
        <table id="myTable2" class="table table-striped bg-light">
            <thead>
                <tr class="">
                    <th class="col-md-1 align-middle">ID</th>
                    <th class="col-md-2 align-middle">Type</th>
                    <th class="col-md-2 align-middle">Topic</th>
                    <th class="col-md-3 align-middle">Title</th>
                    <th class="col-md-2 align-middle">Submitted By</th>
                    <th class="col-md-2 align-middle">Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($submissions as $submission)
                @if ($submission->ticket)
                    @if ($submission->ticket->status == "Resolved")
                        <tr class="">
                            <td class="align-middle fw-bold">{{ $submission->id }}</td>
                            <td class="align-middle">
                                {{ $submission->type }}
                            </td>
                            <td class="align-middle">
                                {{ $submission->topic }}
                            </td>
                            <td class="align-middle">{{ $submission->title }}</td>
                            <td class="align-middle">{{ $submission->user->name }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-info text-dark fw-bold me-2" target="_blank" href="/storage/images/submissions/{{ $submission->image }}">Screenshot</a>
                                </div>
                            </td>
                            </td>
                        </tr>
                        @php($i = $i + 1)
                    @endif
                    @endforeach
                </tbody>
            </table>
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
            <form method="POST" action="{{route('tickets.store', $submission->id)}}" enctype="multipart/form-data">
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
