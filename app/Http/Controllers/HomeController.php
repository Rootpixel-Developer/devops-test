<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductModule;
use Illuminate\Http\Request;
use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('modules')->orderByDesc('created_at')->get();
        return view('home', compact('products'));
    }

    public function create()
    {
        $data = null;
        if (Cache::has('step1')) {
            $data = Cache::get('step1');
        }
        return view('create', compact('data'));
    }

    public function storeStep1(Request $request)
    {
        if ($request->step == 1) {
            Cache::put('step1', $request->only('name', 'price'), 60 * 60);
            return redirect('/home/create/step-2');
        } else {
            if (!Cache::has('step1')) {
                return redirect('/home/create');
            }
            $step1 = Cache::get('step1');
            $product = Product::create([
                'name' => $step1['name'],
                'price' => $step1['price']
            ]);
            foreach ($request->module_name as $i => $module_name) {
                $product->modules()->create([
                    'module_name' => $module_name,
                    'module_link' => $request->module_link[$i]
                ]);
            }
            Cache::forget('step1');
            return redirect('/home');
        }
    }

    public function createStep2()
    {
        return view('create-step2');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return true;
    }

    public function edit($id)
    {
        if (Cache::has('editStep1')) {
            $data = Cache::get('editStep1');
            if ($data['id'] != $id) {
                Cache::forget('editStep1');
                $data = Product::findOrFail($id);
            }
        } else {
            $data = Product::findOrFail($id);
        }
        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request->step == 1) {
            Cache::put('editStep1', $request->only('name', 'price', 'id'), 60 * 60);
            return redirect('/home/edit/step-2/' . $id);
        } else {
            if (!Cache::has('editStep1')) {
                return redirect('/home');
            }
            $step1 = Cache::get('editStep1');
            $product = Product::find($id);
            $product->update([
                'name' => $step1['name'],
                'price' => $step1['price']
            ]);
            foreach ($request->module_id as $i => $module_id) {
                $module = ProductModule::find($module_id);
                $module->update([
                    'module_name' => $request->module_name[$i],
                    'module_link' => $request->module_link[$i]
                ]);
            }
            Cache::forget('editStep1');
            return redirect('/home');
        }
    }

    public function editStep2($id)
    {
        $product = Product::find($id);
        return view('edit-step2', compact('product'));
    }
}
