@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom:30px;">
        <div class="col-md-3">
            <a style="width:100%;" href="{{ route('notes.create') }}" class="btn btn-success"> Create Note </a>
        </div>
        <div class="col-md-3">
            <a style="width:100%;" href="{{ route('notes.create') }}" class="btn btn-secondary" style="color:cornsilk;"> Generate PDF </a>
        </div>
    </div>
    <?php $i = 1; ?>
    <div class="row ">
    @foreach ($data as $index => $note)
        <div class="col-md-4" style="margin-bottom:30px;">
            <div class="card" id = "{{ $note['id'] }}">
                <div class="card-header" style="text-align: center;">{{ strlen($note['title']) ? $note['title']:'no title'}}</div>

                <div class="card-body">

                        <div class="col-15" style="width:100%; margin-left:32px;">
                            <a href="{{ route('notes.show', $note['id']) }}" class="btn btn-light" style="background-color: #BBB;border:4px #BBB;"> Show Details</a>
                            <a href="{{ route('notes.edit', $note['id']) }}" class="btn btn-primary"> Edit </a>
                            <a onclick="deleteNote({{ $note['id'] }})" class="btn btn-danger"> Delete </a>
                        </div>

                </div>
            </div>
        </div>
        <?php $i++;?>
        @endforeach
    </div>

</div>
<script>
    function deleteNote(note_id)
    {
        if (confirm("Are you sure?")) {
                let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{route('notes.destroy'," + note_id+")}}",
            type: "delete",
            data: {
                id: note_id,
                _token: _token
            },
            success: function(response) {
                console.log(response.success);
                let container = document.getElementById(response.success);
                container.innerHTML = ``;
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


</script>
@endsection
