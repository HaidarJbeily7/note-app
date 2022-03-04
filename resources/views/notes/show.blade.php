@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <label for="">content:</label>
            <p >{{ $note['content'] }}</p>
            <label for="">Type</label>
            <span>{{ $note['type'] }}</span>
        </div>
    </div>
</div>
@endsection
