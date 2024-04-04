<div class="modal fade" id="remarks{{ $ticket->UID_HEADER }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form  action="{{url('remarks/'.$ticket->UID_HEADER)}}" onsubmit='show();' method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Remarks</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Remarks</label>
                            <textarea  name="remarks" class="form-control " rows="10" required>{{$ticket->Comment}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Status</label>
                            <select class='form-control' name='status'>
                                <option value='' @if($ticket->Status == "") selected @endif>Pending</option>
                                <option value='For Signature' @if($ticket->Status == "For Signature") selected @endif>For Signature</option>
                                <option value='Ready for Pick Up' @if($ticket->Status == "Ready for Pick Up") selected @endif>Ready for Pick Up</option>
                                <option value='Done' @if($ticket->Status == "Done") selected @endif>Done</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>