<?php
declare(strict_types=1);

namespace PrestaShop\Module\WnBlocks\Form\Settings;
use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

/**
 * Class GeneralFormDataProvider
 */
class GeneralFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var DataConfigurationInterface
     */
    private $generalFormDataConfiguration;

    /**
     * @param DataConfigurationInterface $demoConfigurationChoiceDataConfiguration
     */
    public function __construct(
        DataConfigurationInterface $generalFormDataConfiguration
    ) {
        $this->generalFormDataConfiguration = $generalFormDataConfiguration;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        return $this->generalFormDataConfiguration->getConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data): array
    {
        return $this->generalFormDataConfiguration->updateConfiguration($data);
    }
}
