@extends('layouts.app')

@section('content')

<?php $length = count($values); ?>
<?php $feeNumber = count($fees)?>


{!! Form::open(['method'=>'PATCH', 'action'=> 'ValueController@update']) !!}

    <div class="form-group">
        {!! Form::hidden('year_id', $year_id, ['class'=>'form-control']) !!}
    </div>

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

        @for ($i = 0; $i < $length ; $i = $i+ $feeNumber)
        <tr>
            <td>{{$values[$i]->grade_name}}</td>
            
            @for ($j = $i; $j < $i+ $feeNumber ; $j++)

                <td>
                    <div class="form-group">
                        {!! Form::text('value[]', $values[$j]->value, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('grade[]', $values[$j]->grade_id, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('fee_id[]', $values[$j]->fee_id, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('id[]', $values[$j]->id, ['class'=>'form-control']) !!}
                    </div>
                </td>
            @endfor
        </tr>

        @endfor
    
   </tbody>
</table> 
<div class="form-group">
    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

@endsection
