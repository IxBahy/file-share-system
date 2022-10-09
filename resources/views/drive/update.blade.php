@extends('layouts.app')

@section('content')
    @if (Session::has('done'))
        <div class="alert alert-success mx-auto w-50">
            {{ Session::get('done') }}
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger mx-auto w-50">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif


    <div class="container">

        <div class="row">

            <div class="card col-md-6 mx-auto">

                <div class="card-body">

                    <form action="{{ route('drive.update', $drive->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            <label for="">Title</label>
                            <input type="text" name="title" value="{{ $drive->title }}"class="form-control"
                                id="">

                        </div><!-- title -->


                        <div class="form-group">

                            <label for="">description</label>
                            <input type="text" name="description" value="{{ $drive->description }}"class="form-control"
                                id="">

                        </div><!-- description-->


                        <div class="form-group">

                            <label for="">file :{{ $drive->file }}</label>
                            <input type="file" name="fileInput" class="form-control" id="">

                        </div><!-- file -->

                        <button type="submit" class="btn btn-primary">Send</button>

                    </form>

                </div><!-- card-body -->

            </div><!-- card -->

        </div><!-- row -->

    </div><!-- container -->
@endsection
