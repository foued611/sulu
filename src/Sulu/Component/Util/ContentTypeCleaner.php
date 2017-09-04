<?php

namespace Sulu\Component\Util;

use Sulu\Component\Content\Compat\PropertyInterface;

class ContentTypeCleaner implements ContentTypeCleanerInterface
{

    const STRIP_TAGS_PROPERTY_NAME = "cleanup.striptags.withlist";

    /**
     * @inheritdoc
     */
    public function cleanup($propertyValue, PropertyInterface $property)
    {
        $validationProperty = $property->getParams();
        $cleanupOptions = $this->getPropertyCleanupOptions($validationProperty);
        if ($cleanupOptions) {
            $type = $this->getCleaningMethodeNameByPropertyName($property);
            if (method_exists($this, $type)) {
                return $this->$type($propertyValue, $cleanupOptions);
            }
        }

        return $propertyValue;

    }

    /**
     * get property validation parma option from template xml
     *
     * @param array $validationProperty
     *
     * @return string
     */
    protected function getPropertyCleanupOptions($validationProperty)
    {
        if ($validationProperty && array_key_exists(
                self::STRIP_TAGS_PROPERTY_NAME,
                $validationProperty
            )) {
            $validationOption = $validationProperty[self::STRIP_TAGS_PROPERTY_NAME]->getValue();

            return $validationOption;
        }

        return false;
    }

    /**
     * @param string $string
     * @param string $whitelist
     *
     * @return string
     */
    protected function stripTags($string, $whitelist = "")
    {
        $stripedContent = strip_tags($string, $whitelist);
        return $stripedContent;
    }

    /**
     * @param array $validationProperty
     *
     * @return string
     */
    private function getCleaningMethodeNameByPropertyName($validationProperty)
    {
        if (array_key_exists(
            self::STRIP_TAGS_PROPERTY_NAME,
            $validationProperty
        )) {
            return "stripTags";
        }
    }


}