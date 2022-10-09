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
                            <th>ID</th>
                            <th>Title</th>
                            <th>Action</th>
                            @forelse ($files as $file)
                                @if ($file->authorID == Auth::user()->id)
                        <tr>
                            <th>{{ $file->id }}</th>
                            <th>{{ $file->title }}</th>
                            <td>
                                <div class="dropdown text-center ">
                                    <i type="button" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false" v-pre
                                        class="fa-solid fa-ellipsis-vertical"></i>
                                    <div class="dropdown-menu" style="min-width:40px ;">

                                        <a class="dropdown-item text-primary" href="{{ route('drive.show', $file->id) }}"><i
                                                class="fa-solid fa-eye"></i></a>

                                        <a class="dropdown-item text-primary" href="{{ route('drive.edit', $file->id) }}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>

                                        <a class="dropdown-item text-danger"
                                            href="{{ route('drive.destroy', $file->id) }}"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                        {{-- if private --}}
                                        @if ($file->private == 1)
                                            <a class="dropdown-item text-primary"
                                                href="{{ route('drive.share', $file->id) }}"><i
                                                    class="fa-solid fa-lock"></i></a>
                                        @endif
                                        {{-- if its puplic --}}
                                        @if ($file->private == 0)
                                            <a class="dropdown-item text-danger"
                                                href="{{ route('drive.share', $file->id) }}"><i
                                                    class="fa-solid fa-lock-open"></i></a>
                                        @endif
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
