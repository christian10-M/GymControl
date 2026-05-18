<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;

class ReportController extends Controller
{
    /**
     * PANEL REPORTES
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * REPORTE USUARIOS
     */
    public function users()
    {
        $users = User::where('role', 'user')->get();

        return view('reports.users', compact('users'));
    }

    /**
     * REPORTE MEMBRESÍAS
     */
    public function memberships()
    {
        $memberships = Membership::with('user')->get();

        return view('reports.memberships', compact('memberships'));
    }
}