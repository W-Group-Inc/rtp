@extends('layouts.header')
@section('css')

<link href="{{ asset('/inside/login_css/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="wrapper wrapper-content ">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <form  action="{{url('check-status')}}" onsubmit='show()' method="GET">
                    <h2>
                       Check Status <span class="text-navy"><i>(RTP)</i></span>
                    </h2>
                    <small>Please input your Ticket Number and Email</small>
                    <div class="row">
                        <div class="col-md-2"><input type="text" name='id' placeholder="Ticket #" class="form-control" required></div>
                        <div class="col-md-3"><input type="text" name='email' placeholder="Email" class="form-control" required></div>
                        <div class="col-md-4"><button class="btn btn-primary" type="submit" id="button-addon2">Search</button></div>
                    </div>
                    </form>
                    <div class="hr-line-dashed"></div>
                    <div class="search-result">
                        @if(($result == null) ||($result=="No Data Found") )
                        <h3><a href="#">No Data Found</h3>
                        @else
                            <h2>Ticket #: <b>{{$result->UID_HEADER}}</b> &nbsp;</h2>
                            <b>Status:  @if($result->Status == "")
                            <span class="label label-warning">Pending</span>
                            @else
                            <span class="label label-info">{{$result->Status}}</span>
                            @endif</b>
                            <h4>
                                Requested by: {{($result->{'Requested by'})}} <br>
                                Company: {{($result->Company)}} <br>
                                Department: {{($result->Department)}} <br>
                                Payable To: {{($result->{'Payable To'})}} <br>
                                Date Requested: {{date('M d, Y h:i A',strtotime(($result->{'Timestamp'})))}} <br>
                                Payable Amount: {{($result->{'Payable Amount'})}} <br>
                                Details of Payment: {{($result->{'Details of Payment'})}} <br>
                            </h4>
                            <div class="hr-line-dashed"></div>
                            <h2>Attachments</h2>
                            <h4>
                                @php
                                    $attachments = explode(", ",$result->{'Upload Documents'});
                                @endphp
                                Scanned Copy: <br>1. <a href='{{($result->{'Upload Scanned Copy'})}}' target='_blank'><i class='fa fa-file'></i></a> <br>
                                Supporting Documents: <br>@foreach($attachments as $key => $attachment)
                                {{$key+1}}. <a href='{{$attachment}}' target='_blank'><i class='fa fa-file'></i></a> <br>
                            @endforeach
                            </h4>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    
                    
                </div>
            </div>
        </div>
</div>
</div>
@endsection
@section('footer')
<script src="{{ asset('/inside/login_css/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('/inside/login_css/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script>
$(document).ready(function(){

$('.cat').chosen({width: "100%"});
$('.tables').DataTable({
    pageLength: -1,
    paginate: false,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        {extend: 'csv', title: 'RTP'},
        {extend: 'excel', title: 'RTP'}
    ]

});

});
</script>

@endsection

