@extends('layout')

@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/talks/">Talks</a></li>
            <li><a href="/talks/{{ $talk->id }}">Talk: {{ $talk->title }}</a></li>
        </ol>

        <h1>Edit Talk Nickname/Global Title</h1>

        <ul class="errors">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>

        {{ Form::open(array('action' => array('TalksController@update', $talk->id), 'class' => 'edit-talk-form')) }}

        <div class="form-group">
            {{ Form::label('title', '*Talk Nickname/Global Title', ['class' => 'control-label']) }}
            {{ Form::text('title', $talk->title, ['class' => 'form-control']) }}
            <span class="help-block">This is the global name for this talk, that helps you understand it internally. This won't ever go out to a conference organizer. This is just your internal nickname that groups all versions of this talk.</span>
        </div>

        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}<br><br>

        {{ Form::close() }}

    </div>
@stop
