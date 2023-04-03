<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::getUsersPerMonth();
        $months = config('months');
        $chart_users = $months->mapWithKeys(function ($month) use ($users) {
            return [$month => $users[$month] ?? 0];
        })->toArray();
        $current_date = Carbon::now()->toDateString();
        $tasks = Task::with('state', 'user');
        if (auth()->user()->role->type !== 'admin') {
            $tasks = $tasks->where('user_id', auth()->user()->id);
        }
        $tasks = $tasks->get();

        $analytics =  [
            'total_users' => User::count(),
            'uploaded_files' => auth()->user()->role->type === 'admin' ?  File::count() : File::where('user_id', auth()->user()->id)->count(),
            'completed_tasks' => $tasks->where('state.type', '=', 'completado')->count(),
            'pendenting_tasks' => $tasks->where('state.type', '=', 'sin completar')->count()
        ];

        return view('user.dashboard', compact('analytics', 'current_date', 'chart_users'));
    }

    public function generatePdf(Request $request)
    {

        $users = User::getUsersByDateRange(
            $request->start_date,
            $request->end_date
        );
        $tasks = Task::getTasksByUserId();
        $data = [
            'title' => 'Reporte general',
            'date' => date('m/d/Y'),
            'users' => $users,
            'tasks' => $tasks,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];

        $role = auth()->user()->role->type;
        if ($role === 'admin') {
            return $this->generateUsersReport($data);
        } else {
            return $this->generateTasksReport($data);
        }
    }


    private function generateUsersReport(array $data)
    {
        $pdf = PDF::loadView('user.reports.admin.users-list', $data);
        return $pdf->download('reporte_usuarios_registrados.pdf');
    }

    private function generateTasksReport(
        array $data
    ) {
        $pdf = PDF::loadView('user.reports.customer.tasks-list', $data);
        return $pdf->download('reporte_tareas_creadas.pdf');
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
