<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
{

    static public function getChildren($id): array
    {
        $children = []; // inicjujemy pustą tablicę, do której będziemy dodawać znalezione dzieci

        $stmt = Tree::where('parent_id', $id)->pluck('id')->toArray();


        foreach ($stmt as $item) {
            $children[] = $item; // dodajemy bezpośrednie dziecko do tablicy
            $children = array_merge($children, TreeController::getChildren($item)); // rekurencyjnie dodajemy dzieci tego dziecka
        }

        return $children;
    }


    public function index()
    {
        $tree = Tree::with('children')->whereNull('parent_id')->get()->sortBy('position');


        return view('tree.index', compact('tree'));
    }

    public function indexWS($type)
    {
        if($type == "asc") {
            $tree = Tree::with('children')->whereNull('parent_id')->get()->sortBy('name');
        }elseif($type == "desc"){
            $tree = Tree::with('children')->whereNull('parent_id')->get()->sortByDesc('name');
        }else{
            $tree = Tree::with('children')->whereNull('parent_id')->get();
        }
        return view('tree.index', compact('tree'));
    }



    public function pos_edit($id)
    {
        $pos  = Tree::where('parent_id', $id)->pluck('name', 'id')->toArray();


        return view('tree.pos_edit', compact('pos'));
    }

    public function create()
    {
        // Formularz tworzenia realizuje index (pop-up)
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable'
        ]);

        Tree::create($formFields);

        return redirect()->route('tree.index');
    }

    public function edit($id)
    {
        // Formularz edycji realizuje index (pop-up)
    }

    public function update(Request $request, Tree $tree)
    {
        //$node = Tree::find($id);

        if($request->get('parent_id') == "0"){
            $formFields = $request->validate([
                'name' => 'required',
                'position' => 'nullable'
            ]);
            $tree->update($formFields);

        }else{

            $formFields = $request->validate([
                'name' => 'required',
                'parent_id' => 'required',
                'position' => 'nullable'
            ]);


            $tree->update($formFields);
        }
        return redirect()->route('tree.index');
    }



    public function update_pos(Request $request, Tree $tree)
    {
        //$node = Tree::find($id);



            $formFields = $request->validate([

                'position' => 'required'
            ]);

        function checkDuplicates(array $input_array) {
            return count($input_array) === count(array_flip($input_array));
        }


        if(!checkDuplicates($formFields['position'])){
            return back()->with('errorMsg','Błąd: Jedna z pozycji została wybrana dwa razy');
        }

            $tree->update($formFields);

        return redirect()->route('tree.index');
    }

    public function destroy($id) // Tree $tree
    {

        $node_id = $id;
        $all_nodes = TreeController::getChildren($node_id);
        $all_nodes[] = $node_id;
        //$tree->delete();
        Tree::whereIn('id', $all_nodes)->delete();

        return redirect()->route('tree.index');
    }
}
