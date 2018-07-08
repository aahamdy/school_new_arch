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

<?php $length = count($values); ?>


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

        @for ($i = 0; $i < $length ; $i = $i+3)
        <tr id ="datatr" class="{{$values[$i]->name}} {{$values[$i]->year}} schoolname yearnumber all" >
            <td>{{$values[$i]->grade}}</td>
            @for ($j = $i; $j < $i+3 ; $j++)
                <td>{{$values[$j]->value}}</td>
            @endfor
        </tr>
        @endfor               
   



        {{-- @foreach($values as $value)
            <tr id ="datatr" class="{{$value->name}} {{$value->year}} schoolname yearnumber all" >
                <td> {{$value->grade}} </td>
                <td> {{$value->value}} </td>
                
                

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
        @endforeach --}}



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
                        
            $("tr#datatr").hide();
            $("tbody").find("tr." + filters).show();

          });

        });
</script>
      

@endsection
