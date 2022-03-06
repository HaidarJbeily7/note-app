@extends('layouts.app')

@section('content')
<div class="container">
    {{-- {{ dd($success) }} --}}
    @if (session()->has('success'))
        <div class="alert alert-success" style="text-align: center;">
                {{ session()->get('success', 'Success!'); }}
        </div>
    @endif
    @if (session()->has('alert'))
        <div class="alert alert-danger" style="text-align: center;">
                {{ session()->get('alert', 'Success!'); }}
        </div>
    @endif
    <div class="row justify-content-center" style="margin-bottom:30px;">
        <div class="col-md-3">
            <a style="width:100%;" href="{{ route('notes.create') }}" class="btn btn-success"> Create Note </a>
        </div>
        <div class="col-md-3">
            <a style="width:100%;" href="{{ route('stat') }}" class="btn btn-secondary" style="color:cornsilk;"> Go to Report </a>
        </div>
    </div>

    <div class="row ">

    @foreach ($data as  $note)
        <div class="col-md-6" style="margin-bottom:30px;">
            <div class="card" id = "{{ $note->id }}">
                <div class="card-header" style="text-align: center;">{{ strlen($note->title) ? $note->title:'no title'}}</div>

                <div class="card-body" style="display: flex; justify-content:center;" >


                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-light" style="margin-right:7px;background-color: #BBB;border:4px #BBB;"> Show Details</a>
                            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-primary"style="margin-right:7px;" > Make Edits </a>


                </div>
            </div>
        </div>

        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {!! $data->links() !!}
    </div>

</div>
@endsection
