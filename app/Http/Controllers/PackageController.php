<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public $packages;
    public $category;

    public function __construct() {
        $this->packages = Package::all();
        $this->category = "";
    }

    public function index()
    {
        return view('packages', ['packages' => $this->packages]);
    }

    public function show()
    {

        if(!isset($_GET["category"])){
            $this->category = 'prewedding';
        } else{
            $this->category = $_GET['category'];
        }

        return view('admin.admin-package', ['title' => 'Edit Paket & Harga', 'packages' => $this->packages, 'category' => $this->category]);   
    }

    public function edit(Request $request)
    {
        $validatedItem = $request->validate([
            'package-id' => ['required'],
            'price-edit' => ['required'],
            'desc-edit' => ['required'],
            'type-edit' => ['required'],
            'desc-edit.*' => ['required','min:5'],
        ]);
        $sub_type = null;

        if($request->sub_type_edit){
            $sub_type = $request->sub_type_edit;
        }

        // Update Data
        $result = Package::where('id', $validatedItem['package-id'])
        ->update(['sub_type' => $sub_type, 'type' => $validatedItem['type-edit'],'price' => $validatedItem['price-edit'], 'description' => json_encode($validatedItem['desc-edit'])]);

        // Handle success & Fail update
        if($result){
            toast("Berhasil, Data berhasil diperbarui",'success');
        } else{
            toast("Gagal, Data gagal diperbarui",'error');
        }
        return redirect('/admin/packages');
    }

    public function add(string $request = 'prewedding')
    {
        if($request == 'wedding' || $request == 'lain-lain' || $request == 'prewedding'){
            // dd($request);
            return view('admin/admin-create-package',['title' => "TAMBAH PAKET BARU",'category' => $request]);
        }

        return redirect('/admin/packages');

    }
    
    public function postAdd(Request $request)
    {
        $validatedItem = $request->validate([
            'category' => ['required'],
            'type' => ['required'],
            'price' => ['required'],
            'desc' => ['required'],
            'desc.*' => ['required','min:5'],
        ]);

        $result = Package::create([
            'category' => $validatedItem['category'],
            'type' => $validatedItem['type'],
            'price' => Number_format($validatedItem['price']),
            'sub_type' => $request->sub_type,
            'description' => json_encode($validatedItem['desc'])
        ]);

        if($result){
            toast('Berhasil Menambahkan Paket','success');
        } else{
            toast('Gagal Menambahkan Paket','error');
        }

        return redirect('/admin/packages');
    }

    public function deletePackage(Request $request)
    {
        $result = Package::where('id', request('package_id'))->delete();

        if($result){
            toast('Berhasil Menghapus Paket','success');
        } else{
            toast('Gagal Menghapus Paket','error');
        }

        return redirect('/admin/packages');
    }
}
