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
                                <a href="/dashboard/event/participant/remove/{{Auth::id()}}/{{$event->id}}" class="btn btn-danger float-right"
                                    onclick="event.preventDefault();document.getElementById('delete-form').submit();">Disjoin</a>
                              </form>
                            <form id="delete-form" action="/dashboard/event/participant/remove/{{Auth::id()}}/{{$event->id}}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
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
