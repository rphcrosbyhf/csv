<?php declare(strict_types = 1);

namespace HelloFresh\Csv\Rule;

/**
 * A rule that checks if a value is longer than a minimum
 */
final class MinLengthRule implements RuleInterface
{
    /**
     * @var int
     */
    private $minimum;

    /**
     * @var string
     */
    private $key;

    /**
     * @param int $minimum
     * @param string $key
     */
    public function __construct(int $minimum, string $key)
    {
        $this->minimum = $minimum;
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function check(string $value) : void
    {
        if (strlen($value) < $this->minimum) {
            throw new RuleException(
                sprintf(
                    'The value for %s was expected to be at least %d characters long',
                    $this->key,
                    $this->minimum
                )
            );
        }
    }
}