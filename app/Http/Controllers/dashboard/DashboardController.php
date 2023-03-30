<?php

namespace App\Http\Controllers\dashboard;
use Dompdf\Dompdf;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_date = Carbon::now()->toDateString();
        
        $analytics =  [
            'total_users' => User::count(),
            'uploaded_files' => 2323,
            'completed_tasks' => 23,
            'pendenting_tasks' => 213
        ];
        return view('user.dashboard', compact('analytics', 'current_date'));
    }

    public function generatePdf() {
        $users = User::all();
        $pdf = new Dompdf();
        $pdf->loadView('user.admin.user-list', ['users' => $users]);
    
        return $pdf->download('Registros_Usuarios.pdf');
      }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
