<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Occupants</title>

    
</head>
<body>
     <div id="table">
                                
                                <table class="table">
                                    <thead class="table-dark">
                                        <a class="btn btn-sm btn-success"role="button"style="float:right;margin-bottom:5px;padding:5px;"data-bs-toggle="modal"data-bs-target="#addOccupant">create occupant</a>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">name</th>
                                            <th scope="col">email</th>
                                            <th scope="col">phone</th>
                                            <th scope="col">estate</th>
                                            <th scope="col">block number</th>
                                            <th scope="col">flat number</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-dark">
                                            
                                            @foreach($occupant as $Occupant)
                                            
                                            <tr>
                                                <td>{{$Occupant['id']}}</td>
                                                <td>{{$Occupant['name']}}</td>
                                                <td>{{$Occupant['email']}}</td>
                                                <td>{{$Occupant['phone']}}</td>
                                                <td>{{$Occupant['estate']}}</td>
                                                <td>{{$Occupant['blockNumber']}}</td>
                                                <td>{{$Occupant['flatNumber']}}</td>
                                                <td>
                                                    <a id="updateButton"href="{{route('Dashboard.editOccupant',$Occupant->id)}}"value="{{$Occupant->id}}"class="btn btn-sm btn-primary" data-id="'.$Occupant['id'].'"type="button" >Update</a>
                                                    <!-- <a id="deleteButton"href="{{route('Dashboard.editOccupant',$Occupant->id)}}" class="btn btn-sm btn-danger" type="button"value="{{$Occupant->id}}" >Delete</a> -->
                                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-occupant-form-{{$Occupant->id}}').submit()">Delete</button>
                                                    <form id="delete-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.deleteOccupant',$Occupant->id)}}"method="POST" style="display:none;">@csrf</form>
                                                </td>
                                                <!-- update modal -->
                                                <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">update</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                   <!-- this is the update form modal -->
                                                                   <div class="update-person">
                                                                <form id="update-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.updateOccupant',$Occupant->id)}}" method="POST">
                                                                    @csrf
                                                                    <div class="update-person">
                                                                        <div class="form-group">
                                                                                <input id="occupant-{{$Occupant->id}}" hidden="true" value="{{$Occupant->id}}" name="Occupantid"/>
                                                                                <input hidden="true" value="{{auth()->user()->id}}" name="caretakerId">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input id="occupant-name-{{$Occupant->id}}"   class="form-control" value="{{$Occupant->name}}" type="text" name="name" placeholder="Occupant's name" autofocus>
                                                                            <span class="text-danger error-text name_error"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            <input id="occupant-email-{{$Occupant->id}}"  class="form-control"value="{{$Occupant->email}}" type="email" name="email" placeholder="email" >
                                                                            <span class="text-danger error-text email_error"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="phone">Phone</label>
                                                                            <input id="occupant-phone-{{$Occupant->id}}" class="form-control" value="{{$Occupant->phone}}" type="number" name="phone" placeholder="phone" >
                                                                            <span class="text-danger error-text phone_error"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="estate">Estate</label>
                                                                            <input id="occupant-estate-{{$Occupant->id}}"  class="form-control" value="{{$Occupant->estate}}" type="text" name="estate" placeholder="estate" >
                                                                            <span class="text-danger error-text estate_error"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="blockNumber">Block Number</label>
                                                                            <input id="occupant-blockNumber-{{$Occupant->id}}"  class="form-control" value="{{$Occupant->blockNumber}}"type="text" name="blockNumber" placeholder="block number" >
                                                                            <span class="text-danger error-text blockNumber_error"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="flatNumber">Flat Number</label>
                                                                            <input id="occupant-flatNumber-{{$Occupant->id}}"  class="form-control" value="{{$Occupant->flatNumber}}" type="text" name="flatNumber" placeholder="flat number" >
                                                                            <span class="text-danger error-text flatNumber_error"></span>
                                                                        </div>
                                                                        <button  style="float:right; " class="btn btn-sm btn-primary" type="submit">Update</button>
                                                                </form>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                                        
                                                                <!-- <button type="button" class="btn btn-sm btn-danger"onclick="event.preventDefault();document.getElementById('delete-occupant-form-{{$Occupant->id}}').submit()">Delete</button>
                                                                <form id="delete-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.deleteOccupant',$Occupant->id)}}"method="POST" style="display:none;">@csrf</form> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                    
                                                <!-- delete modal -->
                                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <P>Are you sure that you want to delete <span class="person"></span> </P>    
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-sm btn-danger" type="button" href="{{route('Dashboard.deleteOccupant',$Occupant->id)}}">Delete</a>
                                                                <!-- <button type="button" class="btn btn-sm btn-danger"onclick="event.preventDefault();document.getElementById('delete-occupant-form-{{$Occupant->id}}').submit()">Delete</button>
                                                                <form id="delete-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.deleteOccupant',$Occupant->id)}}"method="POST" style="display:none;">@csrf</form> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </tr>
                                        @endforeach
                                        <!-- modals -->
                                                <!-- update modal -->
                                               
                                                <!-- Delete Moodal -->
                                               
                                                                             
                                    </tbody>
                                    
                                </table>
                                
                                {{$occupant->links()}}
                           
                        </div>
                    </div>
</div>

                </body>
</html>