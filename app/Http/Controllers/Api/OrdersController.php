<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operation\Orders;
use App\Models\Administration\Parameters;
use Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller {

    public function reserveW(Request $req) {

        $in = $req->all();
        $serv = json_encode($in["services"]);
        unset($in["services"]);
        $in["services"] = $serv;

        $in["user_id"] = Auth::user()->id;
        $in["status_id"] = 1;
        $in["created"] = date("Y-m-d H:i");

        $id = Orders::create($in)->id;

        if ($id) {
            $row = Orders::select("orders.id", "users.name", "users.last_name", "parameters.description as type_vehicle", DB::raw("CASE WHEN orders.status_id = 1 tHEN FALSE ELSE TRUE END as status_id"), "orders.created", DB::raw("CASE WHEN orders.status_id = 1 THEN 'Nuevo' WHEN orders.status_id = 2 THEN 'Completado' ELSE 'Cancelado' END as status")
                    ,"orders.hour","orders.day")
                            ->join("users", "users.id", "orders.user_id")
                            ->join("parameters", "parameters.code", "order.type_vehicle_id")
                            ->where("orders.id", $id)->first();
            return response()->json(['status' => true, "msg" => "Cupo reservado. Numero de reserva: #" . $id, "data" => $row]);
        } else {
            return response()->json(['status' => false, "msg" => "Sin cupo disponible"], 401);
        }
    }

    public function getOrders() {
        $data = Orders::select("orders.id", "users.name", "users.last_name", "parameters.description as type_vehicle", DB::raw("CASE WHEN orders.status_id = 1 tHEN FALSE ELSE TRUE END as status_id"), "orders.created", DB::raw("CASE WHEN orders.status_id = 1 THEN 'Nuevo' WHEN orders.status_id = 2 THEN 'Completado' ELSE 'Cancelado' END as status")
                ,"orders.hour","orders.day")
                        ->join("users", "users.id", "orders.user_id")
                        ->join("parameters", "parameters.code", DB::raw("orders.type_vehicle_id and parameters.group='type_vehicle'"))
                        ->where("orders.user_id", Auth::user()->id)
                        ->orderBy("orders.id", "desc")->get();
        return response()->json(['data' => $data]);
    }

    public function getTypeVehicle() {
        $data = Parameters::where("group", "type_vehicle")->get();
        return response()->json(['data' => $data]);
    }

    public function cancelOrder(Request $req, $id) {
        $row = Orders::find($id);
        $row->status_id = 3;
        $row->leaved = date("Y-m-d H:i:s");
        $row->save();
        return response()->json(['status' => true, "row" => $row]);
    }

}
