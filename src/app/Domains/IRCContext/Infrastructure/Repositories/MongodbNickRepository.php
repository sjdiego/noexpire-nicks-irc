<?php declare(strict_types=1);

namespace App\Domains\IRCContext\Infrastructure\Repositories;

use App\Domains\IRCContext\Domain\Contracts\NickRepositoryContract;
use App\Domains\IRCContext\Domain\Nick;
use App\Domains\IRCContext\Domain\ValueObjects\{NickId, NickIsActive, NickLastUse, NickName, NickPassword, NickUserId};
use App\Models\Nick as EloquentMongodbModel;

class MongodbNickRepository implements NickRepositoryContract
{
    private EloquentMongodbModel $eloquentMongodbModel;

    public function __construct()
    {
        $this->eloquentMongodbModel = new EloquentMongodbModel();
    }

    public function list(): array
    {
        $data = $this->eloquentMongodbModel->all();

        return $data->map(function ($eloquentNick) {
            $nick = new Nick(
                name:       new NickName($eloquentNick->name),
                password:   new NickPassword($eloquentNick->password),
                isActive:   new NickIsActive($eloquentNick->is_active),
                lastUse:    new NickLastUse($eloquentNick->last_use),
                userId:     new NickUserId($eloquentNick->user->id)
            );

            $nick->setId($eloquentNick->id);

            return $nick;
        })->toArray();
    }

    public function find(NickId $id): Nick|bool
    {
        $eloquentNick = $this->eloquentMongodbModel->find($id->value());

        if ($eloquentNick) {
            $nick = new Nick(
                name:       new NickName($eloquentNick->name),
                password:   new NickPassword($eloquentNick->password),
                isActive:   new NickIsActive($eloquentNick->is_active),
                lastUse:    new NickLastUse($eloquentNick->last_use),
                userId:     new NickUserId($eloquentNick->user_id)
            );

            $nick->setId($eloquentNick->id);

            return $nick;
        }

        return false;
    }

    public function findByName(NickName $name): Nick|bool
    {
        $eloquentNick = $this
            ->eloquentMongodbModel
            ->whereName($name->value())
            ->first();

        if ($eloquentNick &&
            mb_strtolower($eloquentNick->name) === mb_strtolower($name->value())
        ) {
            $nick = new Nick(
                name:       new NickName($eloquentNick->name),
                password:   new NickPassword($eloquentNick->password),
                isActive:   new NickIsActive($eloquentNick->is_active),
                lastUse:    new NickLastUse($eloquentNick->last_use),
                userId:     new NickUserId($eloquentNick->user_id)
            );

            $nick->setId($eloquentNick->id);

            return $nick;
        }

        return false;
    }

    public function create(Nick $nick): Nick
    {
        $eloquentNick = $this->eloquentMongodbModel->create([
            'name'      => $nick->getName()->value(),
            'password'  => $nick->getPassword()->value(),
            'is_active' => $nick->getIsActive()->value(),
            'last_use'  => $nick->getLastUse()->value(),
            'user_id'   => $nick->getUserId()->value(),
        ]);

        $nick = new Nick(
            name:       new NickName($eloquentNick->name),
            password:   new NickPassword($eloquentNick->password),
            isActive:   new NickIsActive($eloquentNick->is_active),
            lastUse:    new NickLastUse($eloquentNick->last_use),
            userId:     new NickUserId($eloquentNick->user->id)
        );

        $nick->setId($eloquentNick->id);

        return $nick;
    }

    public function update(NickId $id, Nick $nick): bool
    {
        $attributes = [
            'name'      => $nick->getName()->value(),
            'password'  => $nick->getPassword()->value(),
            'is_active' => $nick->getIsActive()->value(),
            'last_use'  => $nick->getLastUse()->value(),
            'user_id'   => $nick->getUserId()->value()
        ];

        return $this->eloquentMongodbModel->findOrFail($id->value())->update($attributes);
    }

    public function delete(NickId $id): bool
    {
        return $this->eloquentMongodbModel->findOrFail($id->value())->delete();
    }
}
