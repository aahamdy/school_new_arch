@extends('layouts.app')

@section('content')

<select class="filter">
    <option value="all">All School</option>
    @foreach($schools as $school)
        <option value="{{$school->name}}">{{$school->name}}</option>
    @endforeach
</select>

<select class="filter">
        <option value="all">All Year</option>
        @foreach($years as $year)
            <option value="{{$year->year}}">{{$year->year}}</option>
        @endforeach
    </select>

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

            <tr id ="datatr" class="{{$value->name}} {{$value->year}} schoolname yearnumber all" >
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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script language="javascript">
        $(document).ready(function(e) {

          $(".filter").change(function(){

            var filters = $.map($(".filter").toArray(), function(e){
                return $(e).val();  
            }).join(".");
            
            console.log(filters);
            
            $("tr#datatr").hide();
            $("tbody").find("tr." + filters).show();

          });

        });
</script>
      

@endsection
