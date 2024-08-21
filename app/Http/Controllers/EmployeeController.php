<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\JobDetailsModel;
use App\Models\SalaryModel;
use App\Models\TaskModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class EmployeeController extends Controller
{
    public function getView()
    {
        $model = new EmployeeModel();
        $employee_list = $model->getEmployeeInfo();
        return view('auth.employees.index-employee',
            compact('employee_list',
            ));
    }

    public function detailEmployee()
    {

        return view('auth.employees.details-employee');
    }

    public function add(Request $request)
    {
//        dd($request);
        $validated = $request->validate([
            'img'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'first_name'         => 'required|string',
            'last_name'          => 'required|string',
            'birth_date'         => 'required|date',
            'birth_place'        => 'nullable|string',
            'ethnic'             => 'nullable|string',
            'religion'           => 'nullable|string',
            'gender'             => 'nullable|int',
            'marital_status'     => 'nullable|int',
            'nation'             => 'nullable|string',
            'email'              => 'nullable|string',
            'phone_number'       => 'nullable|string',
            'place_of_resident'  => 'nullable|string',
            'permanent_address'  => 'nullable|string',
            'cic_number'         => 'nullable|string',
            'place_of_issue'     => 'nullable|string',
            'date_of_issue'      => 'nullable|date',
            'job_position_code'  => 'nullable|string',
            'job_position_id'    => 'nullable|int',
            'job_level'          => 'nullable|int',
            'salary_code'        => 'nullable|string',
            'department_id'      => 'nullable|int',
            'type_employee_id'   => 'nullable|int',
            'education_level_id' => 'nullable|int',
            'status'             => 'nullable|int',
        ]);

        $imagePath = 'avt.png';
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/employee_img/'), $imagePath);
        }

        $employee = EmployeeModel::create(array_merge($validated,
            ['img' => $imagePath]));

        // Thêm bản ghi trong bảng lương cho nhân viên mới
        SalaryModel::create(['employee_id' => $employee->employee_id]);
        JobDetailsModel::create([
            'employee_id'     => $employee->employee_id,
            'job_position_id' => $validated['job_position_id'],
            'job_level'       => $validated['job_level'],   // Thêm job_level
            'salary_code'     => $validated['salary_code'], // Thêm salary_code
        ]);
        return response()->json([
            'success' => true,
            'status'  => 200,
            'message' => 'Thêm nhân viên mới thành công',
        ]);
    }

    public function delete($id)
    {
        $employee = EmployeeModel::findOrFail($id);

        $directoryPath = public_path('assets/employee_img/');
        $filePath = $directoryPath . $employee->img;

        if (file_exists($filePath) && $employee->img !== 'avt.png') {
            unlink($filePath);
        }

        $employee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name'         => 'string',
            'last_name'          => 'string',
            'gender'             => 'string',
            'img'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'email'              => 'string',
            'cic_number'         => 'string',
            'birth_date'         => 'date',
            'birth_place'        => 'string',
            'place_of_residencs' => 'string',
            'permanent_address'  => 'string',
            'education_level_id' => 'int',
            'status'             => 'int',
            'type_employee_id'   => 'int',
            'job_position_id'    => 'int',
            'department_id'      => 'int',
        ]);

        $employee = EmployeeModel::findOrFail($id);

        // Lấy đường dẫn hình ảnh cũ
        $imageOld = $employee->img;

        $imagePath = $imageOld;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $imagePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/employee_img/'), $imagePath);

            // Xóa hình ảnh cũ nếu có
            if ($imageOld
                && file_exists(public_path('assets/employee_img/' . $imageOld))
            ) {
                unlink(public_path('assets/employee_img/' . $imageOld));
            }
        }

        // Cập nhật thông tin nhân viên
        $employee->update(array_merge($validated, ['img' => $imagePath]));

        return response()->json([
            'success'  => true,
            'employee' => $employee,
        ]);
    }

    public function edit($id)
    {
//        dd($id);
        $employee = EmployeeModel::findOrFail($id);
        return response()->json([
            'employee' => $employee
        ]);
    }

    public function exportExcel()
    {
        $inputFileName
            = public_path('excel-example/dsthongtinnhanvienexport.xlsx');

        $inputFileType = IOFactory::identify($inputFileName);

        $objReader = IOFactory::createReader($inputFileType);

        $excel = $objReader->load($inputFileName);

        $excel->setActiveSheetIndex(0);
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');

        $stt = 1;
        $cell = $excel->getActiveSheet();

        $model = new EmployeeModel();
        $leave_report = $model->getEmployeeInfo();
        $num_row = 3;

        foreach ($leave_report as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row,
                $row->first_name . ' ' . $row->last_name);
            if ($row->gender === 0) {
                $cell->setCellValue('C' . $num_row, 'Nam');
            } else {
                $cell->setCellValue('C' . $num_row, 'Nữ');
            }
            $cell->setCellValue('D' . $num_row, $row->birth_date);
            $cell->setCellValue('E' . $num_row, $row->birth_place);
            $cell->setCellValue('F' . $num_row, $row->place_of_resident);
            $cell->setCellValue('G' . $num_row, $row->permanent_address);
            $cell->setCellValue('H' . $num_row, $row->education_level_name);
            $cell->setCellValue('I' . $num_row, $row->cic_number);
            $cell->setCellValue('J' . $num_row, $row->job_position_name);
            $cell->setCellValue('K' . $num_row, $row->type_employee_name);
            $cell->setCellValue('L' . $num_row, $row->department_name);
            $cell->setCellValue('M' . $num_row, $row->email);
            if ($row->status === 0) {
                $cell->setCellValue('N' . $num_row, 'Đã nghỉ việc');
            } else {
                $cell->setCellValue('N' . $num_row, 'Đang làm việc');
            }

            $borderStyle = $cell->getStyle('A' . $num_row . ':N' . $num_row)
                ->getBorders();
            $borderStyle->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $cell->getStyle('A' . $num_row . ':N' . $num_row)->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $num_row++;
        }
        foreach (range('A', 'N') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename = "danh-sach-thong-tin-nhan-vien" . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Xóa tất cả buffer trước khi xuất dữ liệu
        ob_end_clean();

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
    }

    public function getViewAddEmployee()
    {
        $model = new EmployeeModel();
        $edu_level_list = $model->getEdulevel();
        $position_list = $model->getPosition();
        $type_employee_list = $model->getTypeEmployees();
        $department_list = $model->getDepartment();
        return view('auth.employees.add-employee-index',
            compact('edu_level_list', 'position_list', 'type_employee_list',
                'department_list'));
    }
}
