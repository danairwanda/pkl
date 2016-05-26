<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BarangInven;
use Response;

class BarangInvenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getAll()
    {
        $BarangInven = BarangInven::all();
        return Response::json($BarangInven,200);
    }

    public function index(Request $request)
    {
        // $barangInven = BarangInven::all();
        // return Response::json($barangInven,200);
        $barangInven = BarangInven::all();
        if ($request->get('search')) {
            $barangInven = BarangInven::where("namaBarang", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $barangInven = BarangInven::paginate(5);
        }
        return Response::json($barangInven,200); 
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barangInven = new BarangInven;
        // $barangInven->idBarang = $request->idBarang;
        $barangInven->kodeBarang = $request->kodeBarang;
        $barangInven->namaBarang = $request->namaBarang;
        $barangInven->keterangan = $request->keterangan;
        $barangInven->isDeleted = $request->isDeleted;
        $barangInven->createdBy = $request->createdBy;
        $barangInven->createdDate = $request->createdDate;
        $barangInven->modifiedBy = $request->modifiedBy;
        $barangInven->modifiedDate = $request->modifiedDate;
        $success=$barangInven->save();

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
        $barangInven = BarangInven::find($primaryKey);
        if (is_null($barangInven)) {
            return Response::json('not found',404);
        }
        return Response::json($barangInven,200);
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
        $barangInven = BarangInven::find($primaryKey);

        $barangInven->idBarang = $request->input('idBarang');
        $barangInven->kodeBarang = $request->input('kodeBarang');
        $barangInven->namaBarang = $request->input('namaBarang');
        $barangInven->keterangan = $request->input('keterangan');
        $barangInven->isDeleted = $request->input('isDeleted');
        $barangInven->createdBy = $request->input('createdBy');
        $barangInven->createdDate = $request->input('createdDate');
        $barangInven->modifiedBy = $request->input('modifiedBy');
        $barangInven->modifiedDate = $request->input('modifiedDate');
        $success=$barangInven->save();

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
        $barangInven = BarangInven::find($primaryKey);

        if (is_null($barangInven)) {
            return Response::json("not found",404);
        }
        // $kondisi = '1';
        // $success=$barangInven->isDeleted = $request->$kondisi;
        $barangInven->isDeleted = 1;
        $success=$barangInven->save();
            
        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
