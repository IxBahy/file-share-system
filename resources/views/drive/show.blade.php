@extends('layouts.app')

@section('content')
    @if (Session::has('done'))
        <div class="alert alert-success mx-auto w-50">
            {{ Session::get('done') }}
        </div>
    @endif





    <div class="container">

        <div class="row">
            <div class="card mx-auto text-center w-50" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title">{{ $drive->title }}</h3>
                    <p class="card-text">{{ $drive->description }}</p>
                    <a href="{{ route('drive.download', $drive->id) }}" class="btn btn-primary">download</a>
                </div>
            </div>

        </div><!-- row -->

    </div><!-- container -->
@endsection
