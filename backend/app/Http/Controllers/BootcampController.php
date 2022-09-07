<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Illuminate\Support\Facades\Validator; 
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampResource;
use App\Http\Resources\BootcampCollection;
use App\Http\Controllers\BaseController;

class BootcampController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return response()->json(new BootcampCollection(Bootcamp::all()), 200);
        try 
        {
            return $this->sendResponse(new BootcampCollection(Bootcamp::all()));
        } 
        catch (\Exception $e) 
        {
            return $this->sendError('Server Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {
        $b = Bootcamp;
        try 
        {
            return $this->sendResponse(new BootcampResource($b), 201);
        } 
        catch (\Exception $e) 
        {
            return $this->sendError('Server Error', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try 
        {
            //1. Encontrar el bootcamp por id
            $bootcamp = Bootcamp::find($id);
            if(!$bootcamp)
            {
                return $this->sendError("bootcamp widt id: $id not found", 400);
            }
        } catch (\Excetion $e) 
        {
            return $this->sendResponse(new BootcampResource($bootcamp));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try 
        {
            //1. localizar  el bootcamp con id
            $b = Bootcamp::find($id);
            // actualizar
            $b->update($request->all());

            if(!$b)
            {
                return $this->sendError("bootcamps with id: $id not found", 400);
            }
            return $this->sendResponse(new BootcampResource($b));
        }
        catch (\Exception $e) 
        {
            return $this->sendError('Server error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $b=Bootcamp::find($id);
            if(!$b)
            {
                return $this->sendError("bootcamp widt id: $id not found", 400);
            }
            $b->delete();
            return $this->sendResponse(new BootcampResource($b));
        }
        catch (\Exception $e) 
        {
            return $this->sendError('Server error', 500);
        }
    }
}