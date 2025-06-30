@extends('layout')

@section('content')
  <h2>All Job Seekers</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>SeekerID</th><th>UserID</th><th>DOB</th><th>Address</th><th>ProfileSummary</th>
      </tr>
    </thead>
    <tbody>
    @foreach($jobseekers as $js)
      <tr>
        <td>{{ $js->SeekerID }}</td>
        <td>{{ $js->UserID }}</td>
        <td>{{ $js->DateOfBirth }}</td>
        <td>{{ $js->Address }}</td>
        <td>{{ $js->ProfileSummary }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
