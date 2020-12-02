@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add event') }}</div>

                <div class="card-body">

                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <form class="my-3" action="/dashboard/events/new" method="POST">
                                    @csrf
                                    <div class="form-group">
                                      <label for="eventTitle">Event title</label>
                                    <input type="text" class="form-control" id="eventTitle" name="title" value="{{old('title')}}">
                                    </div>
                                    <div class="form-group">
                                      <label for="eventDesc">Event description</label>
                                      <textarea class="form-control" id="eventDesc" name="description">{{old('description')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="eventDesc">Event start date</label>
                                        <input type="date" class="form-control" name="event_start_date" value="{{old('event_start_date')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="eventDesc">Event end date</label>
                                        <input type="date" class="form-control" name="event_end_date" value="{{old('event_end_date')}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label for="eventParticipants">Latitude value </label>
                                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="First value" value="{{old('latitude')}}">
                                            </div>
                                            <div class="col">
                                                <label for="eventParticipants">Longitude value</label>
                                                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Second value" value="{{old('longitude')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="eventParticipants">Maxium participants</label>
                                        <input type="number" class="form-control" id="eventParticipants" name="max_participants" value="{{old('max_participants')}}">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="hidden" name="for_adults" value="0">
                                      <input type="checkbox" class="form-check-input" id="eventForAdults" name="for_adults" value="1">
                                      <label class="form-check-label" for="eventForAdults">Adults only?</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
