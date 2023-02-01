<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use stdClass;

class Record implements Responsable, Requestable
{
    private string $content;

    private bool $disabled;

    public function __construct(
        string $content = '',
        bool $disabled = false
    ) {
        $this
            ->setContent($content)
            ->setDisabled($disabled);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Record
    {
        $this->content = $content;

        return $this;
    }

    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled): Record
    {
        $this->disabled = $disabled;

        return $this;
    }

    public static function fromResponse(stdClass $data): self
    {
        return new self(
            content: $data->content,
            disabled: $data->disabled,
        );
    }

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'disabled' => $this->disabled,
        ];
    }
}
