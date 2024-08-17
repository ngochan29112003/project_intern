<?php

namespace App\Http\Controllers;

use App\Models\RewardModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RewardController extends Controller
{
    function getView()
    {
        $model = new RewardModel();
        $reward_list = $model->getReward();
        $reward_type_list = $model->getRewardType();
        $employee_list = $model->getEmployee();
//        dd($reward_list);
        return view('auth.reward.index-reward',
            compact('reward_list', 'employee_list', 'reward_type_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_reward_type' => 'int',
            'add_employee_id' => 'int',
        ]);

       RewardModel::create([
            'type_reward_id' =>$validated['add_reward_type'],
            'employee_id' =>$validated['add_employee_id'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Reward added successfully',
        ]);
    }

    public function delete($id)
    {
        $reward = RewardModel::findOrFail($id);

        $reward->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reward deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $reward = RewardModel::findOrFail($id);
        return response()->json([
            'reward' => $reward
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type_reward_id' => 'int',
            'employee_id' => 'int',
        ]);
        $reward = RewardModel::findOrFail($id);
        $reward->update($validated);

        return response()->json([
            'success' => true,
            'reward' => $reward,
        ]);
    }

    public function exportExcel()
    {
        $inputFileName = public_path('excel-example/bangkhenthuongexport.xlsx');

        $inputFileType = IOFactory::identify($inputFileName);

        $objReader = IOFactory::createReader($inputFileType);

        $excel = $objReader->load($inputFileName);

        $excel->setActiveSheetIndex(0);
        $excel->getDefaultStyle()->getFont()->setName('Times New Roman');

        $stt = 1;
        $cell = $excel->getActiveSheet();

        $model = new RewardModel();
        $leave_report = $model->getReward();
        $num_row = 3;

        foreach ($leave_report as $row) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $row->type_reward_name);
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
        $filename = "danh-sach-khen-thuong" . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Xóa tất cả buffer trước khi xuất dữ liệu
        ob_end_clean();

        $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer->save('php://output');
    }
}
