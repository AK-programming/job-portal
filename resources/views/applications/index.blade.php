@extends('layout')

@section('content')
<div class="container mt-4">
  <h2>Applications Received</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($applications->isEmpty())
    <p class="text-muted">No applications yet.</p>
  @else
    <table class="table table-bordered mt-3">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Job Title</th>
          <th>Applicant</th>
          <th>Applied Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($applications as $app)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $app->JobTitle }}</td>
            <td>{{ $app->SeekerName }}</td>
            <td>{{ $app->AppliedDate }}</td>
            <td>
              @if ($app->Status === 'Approved')
                <span class="badge bg-success">Approved</span>
              @elseif ($app->Status === 'Rejected')
                <span class="badge bg-danger">Rejected</span>
              @else
                <span class="badge bg-secondary">Pending</span>
              @endif
            </td>
            <td>
              @if ($app->Status === 'Pending')
              <form action="{{ route('employer.applications.approve', $app->ApplicationID) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">Approve</button>
              </form>

              <form action="{{ route('employer.applications.reject', $app->ApplicationID) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
              </form>
              @else
              <em>No action</em>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
