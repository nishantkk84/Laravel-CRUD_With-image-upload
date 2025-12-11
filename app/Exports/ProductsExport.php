<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProductsExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    WithStyles, 
    WithDrawings, 
    ShouldAutoSize
{
    private $products;

    public function collection()
    {
        return $this->products = Product::all();
    }

    public function headings(): array
    {
        return [
            'Image',
            'ID',
            'Product Name',
            'Price (¥)',
            'Description',
        ];
    }

    public function map($product): array
    {
        return [
            '',                     // image placeholder
            $product->id,
            $product->name,
            $product->price,
            $product->description,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header row style
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => '333333'],
            ],
        ]);

        // Wrap text in description column
        $sheet->getStyle('E')->getAlignment()->setWrapText(true);

        return [];
    }


    public function drawings()
    {
        $drawings = [];

        foreach ($this->products as $index => $product) {

            if (!$product->image) {
                continue;
            }

            $drawing = new Drawing();
            $drawing->setName('Product Image');
            $drawing->setDescription('Product Image');

            // IMPORTANT → Update path if needed
            $drawing->setPath(public_path('uploads/' . $product->image));

            // Set image size
            $drawing->setHeight(60);

            // Image goes in column A, starting from row 2
            $drawing->setCoordinates('A' . ($index + 2));

            $drawings[] = $drawing;
        }

        return $drawings;
    }
}
