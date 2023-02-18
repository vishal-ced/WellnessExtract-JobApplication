<?php

namespace WellnessExtract\JobApplication\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Item status functionality model
 */
class Status extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    /**#@+
     * Item Status values
     */
    public const STATUS_APPROVED = 'APPROVED';

    public const STATUS_REJRCT = 'REJRCT';

    /**#@-*/

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [self::STATUS_APPROVED => __('Approved'), self::STATUS_REJRCT => __('Reject')];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }
}
