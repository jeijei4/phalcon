<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Html\Link;

use Psr\Link\EvolvableLinkInterface;

/**
 * Class Link
 *
 * @package Phalcon\Link
 */
class EvolvableLink extends Link implements EvolvableLinkInterface
{
    /**
     * Returns an instance with the specified attribute added.
     *
     * If the specified attribute is already present, it will be overwritten
     * with the new value.
     *
     * @param string $attribute The attribute to include.
     * @param mixed  $value     The value of the attribute to set.
     *
     * @return $this
     */
    public function withAttribute($attribute, $value)
    {
        $newInstance = clone $this;

        $newInstance->attributes[$attribute] = $value;

        return $newInstance;
    }

    /**
     * Returns an instance with the specified href.
     *
     * @param string $href
     *       The href value to include.  It must be one of:
     *       - An absolute URI, as defined by RFC 5988.
     *       - A relative URI, as defined by RFC 5988. The base of the relative
     *       link is assumed to be known based on context by the client.
     *       - A URI template as defined by RFC 6570.
     *       - An object implementing __toString() that produces one of the
     *       above values.
     *
     * An implementing library SHOULD evaluate a passed object to a string
     * immediately rather than waiting for it to be returned later.
     *
     * @return $this
     */
    public function withHref($href)
    {
        $newInstance = clone $this;

        $newInstance->href      = $href;
        $newInstance->templated = $this->hrefIsTemplated($href);

        return $newInstance;
    }

    /**
     * Returns an instance with the specified relationship included.
     *
     * If the specified rel is already present, this method MUST return
     * normally without errors, but without adding the rel a second time.
     *
     * @param string $rel
     *   The relationship value to add.
     *
     * @return $this
     */
    public function withRel($rel)
    {
        $newInstance = clone $this;

        $newInstance->rels[$rel] = true;

        return $newInstance;
    }

    /**
     * Returns an instance with the specified attribute excluded.
     *
     * If the specified attribute is not present, this method MUST return
     * normally without errors.
     *
     * @param string $attribute
     *   The attribute to remove.
     *
     * @return $this
     */
    public function withoutAttribute($attribute)
    {
        $newInstance = clone $this;

        unset($newInstance->attributes[$attribute]);

        return $newInstance;
    }

    /**
     * Returns an instance with the specified relationship excluded.
     *
     * If the specified rel is already not present, this method MUST return
     * normally without errors.
     *
     * @param string $rel
     *   The relationship value to exclude.
     *
     * @return $this
     */
    public function withoutRel($rel)
    {
        $newInstance = clone $this;

        unset($newInstance->rels[$rel]);

        return $newInstance;
    }
}
