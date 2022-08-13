<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

declare(strict_types=1);

namespace PrestaShop\Module\WnBlocks\Controller;

use PrestaShop\Module\WnBlocks\Form\Settings\GeneralDataConfiguration;
use PrestaShop\Module\WnBlocks\Form\Settings\GeneralFormDataProvider;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;

use Product;

class SettingsController extends FrameworkBundleAdminController
{
    public function index(Request $request): Response
    {
        $generalFormDataHandler = $this->get(
            "prestashop.module.wnblocks.form.settings.general_form_data_handler"
        );

        $generalForm = $generalFormDataHandler->getForm();

        return $this->render(
            "@Modules/wn_blocks/views/templates/admin/settings.twig",
            [
                "settingsForm" => $generalForm->createView(),
            ]
        );
    }

    public function saveSettings(Request $request): Response
    {
        $generalFormDataHandler = $this->get(
            "prestashop.module.wnblocks.form.settings.general_form_data_handler"
        );
        $generalForm = $generalFormDataHandler->getForm();
        $generalForm->handleRequest($request);

        if ($generalForm->isSubmitted()) {
            $errors = $generalFormDataHandler->save($generalForm->getData());

            if (empty($errors)) {
                $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));
            } else {
                $this->flashErrors($errors);
            }
        }
        return $this->redirectToRoute('settings_page');
    }
}
