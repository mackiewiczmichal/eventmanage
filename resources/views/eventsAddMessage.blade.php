@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Event </div>

                <div class="card-body">

                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <h5 class="card-header">Featured</h5>
                                <div class="card-body">
                                  <h5 class="card-title">Event update</h5>
                                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
