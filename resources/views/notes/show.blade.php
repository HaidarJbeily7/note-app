@extends('layouts.app')


@section('content')
{{-- {{ dd($note['content']) }} --}}

<div class="container">
    <div class="row justify-content-center" style="margin-bottom: 10px;">
        <div class="col-md-5 ">
            <a style="width: 100%;" href="{{ route('notes.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="text-align: center;font-weight:bold;">{{ strlen($note['title']) ? $note['title']:"No Title";  }}</div>
                <div class="card-body" style="padding-bottom: 6%;">
                    <div class="col-18 mb-3">
                        <label for="content" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-md-18">
                            <textarea   rows="4"  class="form-control" id="content"  readonly>{{ trim($note['content']) }}</textarea>
                        </div>
                        </div>
                    <div class="type col-18 mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input class="form-control" type="text" name="type" disabled value={{ $note['type'] }}>
                    </div>
                    <div class="image col-18 mb-3"  >
                        <label for="image" class="form-label">Attached Image</label>
                        <div class="col-18 justify-content-center" class="form-label">
                            {{-- {{ dd($note['image']) }} --}}
                            <img src="{{ url('/storage/'.$note['image'])  }}" class="img-thumbnail"  alt="no image attached!" width="250px" height="200px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top:20px;">

        <div class="col-md-3">
            <a style="width:100%;" href="{{ route('notes.create') }}" class="btn btn-primary" style="color:cornsilk;"> Get Link </a>
        </div>
        <div class="col-md-3">
            <form action="{{ route('notes.destroy',$note['id']) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button style="width:100%;"  class="btn btn-danger"> Delete Note </button>
            </form>

        </div>
    </div>
</div>

@endsection
