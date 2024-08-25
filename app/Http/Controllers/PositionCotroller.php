<?php

namespace App\Http\Controllers;

use App\Models\PositionModel;
use App\Models\TaskModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PositionCotroller extends Controller
{
    function getView(){
        $model = new PositionModel();
        $position_list = $model->getPosition();
//        dd($position_list);
        return view('auth.position.index-position', compact('position_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'job_position_code' => 'required|string',
            'job_position_name' => 'required|string',
            'description' => 'nullable',
        ]);


        PositionModel::create($validated);

        return response()->json([
            'success' => true,
            'status'  => 200,
            'message' => 'Position added successfully',
        ]);
    }

    public function delete($id)
    {
        $position = PositionModel::findOrFail($id);

        $position->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proposal application deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $position = PositionModel::findOrFail($id);
        return response()->json([
            'position' => $position
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_position_code' => 'string',
            'job_position_name' => 'string',
            'position_level' => 'string',
            'salary_code' => 'nullable',
            'description' => 'nullable',
        ]);
        $position = PositionModel::findOrFail($id);
        $position->update($validated);

        return response()->json([
            'success' => true,
            'position' => $position,
        ]);
    }

    public function exportExcel()
    {
        $inputFileName = public_path('excel-example/bangchucvuexport.xlsx');

        $inputFileType = IOFactory::identify($inputFileName);

        $objReader = IOFactory::createReader($inputFileType);

        $excel = $objReader->load($inputFileName);

        $excel->setActiveSheetIndex(0);
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');

        $stt = 1;
        $cell = $excel->getActiveSheet();

        $model = new PositionModel();
        $leave_report = $model->getPosition();
        $num_row = 3;

        foreach ($leave_report as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $row->job_position_code);
            $cell->setCellValue('C' . $num_row, $row->job_position_name);
            $cell->setCellValue('D' . $num_row, $row->position_level);
            $cell->setCellValue('E' . $num_row, $row->salary_code);
            $cell->setCellValue('F' . $num_row, $row->description);

            $borderStyle = $cell->getStyle('A' . $num_row . ':F' . $num_row)->getBorders();
            $borderStyle->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $cell->getStyle('A' . $num_row . ':F' . $num_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $num_row++;
        }
        foreach (range('A', 'F') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename = "danh-sach-chuc-vu" . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Xóa tất cả buffer trước khi xuất dữ liệu
        ob_end_clean();

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
    }

    public function getJobPositionCode($id) {
        $jobPosition = PositionModel::find($id);

        if ($jobPosition) {
            return response()->json(['job_position_code' => $jobPosition->job_position_code]);
        } else {
            return response()->json(['error' => 'Không tìm thấy mã chức vụ'], 404);
        }
    }

}
