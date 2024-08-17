<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DisciplineModel;
use App\Models\RewardModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class DisciplineController extends Controller
{
    function getView()
    {
        $model = new DisciplineModel();
        $discipline_list = $model->getDiscipline();
        $employee_list = $model->getEmployee();
        $type_discipline_list = $model->getTypeDiscipline();
//        dd($discipline_list);
        return view('auth.discipline.index-discipline',
            compact('discipline_list', 'employee_list','type_discipline_list'));
    }

    function add(Request $request){
        $validated = $request->validate([
            'add_action_id'=>'int',
            'add_employee_id'=>'int',
        ]);

        DisciplineModel::create([
            'action_id' =>$validated['add_action_id'],
            'employee_id' =>$validated['add_employee_id'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Discipline added successfully',
        ]);
    }

    function delete($id)
    {
//        dd($id);
        $discipline = DisciplineModel::findOrFail($id);

        $discipline->delete();

        return response()->json([
            'success' => true,
            'message' => 'Discipline deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $discipline = DisciplineModel::findOrFail($id);
        return response()->json([
            'discipline' => $discipline
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'action_id' => 'int',
            'employee_id' => 'int',
        ]);
        $discipline = DisciplineModel::findOrFail($id);
        $discipline->update($validated);

        return response()->json([
            'success' => true,
            'discipline' => $discipline,
        ]);
    }

    public function exportExcel()
    {
        $inputFileName = public_path('excel-example/danhsachkyluatexport.xlsx');

        $inputFileType = IOFactory::identify($inputFileName);

        $objReader = IOFactory::createReader($inputFileType);

        $excel = $objReader->load($inputFileName);

        $excel->setActiveSheetIndex(0);
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');

        $stt = 1;
        $cell = $excel->getActiveSheet();

        $model = new DisciplineModel();
        $leave_report = $model->getDiscipline();
        $num_row = 3;

        foreach ($leave_report as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $row->disciplinary_action);
            $cell->setCellValue('C' . $num_row, $row->first_name . ' ' . $row->last_name);

            $borderStyle = $cell->getStyle('A' . $num_row . ':C' . $num_row)->getBorders();
            $borderStyle->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $cell->getStyle('A' . $num_row . ':C' . $num_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $num_row++;
        }
        foreach (range('A', 'C') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename = "danh-sach-ky-luat" . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Xóa tất cả buffer trước khi xuất dữ liệu
        ob_end_clean();

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
    }
}
