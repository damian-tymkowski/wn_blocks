<?php
declare(strict_types=1);

namespace PrestaShop\Module\WnBlocks\Form\Settings;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

final class GeneralDataConfiguration implements DataConfigurationInterface
{
    public const FIRST_CATEGORY = "FIRST_CATEGORY";
    public const SECOND_CATEGORY = "SECOND_CATEGORY";
    public const THIRD_CATEGORY = "THIRD_CATEGORY";

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        $return = [];

        if (
            $firstCategory = $this->configuration->get(
                GeneralDataConfiguration::FIRST_CATEGORY
            )
        ) {
            $return["first_category"] = $firstCategory;
        }
        if (
            $secondCategory = $this->configuration->get(
                GeneralDataConfiguration::SECOND_CATEGORY
            )
        ) {
            $return["second_category"] = $secondCategory;
        }
        if (
            $thirdCategory = $this->configuration->get(
                GeneralDataConfiguration::THIRD_CATEGORY
            )
        ) {
            $return["third_category"] = $thirdCategory;
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration): array
    {
        $this->configuration->set(
            GeneralDataConfiguration::FIRST_CATEGORY,
            $configuration["first_category"]
        );
        $this->configuration->set(
            GeneralDataConfiguration::SECOND_CATEGORY,
            $configuration["second_category"]
        );
        $this->configuration->set(
            GeneralDataConfiguration::THIRD_CATEGORY,
            $configuration["third_category"]
        );
        return [];
    }

    /**
     * Ensure the parameters passed are valid.
     *
     * @param array $configuration
     *
     * @return bool Returns true if no exception are thrown
     */
    public function validateConfiguration(array $configuration): bool
    {
        return true;
    }
}
