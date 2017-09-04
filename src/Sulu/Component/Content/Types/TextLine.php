<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Component\Content\Types;

use Sulu\Component\Content\Compat\PropertyInterface;
use Sulu\Component\Content\Compat\PropertyParameter;
use Sulu\Component\Content\SimpleContentType;
use Sulu\Component\Util\ContentTypeCleanerInterface;

/**
 * ContentType for TextLine.
 */
class TextLine extends SimpleContentType
{
    private $template;

    public function __construct($template, ContentTypeCleanerInterface $contentTypeCleaner)
    {
        parent::__construct('TextLine', '');

        $this->template = $template;
        $this->contentTypeCleaner = $contentTypeCleaner;
    }

    public function cleanupData($data, PropertyInterface $property)
    {
        #return $data;
        return $this->contentTypeCleaner->cleanup($data, $property) ;
    }

    /**
     * returns a template to render a form.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParams(PropertyInterface $property = null)
    {
        return [
            'headline' => new PropertyParameter('headline', false),
        ];
    }
}
