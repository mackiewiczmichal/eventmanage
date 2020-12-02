@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Event list') }}</div>
            <div class="container-fluid">
                @if (session('error'))
                    <div class="alert alert-danger my-2">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success my-2">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row row-eq-height">
                    @foreach ($events as $event)
                    <div class="col-md-4 align-self-end">
                        <div class="card-body px-0">
                            <div class="card ">
                                <div class="card-image-main" style="
                               @if($event->images !=[]) background-image:url('{{ asset("images") }}/{{$event->images->name}}'); @endif
                                background-size:cover;
                                background-repeat:no-repeat;
                                background-position:center;
                                height:250px;">
                                </div>

                                <ul class="list-group">
                                    <li class="list-group-item">Event title: {{ $event->title }}</li>
                                    <li class="list-group-item">Event start date: {{ $event->event_start_date }}</li>
                                    <li class="list-group-item">Event end date: {{ $event->event_end_date }}</li>
                                    <li class="list-group-item">Is event for adults?:
                                        @if ($event->for_adults == true)
                                        Yes
                                    @else
                                        No
                                    @endif
                                    </li>
                                  </ul>
                                <div class="card-body">
                                <p class="badge badge-pill badge-primary py-2">Participants: {{ $event->current_participants }}/{{ $event->max_participants }}</p>
                                @if (Auth::id() != $event->users_id)
                                    <a href="/dashboard/event/participant/{{$event->id}}" class="btn btn-primary float-right">Join</a>
                                @endif
                                <a href="/dashboard/events/details/{{$event->id}}" class="btn btn-success float-right">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="/dashboard/events/new" class="btn btn-success float-left my-3">Add event</a>
                    </div>
                </div>
            </div>



            </div>
        </div>
    </div>
</div>
@endsection
