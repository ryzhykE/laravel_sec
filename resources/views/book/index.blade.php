@extends('app')

@section('pagetitle')
    Book 
@stop

@section('content')
    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <td>Id</td>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
            <td>List</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>
                        @if ($book->user_id)
                            <a class="btn btn-small btn-default" href="{{ URL::to('users/' . $book->user->id) }}">{{$book->user->firstname}} {{$book->user->lastname}}</a>  
                        @endif
                    </td>
                    <td width="235px">
                        <a class="btn btn-small btn-info" href="{{ URL::to('books/'.$book->id) }}">Details</a>
                        <a class="btn btn-small btn-success" href="{{ URL::to('books/'.$book->id.'/edit') }}">Update</a>

                        {!! Form::open(['url' => 'books/'.$book->id, 'class' => 'pull-right']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-warning']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="right">
        {{ $books->render() }}
    </div>

@endsection