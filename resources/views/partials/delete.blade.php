@extends('caretaker.caretakerTemplate')
    @section('content')
    <div class="update-form">
       <form action="{{route('Dashboard.deleteOccupant',$delete->id)}}" method="POST">
           @csrf
            <p>Are you sure you want to delete {{$delete->name}}</p>
            <Button type="submit" class="btn btn-danger">Danger</Button>
            <a href="{{route('Dashboard.allOccupants')}}" class="btn- btn-sm btn-secondary">cancel</a>
       </form>
    </div>
    @endsection