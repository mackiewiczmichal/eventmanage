@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Edit event main page') }}</div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-link active" id="nav-event-details-tab" data-toggle="tab" href="#nav-event-details" role="tab" aria-controls="nav-event-details" aria-selected="true">Event details</a>
                          <a class="nav-link" id="nav-event-messages-tab" data-toggle="tab" href="#nav-event-messages" role="tab" aria-controls="nav-event-messages" aria-selected="false">Participants</a>
                          <a class="nav-link" id="nav-event-participants-tab" data-toggle="tab" href="#nav-event-participants" role="tab" aria-controls="nav-event-participants" aria-selected="false">Messages</a>
                          <a class="nav-link" id="nav-event-images-tab" data-toggle="tab" href="#nav-event-images" role="tab" aria-controls="nav-event-images" aria-selected="false">Images</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-event-details" role="tabpanel" aria-labelledby="nav-event-details">
                            @csrf
                                    <div class="col-12">
                                    <form class="my-3" action="/dashboard/event/{{$event->id}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$event->id}}">
                                            <div class="form-group">
                                              <label for="eventTitle">Event title</label>
                                            <input type="text" class="form-control" id="eventTitle" name="title" value="{{$event->title}}">
                                            </div>
                                            <div class="form-group">
                                              <label for="eventDesc">Event description</label>
                                              <textarea class="form-control" id="eventDesc" name="description" >{{$event->description}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Event start date</label>
                                                        <input type="date" class="form-control" name="event_start_date" value="{{$event->event_start_date}}">
                                                    </div>
                                                    <div class="col">
                                                        <label>Event end date</label>
                                                        <input type="date" class="form-control" name="event_end_date" value="{{$event->event_end_date}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="eventParticipants">Maxium participants</label>
                                                <input type="number" class="form-control" id="eventParticipants" name="max_participants" value="{{$event->max_participants}}">
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="hidden" name="for_adults" value="0">
                                                <input type="checkbox" class="form-check-input" id="eventForAdults" name="for_adults" value="1"
                                                @if ($event->for_adults == true)
                                                checked
                                                 @endif>
                                              <label class="form-check-label" for="eventForAdults">Adults only?</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="eventParticipants">Latitude value </label>
                                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="First value" value="{{$event->latitude}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="eventParticipants">Longitude value</label>
                                                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Second value" value="{{$event->longitude}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>

                                            <a href="/event-delete/{{$event->id}}" type="submit" class="btn btn-danger"
                                                onclick="event.preventDefault();document.getElementById('delete-form').submit();">Delete</a>
                                          </form>
                                        <form id="delete-form" action="/dashboard/events/{{$event->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                        </div>
                        <div class="tab-pane fade" id="nav-event-messages" role="tabpanel" aria-labelledby="nav-event-messages">
                            <div class="col-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Uczestnik</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Wiek</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $participant)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{$participant->users_name}}</td>
                                            <td>{{$participant->users_email}}</td>
                                            <td>{{$participant->users_age}}</td>
                                          </tr>
                                        @endforeach

                                    </tbody>
                                  </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-event-participants" role="tabpanel" aria-labelledby="nav-event-participants">
                            <div class="row">
                                <div class="col-12 col-lg-6">
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
                                </div>
                                <div class="col-12 col-lg-6">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div class="card">
                                        <h5 class="card-header">Event message</h5>
                                        <div class="card-body">
                                            <form class="my-3" action="/dashboard/events/new-message/{{$event->id}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="messageTitle">Message title</label>
                                                  <input type="text" class="form-control" id="messageTitle" name="title" value="{{old('title')}}">
                                                  </div>
                                                <div class="form-group">
                                                    <label for="messageContent">Message description</label>
                                                    <textarea class="form-control" id="messageContent" name="content">{{old('content')}}</textarea>
                                                  </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                      </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="nav-event-images" role="tabpanel" aria-labelledby="nav-event-images">
                            <div class="col-12">
                                <div class="row d-block">
                                    <h3 class="text-center">Your featured image</h3>
                                    @if ($images)
                                    <img src="{{ asset('images') }}/{{$images->name}}" class="img-fluid mx-auto d-block" style="max-width:300px;"alt="Responsive image">
                                    @endif
                                </div>


                                <form method="post" action="/dashboard/add-images/{{$event->id}}" enctype="multipart/form-data">
                                        @csrf

                                        {{-- <div class=" input-group imagefile control-group lst increment" >
                                          <input type="file" name="imageFile[]" class="myfrm form-control">
                                          <div class="input-group-btn">
                                            <button class="btn btn-success add-file" type="button"> <i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                          </div>
                                        </div>
                                        <div class=" clone hide">
                                          <div class="imagefile control-group lst input-group" style="margin-top:10px">
                                            <input type="file" name="imageFile[]" class="myfrm form-control">
                                            <div class="input-group-btn">
                                              <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                            </div>
                                          </div>
                                        </div> --}}
                                        {{-- <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control"/>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="image">Choose image</label>
                                            <input type="file" name="imageFile" class="form-control" onchange="previewImage(this)"/>
                                            <img id="imgPreview" alt="Image preview" style="max-width:300px;">
                                        </div>



                                        <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>

                                    </form>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
      $(".add-file").click(function(){
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){
          $(this).parents(".imagefile").remove();
      });
    });
</script> --}}
<script>
    function previewImage(input){
        var image=$("input[type=file]").get(0).files[0];
        if(image){
            var reader = new FileReader();
            reader.onload = function(){
                $('#imgPreview').attr('src',reader.result)
            }
            reader.readAsDataURL(image);
        }
    }
</script>
@endsection
