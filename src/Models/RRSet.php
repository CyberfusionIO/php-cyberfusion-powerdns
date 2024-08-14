<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Cyberfusion\PowerDNS\Enums\ChangeType;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RRSet implements Requestable, Responsable
{
    private string $name;

    private string $type;

    private ?int $ttl;

    private ChangeType $changeType;

    /** @var Record[] */
    private array $records;

    /** @var Comment[] */
    private array $comments;

    public function __construct(
        string $name = '',
        string $type = '',
        ?int $ttl = 3600,
        ChangeType $changeType = ChangeType::Replace,
        array $records = [],
        array $comments = [],
    ) {
        $this
            ->setName($name)
            ->setType($type)
            ->setTtl($ttl)
            ->setChangeType($changeType)
            ->setRecords($records)
            ->setComments($comments);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): RRSet
    {
        $this->name = Str::finish($name, '.');

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): RRSet
    {
        $this->type = $type;

        return $this;
    }

    public function getTtl(): ?int
    {
        return $this->ttl;
    }

    public function setTtl(?int $ttl): RRSet
    {
        $this->ttl = $ttl;

        return $this;
    }

    public function getChangeType(): ChangeType
    {
        return $this->changeType;
    }

    public function setChangeType(ChangeType $changeType): self
    {
        // When the changetype is delete, the ttl, records and comments must be empty
        if ($changeType === ChangeType::Delete) {
            $this->ttl = null;
            $this->records = [];
            $this->comments = [];
        }

        $this->changeType = $changeType;

        return $this;
    }

    public function getRecords(): array
    {
        return $this->records;
    }

    public function setRecords(array $records): RRSet
    {
        $this->records = $records;

        return $this;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments(array $comments): RRSet
    {
        $this->comments = $comments;

        return $this;
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            name: Arr::get($data, 'name', ''),
            type: Arr::get($data, 'type', ''),
            ttl: Arr::get($data, 'ttl', 3600),
            changeType: Arr::get($data, 'changetype')
                ? ChangeType::from(Arr::get($data, 'changetype'))
                : ChangeType::Replace,
            records: array_map(
                fn(array $record) => Record::fromResponse($record),
                Arr::get($data, 'records', []),
            ),
            comments: array_map(
                fn(array $comment) => Comment::fromResponse($comment),
                Arr::get($data, 'comments', []),
            ),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'ttl' => $this->ttl,
            'changetype' => $this
                ->changeType
                ->value,
            'records' => array_map(
                fn(Record $record) => $record->toArray(),
                $this->records,
            ),
            'comments' => array_map(
                fn(Comment $comment) => $comment->toArray(),
                $this->comments,
            ),
        ];
    }
}
