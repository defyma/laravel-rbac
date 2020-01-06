<?php

namespace defyma\LaraRbac\Contracts;

/**
 * Interface Model
 *
 * @package defyma\LaraRbac\Contracts
 *
 * @author Andrey Girnik <girnikandrey@gmail.com>
 */
interface Model
{
    /**
     * Get Author id which related with user model record.
     *
     * @return int
     */
    public function getAuthorIdAttribute(): int;
}
