<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'books' => \App\Models\Book::all(),
            'users' => \App\Models\User::all(),
            'loans' => \App\Models\Loan::with(['user', 'book'])->get(),
        ]);
    }
}