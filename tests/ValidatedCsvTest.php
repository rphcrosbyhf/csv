<?php declare(strict_types = 1);

namespace Tests\HelloFresh\Csv;

use HelloFresh\Csv\File\CsvFile;
use HelloFresh\Csv\Rule\MinLengthRule;
use HelloFresh\Csv\RuleCollection\RuleCollection;
use HelloFresh\Csv\File\ValidatedCsvFile;
use PHPUnit\Framework\TestCase;

final class ValidatedCsvTest extends TestCase
{
    /**
     * @return void
     */
    public function testThatItValidatesACsv() : void
    {
        $csv = new ValidatedCsvFile(
            new CsvFile(new \SplFileObject(__DIR__ . '/fixtures/test.csv')),
            new RuleCollection([
                'header_1' => new MinLengthRule(20, 'header_1')
            ])
        );

        iterator_to_array($csv->rows());
    }
}
