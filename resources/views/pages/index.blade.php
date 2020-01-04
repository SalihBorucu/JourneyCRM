@extends('Layout')
@section('content')


<h1>All Leads View</h1>

<table class="table">
  <thead>
    <tr>
      <th title="Name">Name</th>
      <th title="Surname">Surname</th>
      <th title="Country">Country</th>
      <th title="email">E-mail</th>

      <th title="phoneNumber">Phone Number</th>
    </tr>
  </thead>

    <tbody>

@foreach ($leads as $lead)
		<tr>
		<td><a href='/pages/{{$lead->id}}/edit'> {{ $lead->name }} </a> </td>

			<td> {{$lead->surname}} </td>
			<td> {{$lead->country}}
			<td> {{$lead->email}} </td>
			<td> {{$lead->phoneNumber}} </td>
      <td> <a class="btn btn-success">Call</a> </td>
      <td> <a class="btn btn-danger">Email</a> </td>
      <td> <a class="btn btn-primary">Social</a> </td>
		</tr>


@endforeach

</tbody>

@endsection
