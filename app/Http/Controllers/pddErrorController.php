<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\pddError;
use Response;

class pddErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $pddError = pddError::all();
        return Response::json($pddError,200);
    }

    public function index(Request $request)
    {
        // $pddError = pddError::all();
        // return Response::json($pddError,200);
        $pddError = pddError::all();
        if ($request->get('search')) {
            $pddError = pddError::where("idErrPdd", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $pddError = pddError::paginate(5);
        }
        return Response::json($pddError,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pddError = new pddError;
        // $pddError->idErrPdd = $request->idErrPdd;
        $pddError->tglErrPdd = $request->tglErrPdd;
        $pddError->namaPdd = $request->namaPdd;
        $pddError->ketErrPdd = $request->ketErrPdd;
        $pddError->diSelesaikan = $request->diSelesaikan;
        $success=$pddError->save();

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
        $pddError = pddError::find($primaryKey);
        if (is_null($pddError)) {
            return Response::json("not found",404);
        }
        return Response::json($pddError,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $pddError = pddError::find($primaryKey);
        $pddError->idErrPdd = $request->input('idErrPdd');
        $pddError->tglErrPdd = $request->input('tglErrPdd');
        $pddError->namaPdd = $request->input('namaPdd');
        $pddError->ketErrPdd = $request->input('ketErrPdd');
        $pddError->diSelesaikan = $request->input('diSelesaikan');
        $success=$pddError->save();

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
    public function destroy($id)
    {
        $pddError = pddError::find($primaryKey);
        if (is_null($pddError)) {
            return Response::json("not found",500);
        }

        $pddError->isDeleted = 1;
        $success=$pddError->save();
        
        if (!$success) {
            return Response::json("error",500);
        }        
        return Response::json("success",200);
    }
}
