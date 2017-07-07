<?php declare(strict_types = 1);

namespace Tests\HelloFresh\Csv;

use HelloFresh\Csv\File\CsvFile;
use PHPUnit\Framework\TestCase;

final class CsvFileTest extends TestCase
{
    /**
     * @return void
     */
    public function testThatItReadsACsvFile() : void
    {
        $file = new CsvFile(
            new \SplFileObject(
                __DIR__ . '/fixtures/test.csv',
                'r'
            )
        );
    }
}
