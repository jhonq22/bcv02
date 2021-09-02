<?php

namespace App\Http\Controllers;

use App\Ordencompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdencompraController extends Controller
{
    public function index()
    {
        $orden = DB::select("SELECT orden_compra.id, producto, estatus_orden, users.name
        FROM orden_compra
        LEFT JOIN productos ON producto_id = productos.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estatus_compra ON estatu_id = estatus_compra.id
        ORDER BY orden_compra.id DESC");

        echo json_encode($orden);
    }




    public function listadoComprasPorUsuario($user_id)
    {
        $orden = DB::select("SELECT orden_compra.id, producto, precio, estatus_orden, users.name, orden_compra.created_at as fecha_compra
        FROM orden_compra
        LEFT JOIN productos ON producto_id = productos.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estatus_compra ON estatu_id = estatus_compra.id
        WHERE users.id = ?
        ORDER BY orden_compra.id DESC
     ", [$user_id]);

        echo json_encode($orden);
    }


    public function listadoComprasPorUsuarioEnEspera($user_id)
    {
        $orden = DB::select("SELECT orden_compra.id, producto, precio, estatus_orden, users.name, orden_compra.created_at as fecha_compra
        FROM orden_compra
        LEFT JOIN productos ON producto_id = productos.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estatus_compra ON estatu_id = estatus_compra.id
        WHERE users.id = ?
        ORDER BY orden_compra.id DESC
     ", [$user_id]);

        echo json_encode($orden);
    }



    public function listadoComprasEnEspera()
    {
        $orden = DB::select("SELECT DISTINCT user_id, estatu_id, users.name, estatus_orden
        FROM orden_compra
        LEFT JOIN productos ON producto_id = productos.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estatus_compra ON estatu_id = estatus_compra.id
        WHERE estatu_id = 1
        ORDER BY orden_compra.id DESC");

        echo json_encode($orden);
    }





    

    
     public function store(Request $request)
    {
        $orden = new Ordencompra();
        $orden->producto_id = $request->input('producto_id');
        $orden->estatu_id = $request->input('estatu_id');
        $orden->user_id = $request->input('user_id');
       


  
      

        $orden->save(); // para guardar en json

        echo json_encode($orden); // para pasar en json
    }

   

    public function show($orden_id)
    {
        $ordens =Ordencompra::find($orden_id);
        echo json_encode($ordens);
    }
      

   
    public function update(Request $request, $orden_id)
    {
        $orden =Ordencompra::find($orden_id);
       //$orden->producto_id = $request->input('producto_id');
        $orden->estatu_id = $request->input('estatu_id');
        //$orden->user_id = $request->input('user_id');

      
        $orden->save(); // para guardar en json

        echo json_encode($orden); // para pasar en json
    }

  
    public function destroy($orden_id)
    {
        $orden =Ordencompra::find($orden_id);
        $orden->delete();
    }
}
