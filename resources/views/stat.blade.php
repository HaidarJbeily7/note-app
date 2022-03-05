@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped table-active table-success table-borderless table-hover table-responsive caption" style="width:100%;">
                <thead>
                    <th>name</th>
                    <th>urgent</th>
                    <th>normal</th>
                    <th>on date</th>
                </thead>
                <tbody>
                    @foreach ($data as $ind => $val )
                        <tr>
                            <td>{{ $val['name'] }}</td>
                            <td>{{ $val['urgent'] }}</td>
                            <td>{{ $val['normal'] }}</td>
                            <td>{{ $val['on date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
