@extends('layouts.app')


@section('content')
{{-- {{ dd($note['content']) }} --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="text-align: center;font-weight:bold;">{{ strlen($note['title']) ? $note['title']:"No Title";  }}</div>
                <div class="card-body">
                    <div class="col-18 mb-3">
                        <label for="content" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-md-18">
                            <textarea   rows="4"  class="form-control" id="content"  readonly>{{ trim($note['content']) }}</textarea>
                        </div>
                        </div>
                    <div class="type">
                        <label for="type" class="form-label">Type</label>
                        <input class="form-control" type="text" name="type" disabled value={{ $note['type'] }}>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
