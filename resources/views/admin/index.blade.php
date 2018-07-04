@extends('layouts.app')

@section('content')

<select id="schoolfilter">
    <option value="" disabled selected>Select School</option>
    @foreach($schools as $school)
        <option value="{{$school->name}}">{{$school->name}}</option>
    @endforeach
</select>

<select id="yearfilter">
        <option value="" disabled selected>Select Year</option>
        @foreach($years as $year)
            <option value="{{$year->id}}">{{$year->year}}</option>
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
            <tr class="{{$value->name}} schoolname" >
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
          $("#schoolfilter").change(function(){
            console.log ("corect");
            if($(this).val() != ""){
              $(".schoolname").hide();
              $("." + $(this).val()).show();
            }
          });
        });
</script>
      

@endsection
