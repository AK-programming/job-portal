@extends('layout')

@section('content')
  <h2>All Users</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>UserID</th><th>Name</th><th>Email</th><th>UserType</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $u)
      <tr>
        <td>{{ $u->UserID }}</td>
        <td>{{ $u->Name }}</td>
        <td>{{ $u->Email }}</td>
        <td>{{ $u->UserType }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
