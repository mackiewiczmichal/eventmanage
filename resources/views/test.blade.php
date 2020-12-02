@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Testing page') }}</div>

                <div class="card-body">

                    <form method="post" action="/dashboard/test" enctype="multipart/form-data">
                        @csrf

                        <div class=" input-group imagefile control-group lst increment" >
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
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".add-file").click(function(){
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){
          $(this).parents(".imagefile").remove();
      });
    });
</script>
@endsection
