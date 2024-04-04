@extends('layouts.header')
@section('css')

<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="wrapper wrapper-content ">
    <div class="row mb-5">
        <div class="col-lg-3 text-center mb-5">
            <div class="row">
                <div class="col-lg-6 text-center">
                    <div class="ibox-title">
                        <div class="ibox-tools text-center">
                            <span class="label label-info pull-right">as of {{date('M. d, Y')}}</span>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins text-danger">{{count($tickets->where('Status','!=','Done'))}}</h1>
                        <small>Total Open Tickets</small>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="ibox-title">
                        <div class="ibox-tools text-center">
                            <span class="label label-info pull-right">as of {{date('M. d, Y')}}</span>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><a href='{{url('done-tickets')}}' target="_blank">{{count($tickets->where('Status','Done'))}}</a></h1>
                        {{-- <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div> --}}
                        <small>Done Tickets</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class='row mt-2'>
        <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tickets </h5> <span class="label label-info pull-right">as of {{date('M Y')}}</span>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id='table' class="table table-striped table-bordered table-hover tables">
                            <thead>
                                <tr>
                                    <th>Ticket Number</th>
                                    <th>Requestor</th>
                                    <th>Company</th>
                                    <th>Department</th>
                                    <th>Payable To</th>
                                    <th>Date Requested</th>
                                    <th>Payable Amount</th>
                                    <th>Details of Payment</th>
                                    <th>Signed Copy</th>
                                    <th>Supporting Document</th>
                                    <th>Received By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets->where('Status','!=','Done') as $ticket)
                                @php
                                    $attachments = explode(", ",$ticket->{'Upload Documents'});
                                @endphp
                                <tr>
                                    <td>{{$ticket->UID_HEADER}}</td>
                                    <td>{{($ticket->{'Requested by'})}}</td>
                                    <td>{{$ticket->Company}}</td>
                                    <td>{{$ticket->Department}}</td>
                                    <td>{{($ticket->{'Payable To'})}}</td>
                                    <td>{{date('M d, Y h:i A',strtotime(($ticket->{'Timestamp'})))}}</td>
                                    <td>{{($ticket->{'Payable Amount'})}}</td>
                                    <td>{{($ticket->{'Details of Payment'})}}</td>
                                    <td><a href='{{($ticket->{'Upload Scanned Copy'})}}' target='_blank'><i class='fa fa-file'></i></a></td>
                                    <td>
                                        @foreach($attachments as $key => $attachment)
                                            {{$key+1}}. <a href='{{$attachment}}' target='_blank'><i class='fa fa-file'></i></a> <br>
                                        @endforeach
                                    </td>
                                    <td>
                                          {{($ticket->{'Received By'})}}
                                    </td>
                                    <td>
                                        @if($ticket->Status == "")
                                        <span class="label label-warning">Pending</span>
                                        @else
                                        <span class="label label-info">{{$ticket->Status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#assign_ap{{ $ticket->UID_HEADER }}" title='Assign AP'><i class="fa fa-paste"></i></button>
                                        {{-- <button class="btn btn-warning btn-sm" type="button" title='Change Status'><i class="fa fa-cog"></i></button> --}}
                                        <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#remarks{{ $ticket->UID_HEADER }}" title='Comments'><i class="fa fa-comment-o"></i></button>
                                        
                                    </td>
                                </tr>
                                
                                @include('assign_ap')
                                @include('remarks')
                                @endforeach
                               
                            </tbody>
                        </table>
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

