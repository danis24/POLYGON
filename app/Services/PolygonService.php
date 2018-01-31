<?php

namespace App\Services;

use Illuminate\Contracts\Support\Arrayable;
use App\Polygons;


class PolygonService
{
     private function newPol()
     {
          return new Polygons;
     }

     public function browse()
     {
          return $this->newPol()->all();
     }

     public function read($id)
     {
          return $this->find($id);
     }

     public function add($payload)
     {
          return $this->newPol()->create($payload);
     }

     public function update($id, Arrayable $payload)
     {
          $polygon = $this->read($id);
          $polygon->fill($payload->toArray())->save();
          return $polygon;
     }

     public function delete($id)
     {
          return $this->newPol()->destroy($id);
     }
}
