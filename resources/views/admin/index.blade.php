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

{!! Form::open(['method'=>'PATCH', 'action'=> 'ValueController@update']) !!} 

    <table class="table">

    <thead>
        <tr>
            <th scope="col"> Grade </th>
            @foreach($fees as $fee)
                <th scope="col">{{$fee->type}}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>

        @foreach($values as $value)
            <tr id ="datatr" class="{{$value->name}} {{$value->year}} all" >
                <td>{{$value->grade}}</td>

                <td>
                    <div class="form-group">
                        {!! Form::text('value', 0, ['class'=>'form-control']) !!}
                    </div>
                </td>
            </tr>

        @endforeach
    
   </tbody>
</table> 
<div class="form-group">
    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script language="javascript">
        $(document).ready(function(e) {

          $(".filter").change(function(){

            var filters = $.map($(".filter").toArray(), function(e){
                return $(e).val();  
            }).join(".");
                        
            $("tr#datatr").hide();
            $("tbody").find("tr." + filters).show();

          });

        });
</script>
      

@endsection
