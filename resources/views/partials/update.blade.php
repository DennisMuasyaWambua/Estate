@extends('caretaker.caretakerTemplate')
    @section('content')
    <div class="update-form">
       <form action="{{route('Dashboard.updateOccupant',$Occupant->id)}}" method="POST">
           @csrf
           <input type="hidden" name="id" value="{{$Occupant->id}}">
            <div class="form-group-update">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" value="{{$Occupant->name}}">
            </div>
            <div class="form-group-update">
                <div class="col">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" value="{{$Occupant->email}}">
                </div>
                <div class="form-group-update">
                    <label class="form-label" for="phone">Phone</label>
                    <input type="text" name="phone" value="{{$Occupant->phone}}">
                </div>
            </div>
            <div class="form-group-update">
                <label class="form-label" for="estate">Estate</label>
                <input type="text" name="estate" value="{{$Occupant->estate}}">
            </div>
            <div class="form-group-update">
                    <label class="form-label" for="blockNumber">Block Number</label>
                    <input type="text" name="blockNumber" value="{{$Occupant->blockNumber}}">
            </div>
            <div class="form-group-update">
                <label class="form-label" for="flat-number">Flat Number</label>
                <input type="text" name="flatNumber" value="{{$Occupant->flatNumber}}">
            </div>
            
            <Button type="submit" class="btn btn-primary">Update</Button>
            <a href="/Dashboard" class="btn- btn-sm btn-secondary">cancel</a>
       </form>
    </div>
    @endsection