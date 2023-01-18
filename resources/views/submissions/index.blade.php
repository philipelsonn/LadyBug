@extends('layout.layout')

@section('title', 'LadyBug | Manage Submissions')

@section('content')
    <h2 class="fw-bold text-center mt-4">Submissions</h2>
    <div class="container mt-4">
        <div class="card p-4 bg-light">
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
                            <td class="align-middle">{{ $submission->submitted_by }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-info text-dark fw-bold me-2" href="/storage/images/submissions/{{ $submission->image }}">Screenshot</a>
                                    @if (auth()->user()->type == 'USER')
                                        <a class="btn btn-sm btn-warning text-dark fw-bold me-2" href="{{ route('submissions.edit', $submission->id) }}">Edit</a>
                                    @else
                                        <a class="btn btn-sm btn-primary text-dark fw-bold me-2" data-bs-toggle="modal" data-bs-target="#assign{{$submission->id}}">Assign</a>
                                    @endif
                                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST">
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

    {{-- Assign Ticket Modal --}}
    @foreach ($submissions as $submission)
        <div class="modal" id="assign{{$submission->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assign Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('tickets.store', $submission->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('UPDATE')
                        <div class="modal-body">
                            <p class="fw-bold my-auto text-center mb-3">{{ $submission->description }}</p>
                            <div class="d-flex justify-content-evenly mb-2">
                                <p class="my-auto">Priority</p>
                                <div class="col-md-8">
                                    <select name="status" id="status" class="form-select rounded-pill"
                                        placeholder="">
                                        <option value="" disabled>Choose...
                                        </option>
                                        <option value="Low">
                                            Low
                                        </option>
                                        <option value="Medium">
                                            Medium
                                        </option>
                                        <option value="High">
                                            High
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-evenly mb-2">
                                <p class="my-auto me-3">Staff</p>
                                <div class="col-md-8">
                                    <select name="status" id="status" class="form-select rounded-pill"
                                        placeholder="">
                                        <option value="" disabled>Choose...
                                        </option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->name }}">
                                                {{ $staff->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @method('PUT')
                            <button type="submit" class="btn btn-warning fw-bold">Assign Tickets</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
