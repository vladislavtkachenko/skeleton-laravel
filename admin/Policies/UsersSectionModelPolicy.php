<?php

namespace Admin\Policies;

use Admin\Http\Sections\Users;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersSectionModelPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Users $section
     * @param User $item
     */
    public function before(User $user, $ability, Users $section, User $item = null)
    {
    }

    /**
     * "Видна ли секция для пользователя"
     *
     * @param User $user
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function display(User $user, Users $section, User $item)
    {
        return true;
    }

    /**
     * Кнопка "Редактировать"
     *
     * @param User $user
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function edit(User $user, Users $section, User $item)
    {
        return !$item->is_admin || $user->is_super_admin;
    }

    /**
     * Кнопка "Удалить"
     *
     * @param User $user
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function delete(User $user, Users $section, User $item)
    {
        return !$item->is_super_admin && $item->id != $user->id;
    }
}