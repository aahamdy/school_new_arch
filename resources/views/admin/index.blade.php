@foreach($values as $value)

{{$value->id}}

@endforeach

{{--  
<table>
    <thead>
        <tr>
            <th> id</th>
            <th> name</th>
            <th> last name  </th>
            <th> email </th>
            <th> phone</th>
            <th> adddress </th>
        </tr>
    </thead>
    <tbody>
         @foreach($users as $user)
          <tr>
              <td> {{$user->id}} </td>
              <td> {{$user->name}} </td>
              <td> {{$user->last_name}} </td>
              <td> {{$user->email}} </td>
              <td> {{$user->phone}} </td>
              <td> {{$user->address}} </td>
          </tr>
         @endforeach
   </tbody>
</table>  --}}