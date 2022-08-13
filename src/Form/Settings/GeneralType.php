<?php
declare(strict_types=1);

namespace PrestaShop\Module\WnBlocks\Form\Settings;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use PrestaShopBundle\Form\Admin\Type\CategoryChoiceTreeType;
use Symfony\Component\Form\AbstractType;

class GeneralType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add("first_category", CategoryChoiceTreeType::class, [
                "label" => "Wybierz kategorie produktów do bloku numer 1",
            ])
            ->add("second_category", CategoryChoiceTreeType::class, [
                "label" => "Wybierz kategorie produktów do bloku numer 2",
            ])
            ->add("third_category", CategoryChoiceTreeType::class, [
                "label" => "Wybierz kategorie produktów do bloku numer 3",
            ]);
    }
}
