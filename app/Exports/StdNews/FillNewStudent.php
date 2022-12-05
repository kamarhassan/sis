<?php

namespace App\Exports\StdNews;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
// use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;


class FillNewStudent implements WithTitle, WithEvents, WithHeadings, WithColumnWidths //,WithColumnFormatting
{
    use RegistersEventListeners, Exportable;
  
    public function title(): string
    {
        return 'Fill New Student';
    }
    public function headings(): array
    {

        return [
            // 'sejel number',
            // 'sejel location',
            // 'location born',
            // 'students birthday',
            // 'phone number',
            // 'E-mail',
            // 'Last Name',
            // 'Middle Name',
            // 'First Name',
            __('site.sejel number'),
            __('site.sejel location'),
            __('site.location born'),
            __('site.students birthday'),
            "",
            "",
            __('site.phone number'),
            __('site.E-mail'),
            __('site.Last Name'),
            __('site.Middle Name'),
            __('site.First Name'),
        ];
    }
    public function  registerEvents(): array
    {


        return [
            AfterSheet::class    => function (AfterSheet $event) {
                // $range = ;
                $cellRange = 'A3:K100';
                $event->sheet->getStyle($cellRange)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                $this->merge_celles($event->sheet);
                //A2:G10 is the range which can be editable 
                $event->sheet->getDelegate()->getProtection()->setSheet(true);
                // $event->sheet->protectCells('A1:L2', 'PASSWORD');
                $event->sheet->getDelegate()->getProtection()->setPassword('PhpSpreadsheet');

                $conditionalStyles = [];
                $wizardFactory = new Wizard($cellRange);
                /** @var Wizard\Blanks $blanksWizard */
                $blanksWizard = $wizardFactory->newRule(Wizard::BLANKS);
                $redStyle = new Style(false, true);
                $greenStyle = new Style(false, true);

                $greenStyle->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getEndColor()->setARGB(Color::COLOR_WHITE);
                $greenStyle->getFont()->setColor(new Color(Color::COLOR_BLACK));

                $redStyle->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getEndColor()->setARGB('0EEEE7');
                $redStyle->getFont()->setColor(new Color(Color::COLOR_GREEN));

                $blanksWizard->setStyle($redStyle);
                $conditionalStyles[] = $blanksWizard->getConditional();

                $blanksWizard->notBlank()
                    ->setStyle($greenStyle);
                $conditionalStyles[] = $blanksWizard->getConditional();

                $event->sheet->getDelegate()
                    ->getStyle($blanksWizard->getCellRange())
                    ->setConditionalStyles($conditionalStyles);
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,     //  sejel number
            'B' => 15,     //  sejel location
            'C' => 15,     //  location born
            'D' => 10,     //  students birthday day
            'E' => 10,      //  students birthday month
            'F' => 10,     //  students birthday years
            'G' => 18,     // phone
            'H' => 25,     //  Email
            'I' => 18,     //  First Name
            'J' => 18,     //  middle Name
            'K' => 18,     //  last Name

        ];
    }

    private function merge_celles($sheet)
    {
        $sheet->mergeCells('A1:A2');
        $sheet->mergeCells('B1:B2');
        $sheet->mergeCells('C1:C2');
        $sheet->mergeCells('D1:F1');
        $sheet->mergeCells('G1:G2');
        $sheet->mergeCells('H1:H2');
        $sheet->mergeCells('I1:I2');
        $sheet->mergeCells('j1:j2');
        $sheet->mergeCells('k1:k2');


        $sheet->setCellValue('D2',  __('site.students birthday day'));
        $sheet->setCellValue('E2', __('site.students birthday month'));
        $sheet->setCellValue('F2',__('site.students birthday years'));
        // $sheet->cell('E2', function($cell) {

        //     // manipulate the cell
        //     $cell->setValue('data1');
        
        // });
        // $sheet->cell('E2', function ($cells) {
        //     $cells->setValue('data1');
        // });

        // $sheet->mergeCells('F1:F2');
        // $sheet->merge('A1:E1');
    }
}
