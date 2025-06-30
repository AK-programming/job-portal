@extends('layout')

@section('content')
  <h2>All Employers</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>EmployerID</th><th>UserID</th><th>CompanyDescription</th><th>CompanyWebsite</th><th>VerifiedStatus</th>
      </tr>
    </thead>
    <tbody>
    @foreach($employers as $e)
      <tr>
        <td>{{ $e->EmployerID }}</td>
        <td>{{ $e->UserID }}</td>
        <td>{{ $e->CompanyDescription }}</td>
        <td>{{ $e->CompanyWebsite }}</td>
        <td>{{ $e->VerifiedStatus ? 'Yes' : 'No' }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
