@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h2>Szczegóły wydarzenia: {{ $event->title }} </h2>
                    @if (Auth::id() != $event->users_id)
                    <a href="/dashboard/event/participant/{{$event->id}}" class="btn btn-primary float-right">Join</a>
                @endif
                </div>

                <div class="card-body">

                    @csrf
                    <div class="container-fluid">
                        <div class="row row-eq-height">
                            <div class="col-lg-6">
                                <ul class="list-group">
                                    <li class="list-group-item"><h4>Event title: </h4>{{ $event->title}}</li>
                                    <li class="list-group-item"><h4>Event creator: </h4>{{ $event->user->name}} /
                                        <a href="mailto:{{ $event->user->email}}">{{ $event->user->email}}</a></li>
                                    <li class="list-group-item"><h4>Event start date: </h4>{{ $event->event_start_date }}</li>
                                    <li class="list-group-item"><h4>Event end date: </h4>{{ $event->event_end_date }}</li>
                                    <li class="list-group-item"><h4>Is event for adults?: </h4>
                                        @if ($event->for_adults == true)
                                        Yes
                                    @else
                                        No
                                    @endif
                                    </li>
                                    <li class="list-group-item"><h4>Event description: </h4>{{ $event->description }}</li>
                                  </ul>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h3>Event image</h3>
                            @if($event->images !=[])
                            <div class="card-image-main" style="
                            background-image:url('{{ asset('images') }}/{{$event->images->name}}');
                            background-size:cover;
                            background-repeat:no-repeat;
                            background-position:center;
                            height:350px;"></div>
                            @else
                            <h3 class="alert alert-info" role="alert">No image yet.</h3>
                            @endif
                        </div>
                    </div>
                    <div class="row row-eq-height mt-3">
                        <div class="col-12 col-lg-6">
                            <h3>
                                Messages for event
                                <small class="text-muted">Check for changes</small>
                              </h3>
                              @if ($messages->isNotEmpty())
                              {{ $messages->links() }}
                              @foreach ($messages as $message)
                              <div class="card mb-2">
                                  <h5 class="card-header">{{$message->title}}</h5>
                                  <div class="card-body">
                                    <p class="card-text">{{$message->content}}</p>
                                  </div>
                                  <div class="card-footer text-muted">
                                      Written: {{$message->created_at}}
                                  </div>
                              </div>
                              @endforeach
                              {{ $messages->links() }}
                              @else
                              <h3 class="alert alert-info" role="alert">No messages yet.</h3>
                              @endif
                        </div>
                        <div class="col-12 col-lg-6">
                            @map([
                                'lat' => $event->latitude,
                                'lng' => $event->longitude,
                                'zoom' => 12,
                                'markers' => [
                                    [
                                        'title' => 'Event',
                                        'lat' => $event->latitude,
                                        'lng' => $event->longitude,
                                    ],
                                ],
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
