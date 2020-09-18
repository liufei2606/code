<?php

namespace DesignPatterns\Behavioral\Visitor;

/**
 * 访问者接口
 */
interface RoleVisitorInterface
{
    /**
     * 访问 User 对象
     *
     * @param  \DesignPatterns\Behavioral\Visitor\User  $role
     */
    public function visitUser(User $role);

    /**
     * 访问 Group 对象
     *
     * @param  \DesignPatterns\Behavioral\Visitor\Group  $role
     */
    public function visitGroup(Group $role);
}