<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public $packages;
    public function __construct() {
        $this->packages = Package::all();
    }

    public function index()
    {
        return view('packages', ['packages' => $this->packages]);
    }

    public function show()
    {

        if(!isset($_GET["category"])){
            $param = 'prewedding';
        } else{
            $param = $_GET['category'];
        }

        return view('admin.admin-package', ['title' => 'Edit Paket & Harga', 'packages' => $this->packages,'category' => $param]);   
    }

    public function edit()
    {

        // Validate Input
        $validatedItem = request()->validate([
            'package-id' => ['required'],
            'price-edit' => ['required'],
            'desc-edit' => ['required'],
            'desc-edit.*' => ['required','min:5'],
        ]);

        // Update Data
        $result = Package::where('id', $validatedItem['package-id'])
        ->update(['price' => $validatedItem['price-edit'], 'description' => json_encode($validatedItem['desc-edit'])]);

        // Handle success & Fail update
        if($result){
            toast("Berhasil, Data berhasil diperbarui",'success');
        } else{
            toast("Gagal, Data gagal diperbarui",'error');
        }
        return redirect('/admin/packages');
    }
}
