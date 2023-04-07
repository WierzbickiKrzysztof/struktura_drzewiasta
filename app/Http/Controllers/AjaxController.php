<?php

namespace App\Http\Controllers;

use App\Models\Tree;

use Illuminate\Http\Request;
use Response;


class AjaxController extends Controller
{

    public function getAjax(Request $request)
    {
        if($request->type == 'children'){
            $id_node = $request->id_node;

            $countnodes = count(TreeController::getChildren($id_node));

            $jsresponse = $countnodes;

        }elseif($request->type == 'parents'){
            $id_node = $request->id_node;

            $getChildChild = TreeController::getChildren($id_node);

            // Sam węzeł nie może być swoim rodzicem - brak wyświetlenia
            $getChildChild[] = $id_node;

            // Obecny rodzic nie powinien się wyświetlać (domyślnie nie jest on zmieniany)
            $getParent = Tree::where('id', $id_node)->pluck('parent_id');
            $getChildChild[] = $getParent;
            $response = Tree::whereNotIn('id', $getChildChild)->get();


            $jsresponse = $response;
        }


        return Response::json($jsresponse);
    }

}





