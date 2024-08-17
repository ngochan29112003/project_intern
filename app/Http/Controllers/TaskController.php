<?php

namespace App\Http\Controllers;

use App\Models\RewardModel;
use App\Models\TaskModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class TaskController extends Controller
{
    function getView()
    {
        $model = new TaskModel();
        $task_list = $model->getTask();
        $employee_list = $model->getEmployee();
        return view('auth.task.index-task',
            compact('task_list','employee_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_task_code' => 'required|string',
            'add_employee_id' => 'int',
            'add_start_date' => 'required|string',
            'add_end_date' => 'required|string',
            'add_location' => 'required|string',
            'add_purpose' => 'required|string',
        ]);

        TaskModel::create([
            'task_code' =>$validated['add_task_code'],
            'employee_id' =>$validated['add_employee_id'],
            'start_date' =>$validated['add_start_date'],
            'end_date' =>$validated['add_end_date'],
            'location' =>$validated['add_location'],
            'purpose' =>$validated['add_purpose'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Task added successfully',
        ]);
    }

    public function delete($id)
    {
        $task = TaskModel::findOrFail($id);

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $task = TaskModel::findOrFail($id);
        return response()->json([
            'task' => $task
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'task_code' => 'string',
            'employee_id' => 'string',
            'start_date' => 'string',
            'end_date' => 'string',
            'location' => 'string',
            'purpose' => 'string',
        ]);
        $task = TaskModel::findOrFail($id);
        $task->update($validated);

        return response()->json([
            'success' => true,
            'task' => $task,
        ]);
    }

    public function exportExcel()
    {
        $inputFileName = public_path('excel-example/bangcongviecexport.xlsx');

        $inputFileType = IOFactory::identify($inputFileName);

        $objReader = IOFactory::createReader($inputFileType);

        $excel = $objReader->load($inputFileName);

        $excel->setActiveSheetIndex(0);
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');

        $stt = 1;
        $cell = $excel->getActiveSheet();

        $model = new TaskModel();
        $leave_report = $model->getTask();
        $num_row = 3;

        foreach ($leave_report as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $row->task_code);
            $cell->setCellValue('C' . $num_row, $row->first_name . ' ' . $row->last_name);
            $cell->setCellValue('D' . $num_row, $row->start_date);
            $cell->setCellValue('E' . $num_row, $row->end_date);
            $cell->setCellValue('F' . $num_row, $row->location);
            $cell->setCellValue('G' . $num_row, $row->purpose);

            $borderStyle = $cell->getStyle('A' . $num_row . ':G' . $num_row)->getBorders();
            $borderStyle->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $cell->getStyle('A' . $num_row . ':G' . $num_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $num_row++;
        }
        foreach (range('A', 'G') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename = "danh-sach-cong-viec" . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Xóa tất cả buffer trước khi xuất dữ liệu
        ob_end_clean();

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
    }
}
