@extends('layouts.app')

@section('content')
    @foreach ($data as $d)
        <div class="panel panel-default fact">
            <div class="panel-body">
                <div>- {{ $d['fact'] }}</div>
            </div>
        </div>
    @endforeach
    {{  $data->links() }}
@endsection
