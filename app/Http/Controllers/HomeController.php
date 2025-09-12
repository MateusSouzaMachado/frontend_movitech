<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Produto;

class HomeController extends Controller
{
    
    public function index()
    {
        $produtos = Produto::latest()->take(12)->get();
        return Inertia::render('Frontend/Home', [
            'produtos' => $produtos
        ]);
    }
}
