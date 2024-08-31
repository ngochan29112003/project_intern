<?php

namespace App\Http\Controllers;

use App\Models\BhxhModel;
use App\Models\SalaryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BhxhController extends Controller
{
    function getView()
    {
        $model = new BhxhModel();
        $bhxh_list = $model->getEmployeeBHXH();
//        dd($bhxh_list->toArray());
        return view('auth.bhxh.index-bhxh', compact('bhxh_list'));
    }

    public function edit($id)
    {
        $model = new BhxhModel();
        $bhxh = $model->getBHXHEmployeeCurrent($id);

        return response()->json([
            'bhxh' => $bhxh
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'salary_coefficient' => 'nullable|numeric',
            'allowance_salary_coefficient' => 'nullable|numeric',
        ]);

        $employee_id = DB::table('bao_hiem_xh')
            ->where('bhxh_id', $id)
            ->value('employee_id');

        $salary_id = DB::table('salaries')
            ->where('employee_id', $employee_id)
            ->value('salary_id');

        $salary = SalaryModel::findOrFail($salary_id);
        $salary->update($validated);

        // Tính toán và cập nhật BHXH
        $salaryModel = new BhxhModel();
        $salaryModel->calculateAndUpdateBHXH($salary_id);

        // Tính toán và cập nhật Salary
        $salaryModel = new SalaryModel();
        $salaryModel->calculateAndUpdateSalary($salary_id);

        return response()->json([
            'success' => true,
        ]);
    }

    public function exportExcel()
    {
        $inputFileName = public_path('excel-example/bangtinhbhxhexport.xlsx');

        $inputFileType = IOFactory::identify($inputFileName);

        $objReader = IOFactory::createReader($inputFileType);

        $excel = $objReader->load($inputFileName);

        $excel->setActiveSheetIndex(0);
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');

        $stt = 1;
        $cell = $excel->getActiveSheet();

        $model = new BhxhModel();
        $bhxh = $model->getEmployeeBHXH();
        $num_row = 9;

        foreach ($bhxh as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $row->first_name.' '.$row->last_name);
            $cell->setCellValue('C' . $num_row, $row->job_position_name . ' - ' . $row->job_level);
            $cell->setCellValue('D' . $num_row, $row->salary_code);
            $cell->setCellValue('E' . $num_row, $row->salary_coefficient);
            $cell->setCellValue('F' . $num_row, $row->allowance_salary_coefficient);
            $cell->setCellValue('G' . $num_row, ($row->salary_coefficient + $row->allowance_salary_coefficient));
            $cell->setCellValue('H' . $num_row, $row->tong_hs);
            $cell->setCellValue('I' . $num_row, $row->luong_theo_hs);
            $cell->setCellValue('J' . $num_row, $row->luong_theo_hspc);
            $cell->setCellValue('K' . $num_row, $row->bhxh_capbac);
            $cell->setCellValue('L' . $num_row, $row->bhyt_capbac);
            $cell->setCellValue('M' . $num_row, $row->bhtn_capbac);
            $cell->setCellValue('N' . $num_row, $row->bhtn_capbac);
            $cell->setCellValue('O' . $num_row, $row->bhtn_hscv);
            $cell->setCellValue('P' . $num_row, $row->bhtn_hscv);
            $cell->setCellValue('M' . $num_row, $row->bhtn_hscv);
            $cell->setCellValue('Q' . $num_row, $row->tong_tru_luong);
            $cell->setCellValue('R' . $num_row, $row->bhxh_to_chuc);
            $cell->setCellValue('S' . $num_row, $row->bhyt_to_chuc);
            $cell->setCellValue('T' . $num_row, $row->bhtn_to_chuc);
            $cell->setCellValue('U' . $num_row, $row->bhnn_to_chuc);
            $cell->setCellValue('V' . $num_row, $row->tong_to_chuc);
            $cell->setCellValue('W' . $num_row, ($row->tong_tru_luong + $row->tong_to_chuc));

            $borderStyle = $cell->getStyle('A'.$num_row.':W' . $num_row)->getBorders();
            $borderStyle->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $cell->getStyle('A'.$num_row.':W' . $num_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // Định dạng tiền tệ VND cho các cột từ H đến M
            foreach (range('H', 'W') as $columnID) {
                $cell->getStyle($columnID . $num_row)->getNumberFormat()->setFormatCode('#,##0');
            }

            $num_row++;
        }
        foreach (range('A', 'W') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename = "Bang Tinh BHXH" . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Xóa tất cả buffer trước khi xuất dữ liệu
        ob_end_clean();

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
    }





}
