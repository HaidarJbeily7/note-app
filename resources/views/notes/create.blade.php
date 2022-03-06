@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom: 10px;">
        <div class="col-md-5 ">
            <a style="width: 100%;" href="{{ route('notes.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="text-align: center;font-weight:bold;">New Note</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{ route('notes.store') }}" method="post" enctype='multipart/form-data'>
                        {{ @csrf_field() }}
                        <div class="col-18 mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-md-18">
                              <input type="text" class="form-control" id="title" name = "title" value="{{ old('title') }}">
                            </div>
                          </div>
                        <div class="col-18 mb-3">
                            <label for="content" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-md-18">
                              <textarea type="text" class="form-control" id="content" name = "content">{{ old('content') }}</textarea>
                            </div>
                          </div>
                        <div class="type">
                            <label for="type" class="form-label">Type</label>
                            <input class="form-control" list="types" id="type" placeholder="Choose one type, please." name="type" value="{{ old('type') }}">
                            <datalist id="types">
                                <option value="urgent">
                                <option value="on date">
                                <option value="normal">
                            </datalist>
                        </div>
                        <div class="image-input">
                            <div class="col-18 mb-3" style="margin-top:15px;">
                                <label for="image11" class="form-label">Attach Image(optional)</label>
                                <input class="form-control" type="file" id="image11" name="image">
                            </div>
                        </div>
                        <div class="row justify-content-center" style="margin-top: 30px;">
                            <div class="col-4">
                                <button type="submit" class="btn btn-success" style="width: 100%;">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
