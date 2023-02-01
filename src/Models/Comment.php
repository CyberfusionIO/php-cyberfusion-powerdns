<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use stdClass;

class Comment implements Responsable, Requestable
{
    private string $content;

    private string $account;

    private ?DateTimeInterface $modifiedAt;

    public function __construct(
        string $content = '',
        string $account = '',
        ?DateTimeInterface $modifiedAt = null
    ) {
        $this
            ->setContent($content)
            ->setAccount($account)
            ->setModifiedAt($modifiedAt);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function setAccount(string $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getModifiedAt(): ?DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public static function fromResponse(stdClass $data): self
    {
        return new self(
            content: $data->content,
            account: $data->account,
            modifiedAt: Carbon::createFromTimestamp($data->modified_at)
        );
    }

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'account' => $this->account,
            'modified_at' => $this
                ->modifiedAt
                ->getTimestamp(),
        ];
    }
}
