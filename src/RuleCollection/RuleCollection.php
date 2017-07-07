<?php declare(strict_types = 1);

namespace HelloFresh\Csv\RuleCollection;

use HelloFresh\Csv\Rule\NullRule;
use HelloFresh\Csv\Rule\RuleInterface;

/**
 * Represents a collection of rules
 */
final class RuleCollection implements RuleCollectionInterface
{
    /**
     * @var array
     */
    private $rules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function withRule(string $key, RuleInterface $rule) : RuleCollectionInterface
    {
        return new self(array_merge($this->rules, [$key => $rule]));
    }

    /**
     * {@inheritdoc}
     */
    public function rule(string $key) : RuleInterface
    {
        return $this->rules[$key] ?? new NullRule();
    }
}