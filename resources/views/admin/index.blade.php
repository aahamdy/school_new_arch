@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col"> Id </th>
            <th scope="col"> School Name</th>
            <th scope="col"> Year  </th>
            <th scope="col"> Grade </th>
            <th scope="col"> Fee Type</th>
            <th scope="col"> Value </th>
        </tr>
    </thead>
    <tbody>
        @foreach($values as $value)
            <tr>
                <td> {{$value->id}} </td>
                <td> {{$value->name}} </td>
                <td> {{$value->year}} </td>
                <td> {{$value->grade}} </td>
                <td> {{$value->type}} </td>
                <td>

                    {!! Form::model($value,['method'=>'PATCH', 'action'=> ['ValueController@update', $value->id]]) !!} 

                    <div class="form-group">
                        {!! Form::text('value', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
   </tbody>
</table> 
@endsection
