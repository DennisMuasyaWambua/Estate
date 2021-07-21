@extends('caretaker.caretakerTemplate')
    @section('content')
    <div class="update-form">
       <form action="{{route('Dashboard.updateOccupant',$person->id)}}" method="POST">
           @csrf
           <input type="hidden" name="id" value="{{$person->id}}">
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" value="{{$person->name}}">
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" value="{{$person->email}}">
                </div>
                <div class="col">
                    <label class="form-label" for="phone">Phone</label>
                    <input type="text" name="phone" value="{{$person->phone}}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="estate">Estate</label>
                <input type="text" name="estate" value="{{$person->estate}}">
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label" for="blockNumber">Block Number</label>
                    <input type="text" name="blockNumber" value="{{$person->blockNumber}}">
                </div>
                <div class="col">
                    <label class="form-label" for="flat-number">Flat Number</label>
                    <input type="text" name="flatNumber" value="{{$person->flatNumber}}">
                </div>
            </div>
            <Button type="submit" class="btn btn-primary">Update</Button>
            <a href="{{route('Dashboard.allOccupants')}}" class="btn- btn-sm btn-secondary">cancel</a>
       </form>
    </div>
    @endsection