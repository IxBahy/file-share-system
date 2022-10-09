@extends('layouts.app')

@section('content')
    @if (Session::has('done'))
        <div class="alert alert-success mx-auto w-50">
            {{ Session::get('done') }}
        </div>
    @endif





    <div class="container">

        <div class="row">
            <div class="card w-50 mx-auto">
                <div class="card-body ">


                    <table class="table  text-center ">

                        <tr>

                            <th>Title</th>
                            <th>Action</th>
                            @forelse ($files as $file)
                                @if ($file->private == 0)
                        <tr>

                            <th>{{ $file->title }}</th>
                            <td>
                                <div class="dropdown text-center ">
                                    <i type="button" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false" v-pre
                                        class="fa-solid fa-ellipsis-vertical"></i>
                                    <div class="dropdown-menu" style="min-width:40px ;">

                                        <a class="dropdown-item text-primary" href="{{ route('drive.show', $file->id) }}"><i
                                                class="fa-solid fa-eye"></i></a>

                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endif
                    @empty
                        <div class="alert alert-danger mx-auto w-50">
                            Nothing uploded yet
                        </div>
                        @endforelse
                        </tr>


                    </table><!-- table -->

                </div><!-- card-body -->

            </div><!-- card -->

        </div><!-- row -->

    </div><!-- container -->
@endsection
