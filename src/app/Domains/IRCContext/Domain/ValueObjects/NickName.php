<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\ValueObjects;

final class NickName
{
    const NICK_PATTERN = "/^[a-zA-Z\\[\\]\\\\`_\\^\\{\\|\\}\\~][a-zA-Z0-9\\[\\]\\\\`_\\^\\{\\|\\}\\~\\-]{0,29}$/";

    private string $value;

    public function __construct(string $name)
    {
        if (!$this->validate($name)) {
            throw new \InvalidArgumentException(
                sprintf('%s does not fit validation for a nickname', $name)
            );
        }
        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function validate(string $name): bool
    {
        return (bool) filter_var($name, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => self::NICK_PATTERN
            ]
        ]);
    }
}
