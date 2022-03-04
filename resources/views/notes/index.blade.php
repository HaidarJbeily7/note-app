@extends('layouts.app')

@section('content')
<div class="container">
    <?php $i = 1; ?>
    <div class="row ">
    @foreach ($data as $index => $note)
        <div class="col-md-4">
            <div class="card" id = "{{ $note['id'] }}">
                <div class="card-header">{{ __('messages.note').' '.$i}}</div>

                <div class="card-body">
                    <div>

                        <a href="{{ route('notes.show', $note['id']) }}" class="btn btn-primary"> Show Details</a>
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
