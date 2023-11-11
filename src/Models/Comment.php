<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Cyberfusion\PowerDNS\Exceptions\CommentException;
use DateTimeInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Comment implements Requestable, Responsable
{
    private string $content;

    private string $account;

    private ?DateTimeInterface $modifiedAt;

    public function __construct(
        string $content = '',
        string $account = '',
        DateTimeInterface $modifiedAt = null
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
        if (Str::length($account) > 40) {
            throw CommentException::accountLengthExceeded();
        }

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

    public static function fromResponse(array $data): self
    {
        return new self(
            content: Arr::get($data, 'content', ''),
            account: Arr::get($data, 'account', ''),
            modifiedAt: Arr::get($data, 'modified_at')
                ? Carbon::createFromTimestamp(Arr::get($data, 'modified_at'))
                : null
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
