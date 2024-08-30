<?php

namespace App\Http\Controllers;

use App\Models\SalaryModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SalaryController extends Controller
{
    public function getView()
    {
        $model = new SalaryModel();
        $salaries = $model->getSalaryEmployee();
//        dd($salaries->toArray());
        return view('auth.salaries.index-salary-calculation', compact('salaries'));
    }

    public function edit($id)
    {
        $model = new SalaryModel();
        $salary = $model->getSalaryEmployeeCurrent($id);

        return response()->json([
            'salary' => $salary
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'salary_coefficient' => 'nullable|numeric',
            'allowance_salary_coefficient' => 'nullable|numeric',
            'salary_entitlement' => 'nullable|numeric',
        ]);

        $salary = SalaryModel::findOrFail($id);
        $salary->update($validated);

        // Tính toán và cập nhật lương ngay sau khi cập nhật
        $salaryModel = new SalaryModel();
        $salaryModel->calculateAndUpdateSalary($id);

        return response()->json([
            'success' => true,
        ]);
    }

    public function exportExcel()
    {
        $inputFileName = public_path('excel-example/bangluongexport.xlsx');

        $inputFileType = IOFactory::identify($inputFileName);

        $objReader = IOFactory::createReader($inputFileType);

        $excel = $objReader->load($inputFileName);

        $excel->setActiveSheetIndex(0);
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');

        $stt = 1;
        $cell = $excel->getActiveSheet();

        $model = new SalaryModel();
        $salaries = $model->getSalaryEmployee();
        $num_row = 6;

        foreach ($salaries as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $row->first_name.' '.$row->last_name);
            $cell->setCellValue('C' . $num_row, $row->job_position_name . ' - ' . $row->job_level);
            $cell->setCellValue('D' . $num_row, $row->salary_code);
            $cell->setCellValue('E' . $num_row, $row->salary_coefficient);
            $cell->setCellValue('F' . $num_row, $row->allowance_salary_coefficient);
            $cell->setCellValue('G' . $num_row, ($row->salary_coefficient + $row->allowance_salary_coefficient));
            $cell->setCellValue('H' . $num_row, $row->gross_salary);
            $cell->setCellValue('I' . $num_row, $row->social_insurance);
            $cell->setCellValue('J' . $num_row, $row->health_insurance);
            $cell->setCellValue('K' . $num_row, $row->accident_insurance);
            $cell->setCellValue('L' . $num_row, ($row->social_insurance + $row->health_insurance + $row->accident_insurance));
            $cell->setCellValue('M' . $num_row, $row->net_salary);

            $borderStyle = $cell->getStyle('A'.$num_row.':M' . $num_row)->getBorders();
            $borderStyle->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $cell->getStyle('A'.$num_row.':M' . $num_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // Định dạng tiền tệ VND cho các cột từ H đến M
            foreach (range('H', 'M') as $columnID) {
                $cell->getStyle($columnID . $num_row)->getNumberFormat()->setFormatCode('#,##0');
            }

            $num_row++;
        }
        foreach (range('A', 'M') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename = "BangLuong" . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Xóa tất cả buffer trước khi xuất dữ liệu
        ob_end_clean();

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
    }
}
