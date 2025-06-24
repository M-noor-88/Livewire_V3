<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class TaskExportController extends Controller
{
    use AuthorizesRequests;

    /**
     * @throws AuthorizationException
     * @throws MpdfException
     */
    public function generate(Task $task)
    {
        // ✅ Policy check
        $this->authorize('view', $task);
        // ✅ Prepare PDF
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans', // supports Arabic
        ]);

        $user = Auth::user();
        $html = view('exports.task', compact('task', 'user'))->render();

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="task_' . $task->id . '.pdf"');
    }
}
