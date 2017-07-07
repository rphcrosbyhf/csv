<?php declare(strict_types = 1);

namespace Tests\HelloFresh\Csv\Schema;

use HelloFresh\Csv\Schema\YamlSchema;
use PHPUnit\Framework\TestCase;

final class YamlSchemaTest extends TestCase
{
    /**
     * @return void
     */
    public function testThatItReturnsRules() : void
    {
        $schema = new YamlSchema(__DIR__ . '/../fixtures/schema.yaml');
    }
}
