<?php

namespace App\Exports;

use App\Models\History;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class UsersExport implements FromCollection, WithHeadingRow, WithHeadings, ShouldAutoSize, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $validated;

    public function __construct($validated)
    {
        // $this->category = $category;
        // dd($validated);
        $this->validated = $validated;

    }  

    public function headings():array {
        return [
        [
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            'History Logs',
        ]
        ,[
            // 'ID',
            'ID', // Transaction ID
            'Name',
            // 'Address',
            // 'Email',
            // '#',
            'Item Name',
            // 'Brand',
            'Category',
            'Quantity',
            // 'Days Duration',
            'Date Picked Up',
            'Date Returned',
            'Late Status',
            'Remark',
            'Created At',
            // 'Note',
            // 'Transaction Complete Date',
            // ''
        ]
    ];
    }

    public function styles(Worksheet $sheet) {
        $sheet->getStyle('A2:J2')->getFill()->applyFromArray([
            'fillType' => 'solid', 'rotation' => 0,
            'color' => ['rgb' => '21262D'],
        ]);
        $sheet->getStyle('A1:J1')->getFill()->applyFromArray([
            'fillType' => 'solid', 'rotation' => 0,
            'color' => ['rgb' => '000000'],
        ]);
        $sheet->getStyle('A1:J1')
                ->getFont()
                ->setBold(true)
                ->setColor(new Color('FFFFFF'));
        $sheet->getStyle('A2:J2')
                ->getFont()
                ->setBold(true)
                ->setColor(new Color('FFFFFF'));
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_LEGAL);
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE); 
        //Center Functions
        $styleArray = [
            'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,],
            ];
            //centering items
            $sheet->getStyle('A1:I1')->applyFromArray($styleArray);
            $sheet->getStyle('A')->applyFromArray($styleArray);
            $sheet->getStyle('E')->applyFromArray($styleArray);
            $sheet->getStyle('F')->applyFromArray($styleArray);
            $sheet->getStyle('I')->applyFromArray($styleArray);
            $sheet->getStyle('G')->applyFromArray($styleArray);
            $sheet->getStyle('D')->applyFromArray($styleArray);
            $sheet->getStyle('H')->applyFromArray($styleArray);
            $sheet->getStyle('J')->applyFromArray($styleArray);
    }   

  
    public function collection()
    {
        $array = $this->validated;
        //date
        $date = $this->validated["date"];
        
        if($date != "all"){
            $datereq = $this->validated["item_requested_at"];
            $dateret = $this->validated["item_returned"];
        }else{
            $datereq = "";
            $dateret = "";
        }
            
        //category
        $select_cat =  $this->validated["select_cat"];

        $status = $this->validated["status"];
        $remarks = $this->validated["remarks"];   
        //filtering
        if($select_cat != 'on_cat'){
            $query = History::query();
            foreach($array as $arr){
                $filteredHistories = $query->orWhere('history_category', '=', $arr);
            }
            $filteredHistories = $query->get([
                'transaction_id',
                'history_cus_name',
                'history_item',
                'history_category',
                'history_quantity', 
                'history_pickup', 
                'history_returned', 
                'history_late', 
                'history_remarks',
                'created_at'
            ]); 
        } else {
            $filteredHistories = History::all([
                'transaction_id',
                'history_cus_name',
                'history_item',
                'history_category',
                'history_quantity', 
                'history_pickup', 
                'history_returned', 
                'history_late', 
                'history_remarks',
                'created_at' 
            ]); 
        }
        // date filtering        
        $date = $this->validated["date"];
        if ($date != "all") {
            $datereq = $this->validated["item_requested_at"];
            $dateret = $this->validated["item_returned"];
            $filteredHistories = $filteredHistories->filter(function ($history) use ($datereq, $dateret) {
                $created_at = $history->created_at->format('Y-m-d');
                return $created_at >= $datereq && $created_at <= $dateret;
            });
        }

        // status filtering
        if($status == "Late"){
            $filteredHistories = $filteredHistories->filter(function ($history) {
                $stat = $history->history_late;
                return Str::contains($stat, 'Late');
            });
        } else if($status == "On Time") {
            $filteredHistories = $filteredHistories->filter(function ($history) {
                $stat = $history->history_late;
                return $stat == "On time";
            });
        }

        // remarks filtering
        if($remarks == "Returned") {
            $filteredHistories = $filteredHistories->filter(function ($history) {
                $rem = $history->history_remarks;
                return $rem == "Returned";
            });
        } else if($remarks == "Outbound") {
            $filteredHistories = $filteredHistories->filter(function ($history) {
                $rem = $history->history_remarks;
                return $rem == "Outbound";
            });
        } 

        return $filteredHistories;
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,     
            'C' => 30, 
            'F' => 15, 
            'G' => 15,
            'H' => 15, 
            'J' => 30,      
        ];
    }

    // public function listdata()
    // {
    //     $pdf = Pdf::loadView('pdf.test_pdf')->setPaper('a4', 'landscape');
    //     return $pdf->stream('test_pdf.pdf');
    // }
}
