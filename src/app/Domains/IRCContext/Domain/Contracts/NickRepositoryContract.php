<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Domain\Contracts;

use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Domain\ValueObjects\{NickId, NickName};

interface NickRepositoryContract
{
    public function list(): array;

    public function find(NickId $id): Nick|bool;

    public function findByName(NickName $name): Nick|bool;

    public function create(Nick $nick): Nick;

    public function update(NickId $id, Nick $nick): bool;

    public function delete(NickId $id): bool;
}
