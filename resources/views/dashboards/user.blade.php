@extends('layout.layout')

@section('title', 'LadyBug | Dashboard')

@section('content')
<div class="container my-auto">
    <div class="card p-4 bg-light mt-3 mb-3">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="fw-bold"> My Submissions</h2>
            <a class="btn btn-lg btn-success text-white fw-bold" href="{{ route('submissions.create') }}">Add New Submission</a>
        </div>
        <table id="myTable" class="table table-striped bg-light">
            <thead>
                <tr class="">
                    <th class="col-md-1 align-middle">ID</th>
                    <th class="col-md-2 align-middle">Type</th>
                    <th class="col-md-2 align-middle">Topic</th>
                    <th class="col-md-3 align-middle">Title</th>
                    <th class="col-md-3 align-middle">Status</th>
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
                        <td class="align-middle">
                            @foreach ($tickets as $ticket)
                                @if ($ticket->submission_id == $submission->id)
                                    {{$ticket->status}}
                                @endif
                            @endforeach
                        </td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-info text-dark fw-bold me-2" target="_blank" href="/storage/images/submissions/{{ $submission->image }}">Screenshot</a>
                                <a class="btn btn-sm btn-warning text-dark fw-bold me-2" href="{{ route('submissions.edit', $submission->id) }}">Edit</a>
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
@endsection
