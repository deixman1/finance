@extends('layouts.app')

@section('content')
    {{--{{ dd(json_encode($balance)) }}--}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewEventModal" style="font-size: 18px">+ Создать новое событие</button>
        </div>
        <div class="col-md-4">
            <user-view></user-view>
            {{--                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif--}}
        </div>
    </div>
    <history-view></history-view>
    <!-- Modal -->
    <create-event-modal></create-event-modal>
</div>
@endsection
