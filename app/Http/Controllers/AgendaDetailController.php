<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AgendaDetail;
use Response;

class AgendaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getAll()
    {
        $AgendaDetail = AgendaDetail::all();
        return Response::json($AgendaDetail,200);
    }

    public function index(Request $request)
    {
        // $agendaDetail = AgendaDetail::all();
        // return Response::json($agendaDetail,200);
        $agendaDetail = AgendaDetail::all();
        if ($request->get('search')) {
            $agendaDetail = AgendaDetail::where("idDetilAgenda", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $agendaDetail = AgendaDetail::paginate(5);
        }
        return Response::json($agendaDetail,200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agendaDetail = new agendaDetail;
        // $agendaDetail->idDetilAgenda = $request->idDetilAgenda;
        $agendaDetail->fk_rekapAgenda = $request->fk_rekapAgenda;
        $agendaDetail->detilAgenda = $request->detilAgenda;
        // $agendaDetail->screenshot = $request->screenshot;
        
        //upload screenshoot
        $file = $request->screenshot('screenshot');
        $destination_path = 'uploads/';
        $filename   =   str_random(6).'_'.$file->getClientOriginalName();
        $file->move($destination_path, $filename);

        //saving screenshoot data into database
        $agendaDetail->screenshot = $destination_path.$filename;
        $agendaDetail->isDeleted = $request->isDeleted;
        $agendaDetail->createdBy = $request->createdBy;
        $agendaDetail->createdDate = $request->createdDate;
        $agendaDetail->modifiedBy = $request->modifiedBy;
        $agendaDetail->modifiedDate = $request->modifiedDate;
        $success=$agendaDetail->save();

        if (!$success) {
            return Response::json("error saving",500);
        }
        return Response::json("success",200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($primaryKey)
    {
        $agendaDetail = AgendaDetail::find($primaryKey);
        if (is_null($agendaDetail)) {
            return Response::json("not found",404);
        }
        return Response::json($agendaDetail,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $primaryKey)
    {
        $agendaDetail = AgendaDetail::find($primaryKey);

        $agendaDetail->idDetilAgenda = $request->input('idDetilAgenda');
        $agendaDetail->fk_rekapAgenda = $request->input('fk_rekapAgenda');
        $agendaDetail->detilAgenda = $request->input('detilAgenda');
        // $agendaDetail->screenshot = $request->input('screenshot');

        // if user choose a file, replace the old one //
        if ($request->hasFile('screenshot')) {
            $file = $request->screenshot('screenshot');
            $destination_path = 'uploads/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $file->move($destination_path,$filename);
            $agendaDetail->screenshot = $destination_path.$filename;
        }

        $agendaDetail->isDeleted = $request->input('isDeleted');
        $agendaDetail->createdBy = $request->input('createdBy');
        $agendaDetail->createdDate = $request->input('createdDate');
        $agendaDetail->modifiedBy = $request->input('createdBy');
        $agendaDetail->modifiedDate = $request->input('modifiedDate');
        $success=$agendaDetail->save();

        if (!$success) {
            return Response::json("error updating",500);
        }
        return Response::json("success",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($primaryKey)
    {
        $agendaDetail = AgendaDetail::find($primaryKey);
        if (is_null($agendaDetail)) {
            return Response::json("not found",500);
        }

        $agendaDetail->isDeleted = 1;
        $success=$agendaDetail->save();
        
        if (!$success) {
            return Response::json("error",500);
        }        
        return Response::json("success",200);
    }
}
