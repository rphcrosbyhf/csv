<?php declare(strict_types = 1);

namespace HelloFresh\Csv\Rule;

/**
 * Represents a null rule that always throws an exception when checked
 */
final class NullRule implements RuleInterface
{
    /**
     * {@inheritdoc}
     */
    public function check(string $value) : void
    {
        throw new RuleException('There was no matching rule found');
    }
}