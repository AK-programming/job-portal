@extends('layout')

@section('content')
  <h2>All Resumes</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>ResumeID</th><th>SeekerID</th><th>FilePath</th><th>UploadDate</th><th>LastUpdated</th>
      </tr>
    </thead>
    <tbody>
    @foreach($resumes as $r)
      <tr>
        <td>{{ $r->ResumeID }}</td>
        <td>{{ $r->SeekerID }}</td>
        <td>{{ $r->FilePath }}</td>
        <td>{{ $r->UploadDate }}</td>
        <td>{{ $r->LastUpdated }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
