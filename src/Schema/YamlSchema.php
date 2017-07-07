<?php declare(strict_types = 1);

namespace HelloFresh\Csv\Schema;

use HelloFresh\Csv\Rule\CombinedRule;
use HelloFresh\Csv\Rule\MinLengthRule;
use HelloFresh\Csv\Rule\NullRule;
use HelloFresh\Csv\Rule\RuleInterface;
use HelloFresh\Csv\RuleCollection\RuleCollection;
use HelloFresh\Csv\RuleCollection\RuleCollectionInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Represents a schema defined in YAML
 */
final class YamlSchema implements SchemaInterface
{
    /**
     * @var \SplFileObject
     */
    private $file;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @param \SplFileObject $file
     * @param Parser $parser
     */
    public function __construct(\SplFileObject $file, Parser $parser)
    {
        $this->file = $file;
        $this->parser = $parser;
    }

    /**
     * {@inheritdoc}
     */
    public function rules() : RuleCollectionInterface
    {
        $rules = array_map(function (array $field) : RuleInterface {
            return new CombinedRule(array_map(function (string $constraint, string $rule) use ($field) : RuleInterface {
                return $this->resolveRule($rule, $constraint, $field['name']);
            }, $field['rules'], array_keys($field['rules'])));
        }, $this->fields());

        return new RuleCollection($rules);
    }

    /**
     * @return array
     */
    private function fields() : array
    {
        return $this->parser->parse($this->file->fread($this->file->getSize()))['fields'] ?? [];
    }

    /**
     * @param string $name
     * @param string $constraint
     * @param string $key
     *
     * @return RuleInterface
     */
    private function resolveRule(string $name, string $constraint, string $key) : RuleInterface
    {
        switch ($name) {
            case 'minLength':
                return new MinLengthRule((int) $constraint, $key);
                break;
        }

        return new NullRule();
    }
}