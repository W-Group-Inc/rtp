<?php

namespace App\Http\Controllers;
use SheetDB\SheetDB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $sheetdb = new SheetDB('83gyd54xkvg9t');
        $tickets = collect($sheetdb->get());
        $tickets = $tickets->sortByDesc('UID_HEADER');
        // $tickets_for_signature = collect($sheetdb->search(['Status'=>"For Signature"]));
        // $tickets_ready_for_pickup = collect($sheetdb->search(['Status'=>"Ready for Pick Up"]));
        // dd($tickets);
        return view('welcome',array(
            'tickets' => $tickets,
            // 'tickets_for_signature' => $tickets_for_signature,
            // 'tickets_ready_for_pickup' => $tickets_ready_for_pickup,
            
        ));
    }
    public function done()
    {
        $sheetdb = new SheetDB('83gyd54xkvg9t');
        $tickets = collect($sheetdb->get());
        $tickets = $tickets->sortByDesc('UID_HEADER');
        // $tickets_for_signature = collect($sheetdb->search(['Status'=>"For Signature"]));
        // $tickets_ready_for_pickup = collect($sheetdb->search(['Status'=>"Ready for Pick Up"]));
        // dd($tickets);
        return view('done',array(
            'tickets' => $tickets,
            // 'tickets_for_signature' => $tickets_for_signature,
            // 'tickets_ready_for_pickup' => $tickets_ready_for_pickup,
            
        ));
    }

    public function update(Request $request,$id)
    {
        $sheetdb = new SheetDB('83gyd54xkvg9t');
        $tickets = $sheetdb->update('UID_HEADER',$id,['Received By'=>$request->name]);
        // dd($tickets);
        Alert::success('Successfully Updated')->persistent('Dismiss');
        return back();
    }
    public function remarks(Request $request,$id)
    {
        // dd($request->all());
        $sheetdb = new SheetDB('83gyd54xkvg9t');
        $tickets = $sheetdb->update('UID_HEADER',$id,['Comment'=>$request->remarks]);
        $tickets = $sheetdb->update('UID_HEADER',$id,['Status'=>$request->status]);
        // dd($tickets);
        Alert::success('Successfully Updated')->persistent('Dismiss');
        return back();
    }
    public function checkStatus(Request $request)
    {
        $result;
        if($request->id)
        {
            $sheetdb = new SheetDB('83gyd54xkvg9t');
            $ticket = collect($sheetdb->search(['UID_HEADER'=>$request->id]));
            $ticket = $ticket->where('Email Address',$request->email)->first();
            $result=$ticket;
            if($ticket == null)
            {
                $result = "No Data Found";
            }

        }
        return view('checkStatus',array(
            'result' => $result,
            // 'tickets_for_signature' => $tickets_for_signature,
            // 'tickets_ready_for_pickup' => $tickets_ready_for_pickup,
            
        ));

    }
}
