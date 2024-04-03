<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\IResponseCodes;
use Validator;

class CategoryController extends Controller
{
    protected $_categoryModel;
    public function __construct(Category $category)
    {
        $this->_categoryModel = $category;
    }
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $category = $this->_categoryModel->all();
        if(!$category->isEmpty()){
            $response = [
                'status' => 'success',
                'data' => $category,
            ];
        }
        else{
            $response = [
                'status' => false,
                'message' => 'Category Not Found',
                'data' => []
            ];
        }
        return response()->json($response, IResponseCodes::SUCCESS);
    }

    public function show($id)
    {
        $category =$this->_categoryModel->find($id);
  
        if (is_null($category)) {
            return response()->json([
                'status' => false,
                'message' => 'category is not found!',
            ], IResponseCodes::NOT_FOUND);
        }
        return response()->json([
            'status' => 'success',
            'category' => $category
        ], IResponseCodes::SUCCESS);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
        ]);

        if($validate->fails()){  
            $response = [
                'status' => false,
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ]; 
            return response()->json($response, IResponseCodes::Validator_error); 
        }

        
        $feedback =  $this->_categoryModel->create([
            'name' => $request->name,
        ]);
         $response = [
            'status' => 'success',
            'message' => 'category Added Successfully',
            'data' => $feedback,
         ];

        return response()->json($response, IResponseCodes::SUCCESS); 
    }
    public function update(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validate->fails()) {  
            $response = [
                'status' => false,
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ]; 
            return response()->json($response, IResponseCodes::Validator_error); 
        }

        $category = $this->_categoryModel->where([
            'id' => $request->id
        ])->first();

        if ($category) {
            if (!empty($request->name)) {
                $category->name = $request->name;
            }
            $category->save();
            $statusCode = IResponseCodes::SUCCESS;
            $response = [
                'status' => 'success',
                'message' => 'category Updated Successfully',
                'data' => $category,
            ];
        } else {
            $statusCode = IResponseCodes::NOT_FOUND;
            $response = [
                'status' => false,
                'message' => 'category Not Found',
                'data' => [],
            ];
        }

        return response()->json($response, $statusCode); 
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $category =$this->_categoryModel->find($id);
  
        if (is_null($category)) {
            return response()->json([
                'status' => false,
                'message' => 'category is not found!',
            ], IResponseCodes::NOT_FOUND);
        }

        $this->_categoryModel->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'category is deleted successfully.'
            ], IResponseCodes::SUCCESS);
    }
}
