@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Event list') }}</div>
            <div class="container-fluid">
                <div class="row">
                    @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card-body px-0">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $event->event_date }}</h6>
                                <h6 class="card-subtitle mb-2 text-muted">For adults:
                                @if ($event->for_adults == true)
                                    Yes
                                @else
                                    No
                                @endif</h6>
                                <p class="card-text">{{ $event->description }}</p>
                                <p class="badge badge-pill badge-primary py-2">Participants: {{ $event->current_participants }}/{{ $event->max_participants }}</p>
                                <a href="/dashboard/event/{{$event->id}}" class="btn btn-warning float-right">Edit</a>

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
