@extends('csv_file')

@section('csv_data')

<table class="table table is-bordered">
 <thead>
  <tr>
   <th>Name</th>
   <th>Surname</th>
      <th>Email</th>
         <th>Phone Number</th>
            <th>Country</th>
            <th>Created Date</th>
  </tr>
 </thead>
 <tbody>
 @foreach($data as $row)
  <tr>
   <td>{{ $row->name }}</td>
   <td>{{ $row->surname }}</td>
   <td>{{ $row->email }}</td>
   	<td>{{ $row->phoneNumber }}</td>
   <td>{{ $row->country }}</td>
   <td>{{ $row->created_date}}

   
  </tr>
 @endforeach
 </tbody>
</table>

{!! $data->links() !!}

@endsection
