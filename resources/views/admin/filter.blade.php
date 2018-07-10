@extends('layouts.app')

@section('content')

    {!! Form::open(['method'=>'get', 'action'=> 'ValueController@index']) !!}

        {!! Form::select('school_id', $schools, 1) !!}
        {!! Form::select('year_id', $years, 1) !!}

        {!! Form::submit('Filter', ['class' => 'btn btn-sm btn-primary']) !!}

    {!! Form::close() !!}

@endsection
