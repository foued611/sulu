<?php
/**
 * Created by PhpStorm.
 * User: dghaies
 * Date: 04.09.17
 * Time: 14:23
 */

namespace Sulu\Component\Util;
use Sulu\Component\Content\Compat\PropertyInterface;

interface ContentTypeCleanerInterface
{
    /**
     * @param string $data
     * @param PropertyInterface $property
     *
     * @return string
     */
    public function cleanup($data, PropertyInterface $property);
}