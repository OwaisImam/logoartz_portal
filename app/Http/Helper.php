<?php

namespace App\Http;

use Illuminate\Support\Facades\DB;

class Helper
{

    public static function getPrefix($nature = 'digitizing', $orderType)
    {
        $prefix = "";

        if ($nature === 'digitizing') {
            $prefix .= "D";
        } else if ($nature === 'vector') {
            $prefix .= "V";
        }

        if (in_array($orderType, [0, 5, 3, 9, 7])) {
            $prefix .= 'O';
        } else if (in_array($orderType, [2, 8])) {
            $prefix .= 'Q';
        } else if (in_array($orderType, [4])) {
            $prefix .= 'Q';
        } else if (in_array($orderType, [1])) {
            $prefix .= 'O';
        }

        return $prefix;
    }

    public static function priceToWords($number)
    {
        $number = number_format($number, 2, '.', ''); // Ensure the number has two decimal places
        $parts = explode('.', $number);

        $integerPart = (int) $parts[0];
        $decimalPart = (int) $parts[1];

        $words = self::numberToWords($integerPart) . " Dollars";

        if ($decimalPart > 0) {
            $words = self::numberToWords($integerPart) . " Dollars";
            $words .= " and " . self::numberToWords($decimalPart) . " Cents";
        }

        return $words . " Only";
    }

    public static function numberToWords($number)
    {
        $units = [
            '',
            'One',
            'Two',
            'Three',
            'Four',
            'Five',
            'Six',
            'Seven',
            'Eight',
            'Nine',
            'Ten',
            'Eleven',
            'Twelve',
            'Thirteen',
            'Fourteen',
            'Fifteen',
            'Sixteen',
            'Seventeen',
            'Eighteen',
            'Nineteen'
        ];

        $tens = [
            '',
            '',
            'Twenty',
            'Thirty',
            'Forty',
            'Fifty',
            'Sixty',
            'Seventy',
            'Eighty',
            'Ninety'
        ];

        $scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

        if ($number == 0) {
            return "Zero";
        }

        $words = [];

        // Handle scaling
        $scale = 0;

        while ($number > 0) {
            $chunk = $number % 1000;

            if ($chunk > 0) {
                $chunkWords = [];

                if ($chunk > 99) {
                    $chunkWords[] = $units[(int) ($chunk / 100)] . " Hundred";
                    $chunk %= 100;
                }

                if ($chunk > 19) {
                    $chunkWords[] = $tens[(int) ($chunk / 10)];
                    $chunk %= 10;
                }

                if ($chunk > 0) {
                    $chunkWords[] = $units[$chunk];
                }

                $chunkWords[] = $scales[$scale];
                $words = array_merge($chunkWords, $words);
            }

            $number = (int) ($number / 1000);
            $scale++;
        }

        return implode(" ", array_filter($words));
    }

    public static function handleDigiFileUploads($files, $categoryCode, $orderId, $countRev, $insertId)
    {
        $count = 1;
        $path = public_path('uploads/orders/digi');
    
        foreach ($files as $file) {
            $filename = "digi_order{$orderId}{$categoryCode}_{$countRev}_{$count}." . $file->getClientOriginalExtension();
    
            // Move the file to the target directory
            $file->move($path, $filename);
    
            // Insert into the database
            DB::table('digi_result_files')->insert([
                'DR_ID' => $insertId,
                'OrderID' => $orderId,
                'File' => $filename,
                'Category' => $categoryCode,
            ]);
    
            $count++;
        }
    }

    public static function handleVectorFileUploads($files, $categoryCode, $orderId, $countRev, $insertId)
    {
        $count = 1;
        $path = public_path('uploads/orders/vector');
    
        foreach ($files as $file) {
            $filename = "vc_{$orderId}{$categoryCode}_{$countRev}_{$count}." . $file->getClientOriginalExtension();
    
            // Move the file to the target directory
            $file->move($path, $filename);
    
            // Insert into the database
            DB::table('vector_result_files')->insert(
            [
                'VR_ID' => $insertId,
                'VectorOrderID' => $orderId,
                'File' => $filename,
                'Category' => $categoryCode,
            ]);
    
            $count++;
        }
    }
}
