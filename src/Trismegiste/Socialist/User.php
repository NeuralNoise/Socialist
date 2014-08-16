<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use Trismegiste\Yuurei\Persistence\Persistable;
use Trismegiste\Yuurei\Persistence\PersistableImpl;

/**
 * User is a user on the net and stored in MongoDb
 * 
 * Like Publishing entity, this is a vertex in the social digraph.
 * It's a rich document in MongoDb
 * It's designated as a "root-entity" in Yuurei persistence layer
 *
 * Why a User wraps an Author instead of inheriting from it ?
 * It is an optimization and future extension.
 *  * The first goal is to avoid cyclic graph for persistence
 *  * The second is you can have a identified Author coming from outside the app 
 *    (coming from other networks for example)
 */
class User implements Famous, Persistable, Follower
{

    use FamousImpl,
        PersistableImpl,
        FollowerImpl;

    protected $author;

    public function __construct(AuthorInterface $author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getUniqueId()
    {
        // @todo a string is perhaps a bad idea, hexadecimal could be better ?
        return (string) $this->getId();
    }

    /**
     * Gets the minimal info (the Author)
     * 
     * @return AuthorInterface
     */
    public function getMinimalInfo()
    {
        return $this->getAuthor();
    }

}