<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\pddBuffer;
use Response;

class pddBufferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $pddBuffer = pddBuffer::all();
        return Response::json($pddBuffer,200);
    }

    public function index(Request $request)
    {
        // $pddBuffer = pddBuffer::all();
        // return Response::json($pddBuffer,200);
        $pddBuffer = pddBuffer::all();
        if ($request->get('search')) {
            $pddBuffer = pddBuffer::where("idBuffer", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $pddBuffer = pddBuffer::paginate(5);
        }
        return Response::json($pddBuffer,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pddBuffer = new pddBuffer;
        // $pddBuffer->idBuffer = $request->idBuffer;
        $pddBuffer->namaPdd = $request->namaPdd;
        $pddBuffer->tglBuffer = $request->tglBuffer;
        $pddBuffer->remoteAddress = $request->remoteAddress;
        $pddBuffer->fileBuffer = $request->fileBuffer;
        $pddBuffer->indexAwal = $request->indexAwal;
        $pddBuffer->indexAkhir = $request->indexAkhir;
        $pddBuffer->jmlDataBuffer = $request->jmlDataBuffer;
        $pddBuffer->indexBuffer = $request->indexBuffer;
        $pddBuffer->totalLogAkhir = $request->totalLogAkhir;
        $pddBuffer->tglIntegrasi1 = $request->tglIntegrasi1;
        $pddBuffer->tglIntegrasi2 = $request->tglIntegrasi2;
        $pddBuffer->totalIntegrasi = $request->totalIntegrasi;
        $pddBuffer->caraKirim = $request->caraKirim;
        $pddBuffer->caraIntegrasi = $request->caraIntegrasi;
        $pddBuffer->statusIntegrasi = $request->statusIntegrasi;
        $pddBuffer->ketBuffer = $request->ketBuffer;
        $success=$pddBuffer->save();

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
        $pddBuffer = pddBuffer::find($primaryKey);
        if (is_null($pddBuffer)) {
            return Response::json("not found",404);
        }
        return Response::json($pddBuffer,200);
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
        $pddBuffer = pddBuffer::find($primaryKey);
        $pddBuffer->idBuffer = $request->input('idBuffer');
        $pddBuffer->namaPdd = $request->input('namaPdd');
        $pddBuffer->tglBuffer = $request->input('tglBuffer');
        $pddBuffer->remoteAddress = $request->input('remoteAddress');
        $pddBuffer->fileBuffer = $request->input('fileBuffer');
        $pddBuffer->indexAwal = $request->input('indexAwal');
        $pddBuffer->indexAkhir = $request->input('indexAkhir');
        $pddBuffer->jmlDataBuffer = $request->input('jmlDataBuffer');
        $pddBuffer->indexBuffer = $request->input('indexBuffer');
        $pddBuffer->totalLogAkhir = $request->input('totalLogAkhir');
        $pddBuffer->tglIntegrasi1 = $request->input('tglIntegrasi1');
        $pddBuffer->tglIntegrasi2 = $request->input('tglIntegrasi2');
        $pddBuffer->totalIntegrasi = $request->input('totalIntegrasi');
        $pddBuffer->caraKirim = $request->input('caraKirim');
        $pddBuffer->caraIntegrasi = $request->input('caraIntegrasi');
        $pddBuffer->statusIntegrasi = $request->input('statusIntegrasi');
        $pddBuffer->ketBuffer = $request->ketBuffer;
        $success=$pddBuffer->save();

        if (!$success) {
            return Response::json("error saving",500);
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
        $pddBuffer = pddBuffer::find($primaryKey);
        if (is_null($pddBuffer)) {
            return Response::json("not found",500);
        }

        $pddBuffer->isDeleted = 1;
        $success=$pddBuffer->save();
        
        if (!$success) {
            return Response::json("error",500);
        }        
        return Response::json("success",200);
    }
}
