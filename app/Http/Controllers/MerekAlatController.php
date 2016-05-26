<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MerekAlat;
use Response;

class MerekAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $MerekAlat = MerekAlat::all();
        return Response::json($MerekAlat,200);
    }

    public function index(Request $request)
    {
        // $merekAlat = MerekAlat::all();
        // return Response::json($merekAlat,200);
        $merekAlat = MerekAlat::all();
        if ($request->get('search')) {
            $merekAlat = MerekAlat::where("namaMerek", "LIKE", "{$request->get('search')}%")->where("isDeleted", "=", "0")->paginate(5);
        }else{
            $merekAlat = MerekAlat::where("isDeleted", "=", "0")->paginate(5);
            // $merekAlat = MerekAlat::paginate(5);
        }
        return Response::json($merekAlat,200);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $merekAlat = new MerekAlat;
        // $merekAlat->idMerekAlat  = $request->idMerekAlat;
        $merekAlat->namaMerek  = $request->namaMerek;
        $merekAlat->singkatanMerek  = $request->singkatanMerek;
        $merekAlat->isDeleted = $request->isDeleted;
        $merekAlat->createdBy = $request->createdBy;
        $merekAlat->createdDate = $request->createdDate;
        $merekAlat->modifiedBy = $request->modifiedBy;
        $merekAlat->modifiedDate = $request->modifiedDate;
        $success=$merekAlat->save();
        
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
        $merekAlat = MerekAlat::find($primaryKey);
        if (is_null($merekAlat)) {
            return Response::json("not found",404);
        }
        return Response::json($merekAlat,200);
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
        $merekAlat = MerekAlat::find($primaryKey);
        $merekAlat->idMerekAlat  = $request->input('idMerekAlat');
        $merekAlat->namaMerek  = $request->input('namaMerek');
        $merekAlat->singkatanMerek  = $request->input('singkatanMerek');
        $merekAlat->isDeleted = $request->input('isDeleted');
        $merekAlat->createdBy = $request->input('createdBy');
        $merekAlat->createdDate = $request->input('createdDate');
        $merekAlat->modifiedBy = $request->input('modifiedBy');
        $merekAlat->modifiedDate = date('Y-m-d H:i:s');
        $success=$merekAlat->save();
        
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
        $merekAlat = MerekAlat::find($primaryKey);
        if (is_null($merekAlat)) {
            return Response::json("not found",404);
        }
            
        $merekAlat->isDeleted = 1;
        $success=$merekAlat->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
