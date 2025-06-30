@extends('layout')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">My Applications</h3> <!-- ✅ Keep this heading -->

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($applications->isEmpty())
        <div class="alert alert-info">You haven't applied for any jobs yet.</div>
    @else
    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th>Job Title</th>
                <th>Applied Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($applications as $app)
            <tr>
                <td>{{ $app->JobTitle }}</td>
                <td>{{ \Carbon\Carbon::parse($app->AppliedDate)->format('d M, Y') }}</td>
                <td>
                    @if($app->Status === 'Pending')
                        <span class="badge bg-warning text-dark">{{ $app->Status }}</span>
                    @elseif($app->Status === 'Approved')
                        <span class="badge bg-success">{{ $app->Status }}</span>
                    @elseif($app->Status === 'Rejected')
                        <span class="badge bg-danger">{{ $app->Status }}</span>
                    @else
                        <span class="badge bg-secondary">{{ $app->Status }}</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
