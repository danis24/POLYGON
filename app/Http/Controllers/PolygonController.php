<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PolygonService;

class PolygonController extends Controller
{

     private $service;

     public function __construct(PolygonService $service)
     {
          $this->service = $service;
     }

     public function show()
     {
          return view('polygon.show');
     }

     public function showpol()
     {
          $pol = $this->service->browse();
          return response()->json($pol);
     }

     public function post(Request $request)
     {
          $data = $request->polygon;
          $trim = trim($data, 'undefined');
          $polygon = $this->service->add([
               'polygon' => $trim
          ]);
          if($polygon){
               return response()->json([
                    'message' => 'success'
               ]);
          }else{
               return response()->json([
                    'message' => 'failed'
               ]);
          }
     }
}
