<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\User;
use App\Models\Car;
use App\Http\Resources\Car as CarResource;
use App\Http\Resources\User as UserResource;

class CarController extends BaseController
{
    public function index()
    {
        $car = Car::all();
        return $this->sendRensponse(CarResource::collection($car), 'Cars retrieved successfully.');
    }

    public function show($id)
    {
        $car = Car::find($id);
        if (is_null($car)) {
            return $this->sendError('Car not found.');
        }
        return $this->sendRensponse(new CarResource($car), 'Car retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
       
        $validator = Validator::make($input, [
            'name' => 'required',
            'brand_id' => 'required',
            'year' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
       
        $car = Car::create($input);
        return $this->sendRensponse(new CarResource($car), 'Car created successfully.');
      
    }

    public function update(Request $request, Car $car)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'brand_id' => 'required',
            'year' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $car->name = $input['name'];
        $car->year = $input['year'];
        $car->description = $input['description'];
        $car->image = $input['image'];
        $car->price = $input['price'];
        $car->save();
        return $this->sendRensponse(new CarResource($car), 'Car updated successfully.');
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $car = Car::where('name', 'like', '%' . $input['name'] . '%')->get();

        if ($car->isEmpty() ) {
            return $this->sendError('Car not found.');
        }
        return $this->sendRensponse(CarResource::collection($car), 'Car search successfully.');
        
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return $this->sendRensponse([], 'Car deleted successfully.');
    }
    public function login(Request $request, Car $car)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $car = User::where('email', $input['email'])->where('password', $input['password'])->get();
        if ($car->isEmpty() ) {
            return $this->sendError('Login Failed.');
        }
        return $this->sendRensponse(UserResource::collection($car), 'Login successfully.');
    }
    //  /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $car  = Car::all();
    //     return $this->sendResponse($car, 'Cars retrieved successfully.');
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create(Request $request)
    // {
    //     $car = new Car;
    //     $car->name = $request->name;
    //     $car->year = $request->year;
    //     $car->description = $request->description;
    //     $car->image = $request->image;
    //     $car->price = $request->price;
    //     $car->save();

    //     return "Car record created";
    // }


    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Car  $car
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $car = Car::find($id);
    //     $car->name = $request->name;
    //     $car->year = $request->year;
    //     $car->description = $request->description;
    //     $car->image = $request->image;
    //     $car->price = $request->price;
    //     $car->save();

    //     return "Car record updated";
    // }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Car  $car
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $car = Car::find($id);
    //     $car->delete();

    //     return "Car record deleted";
    // }
}
