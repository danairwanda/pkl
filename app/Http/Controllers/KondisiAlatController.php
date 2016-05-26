<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\KondisiAlat;
use Response;

class KondisiAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $KondisiAlat = KondisiAlat::all();
        return Response::json($KondisiAlat,200);
    }

    public function index(Request $request)
    {
        // $kondisi = KondisiAlat::all();
        // return Response::json($kondisi,200);
        $KondisiAlat = KondisiAlat::all();
        if ($request->get('search')) {
            $KondisiAlat = KondisiAlat::where("idKondisiAlat", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $KondisiAlat = KondisiAlat::paginate(5);
        }
        return Response::json($KondisiAlat,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kondisi = new KondisiAlat;
        // $kondisi->idKondisiAlat = $request->idKondisiAlat;
        $kondisi->kondisi = $request->kondisi;
        $kondisi->isDeleted = $request->isDeleted;
        $kondisi->createdBy = $request->createdBy;
        $kondisi->createdDate = $request->createdDate;
        $kondisi->modifiedBy = $request->modifiedBy;
        $kondisi->modifiedDate = $request->modifiedDate;
        $success=$kondisi->save();
        
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
        $kondisi = KondisiAlat::find($primaryKey);
        if (is_null($kondisi)) {
            return Response::json("not found",404);
        }
        return Response::json($kondisi,200);
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
        $kondisi = KondisiAlat::find($primaryKey);
        $kondisi->idKondisiAlat = $request->input('idKondisiAlat');
        $kondisi->kondisi = $request->input('kondisi');
        $kondisi->isDeleted = $request->input('isDeleted');
        $kondisi->createdBy = $request->input('createdBy');
        $kondisi->createdDate = $request->input('createdDate');
        $kondisi->modifiedBy = $request->input('modifiedBy');
        $kondisi->modifiedDate = $request->input('modifiedDate');
        $success=$kondisi->save();
        
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
        $kondisi = KondisiAlat::find($primaryKey);
        if (is_null($kondisi)) {
            return Response::json("not found",404);
        }
            
        $barangInven->isDeleted = 1;
        $success=$kondisi->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
