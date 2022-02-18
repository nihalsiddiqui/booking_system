@extends('admin.layouts.app')
@section('content')
    <form action="{{route('train.admin.flight.seat.store',['flight_id'=>$currentFlight->id,'id'=>$row->id??-1])}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$row->id}}">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="d-flex justify-content-between mb20">
                        <div class="">
                            <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->name : __('Add new')}}</h1>
                        </div>
                    </div>
                    @include('admin.message')
                    @if($row->id)
                        @include('Language::admin.navigation')
                    @endif
                    <div class="lang-content-box">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("Content")}}</strong></div>
                            <div class="panel-body">
                                @include('Train::admin.flight.seat.form')
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">{{__("Save Change")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section ('script.body')
@endsection
