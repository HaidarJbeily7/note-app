@extends('layouts.app')

{{-- {{ dd($note) }} --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('notes.update', $note['id']) }}" method="post">
                {{ @csrf_field() }}
                <label for="">content:</label>
                <textarea name="content" id="" cols="30" rows="10"></textarea>
                <label for="">Type</label>
                <input type="checkbox" name="type" id="">
                <input type="image" src="" alt="">
            </form>
        </div>
    </div>
</div>
@endsection
