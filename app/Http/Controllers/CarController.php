<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Services\IResponseCodes;
use Validator;

class CarController extends Controller
{
    protected $_carModel;
    public function __construct(Car $car)
    {
        $this->_carModel = $car;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryId = $request->input('catgory'); // Assuming the category ID is passed as a query parameter
        // Use the category ID to filter the cars
        $query = $this->_carModel->query();
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $car = $query->with('category')->get();
        if(!$car->isEmpty()){
            $response = [
                'status' => 'success',
                'data' => $car,
            ];
            $status = IResponseCodes::SUCCESS;
        }
        else{
            $response = [
                'status' => false,
                'message' => 'car Not Found',
                'data' => []
            ];
            $status = IResponseCodes::NOT_FOUND;
        }
        return response()->json($response, $status);
    }

    public function show($id)
    {
        $car =$this->_carModel->find($id);
  
        if (is_null($car)) {
            return response()->json([
                'status' => false,
                'message' => 'car is not found!',
            ], IResponseCodes::NOT_FOUND);
        }
        return response()->json([
            'status' => 'success',
            'category' => $car
        ], IResponseCodes::SUCCESS);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validate = Validator::make($request->all(), [
            'color' => 'required',
            'category_id' => 'required',
            'model' => 'required',
            'registration_no' => 'required',
            'make' => 'required',
        ]);

        if($validate->fails()){  
            $response = [
                'status' => false,
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ]; 
            return response()->json($response, IResponseCodes::Validator_error); 
        }

        
        $car =  $this->_carModel->create([
            'color' => $request->color,
            'category_id' => $request->category_id,
            'model' => $request->model,
            'registration_no' => $request->registration_no,
            'make' => $request->make,
        ]);
         $response = [
            'status' => 'success',
            'message' => 'car Added Successfully',
            'data' => $car,
         ];

        return response()->json($response, IResponseCodes::SUCCESS); 
    }
    public function update(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validate->fails()) {  
            $response = [
                'status' => false,
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ]; 
            return response()->json($response, IResponseCodes::Validator_error); 
        }

        $car = $this->_carModel->where([
            'id' => $request->id
        ])->first();

        if ($car) {
            if (!empty($request->color)) {
                $car->color = $request->color;
            }
            if (!empty($request->category_id)) {
                $car->category_id = $request->category_id;
            }
            if (!empty($request->model)) {
                $car->model = $request->model;
            }
            if (!empty($request->registration_no)) {
                $car->registration_no = $request->registration_no;
            }
            if (!empty($request->make)) {
                $car->make = $request->make;
            }
            $car->save();
            $statusCode = IResponseCodes::SUCCESS;
            $response = [
                'status' => 'success',
                'message' => 'car Updated Successfully',
                'data' => $car,
            ];
        } else {
            $statusCode = IResponseCodes::NOT_FOUND;
            $response = [
                'status' => false,
                'message' => 'car Not Found',
                'data' => [],
            ];
        }

        return response()->json($response, $statusCode); 
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $car =$this->_carModel->find($id);
  
        if (is_null($car)) {
            return response()->json([
                'status' => false,
                'message' => 'car is not found!',
            ], IResponseCodes::NOT_FOUND);
        }

        $this->_carModel->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'car is deleted successfully.'
            ], IResponseCodes::SUCCESS);
    }
   
}
