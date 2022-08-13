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

use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

class Wn_Blocks extends Module
{
    public function __construct()
    {
        $this->name = "wn_blocks";
        $this->version = "1.0";
        $this->author = "Damian Tymkowski";
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            "min" => "1.6.8.0",
            "max" => "8.7.8.9",
        ];
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l("WN Blocks");
        $this->description = $this->l(
            "The module displays three product blocks on the shop homepage"
        );
    }

    /**
     * @return bool
     */
    public function install()
    {
        return parent::install() && $this->registerHook("displayHome");
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookDisplayHome($params)
    {
        $this->context->controller->registerStylesheet(
            "wn_blocks_style",
            "modules/" . $this->name . "/views/css/style.css",
            [
                "media" => "all",
                "priority" => 300,
            ],
            "wn_blocks_slick_style",
        );

        $this->context->controller->registerStylesheet(
            "wn_blocks_slick_style",
            "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css",
            [
                'server' => 'remote',
                'position' => 'footer',
                "media" => "all",
                "priority" => 100,
            ]
        );

        $this->context->controller->registerJavaScript(
            'wn_blocks_js_slick',
            'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js',
            [
                'server' => 'remote',
                'position' => 'footer',
                'priority' => 20,
                'attribute' => 'async',
            ],
        );

        $this->context->controller->registerJavaScript(
            'wn_blocks_js_front',
            'modules/' . $this->name . '/views/js/front.js',
            [
                'priority' => 30,
                'position' => 'footer',
                'attribute' => 'async',
            ]
        );

        $repository = $this->get(
            "prestashop.module.wnblocks.product_repository"
        );

        $first_category_ID = (int)Configuration::get("FIRST_CATEGORY");
        $second_category_ID = (int)Configuration::get("SECOND_CATEGORY");
        $third_category_ID = (int)Configuration::get("THIRD_CATEGORY");


        $blocks = [
            0 => [
                'category' => new Category($first_category_ID, (int)$this->context->language->id),
                'products' => $repository->findProductByCategoryId(
                    $first_category_ID
                ),
            ],
            1 => [
                'category' => new Category($second_category_ID, (int)$this->context->language->id),
                'products' => $repository->findProductByCategoryId(
                    $second_category_ID
                ),
            ],
            2 => [
                'category' => new Category($third_category_ID, (int)$this->context->language->id),
                'products' => $repository->findProductByCategoryId(
                    $third_category_ID
                ),
            ],
        ];


        $this->smarty->assign([
            "wnblocks" => $blocks
        ]);

        return $this->display(
            dirname(__FILE__),
            "views/templates/hook/home.tpl"
        );
    }

    public function getContent()
    {
        $route = SymfonyContainer::getInstance()
            ->get("router")
            ->generate("settings_page");
        Tools::redirectAdmin($route);
    }
}
