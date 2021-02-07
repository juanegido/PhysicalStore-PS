<?php

require_once dirname(__FILE__) . '/classes/EmployeeStore.php';

if (!defined('_PS_VERSION_')) {
    exit;
}

class physicalstore extends Module
{
    public function __construct()
    {
        $this->name = 'physicalstore';
        $this->tab = 'admin';
        $this->version = '1.0.0';
        $this->author = 'Juan Egido';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->tab = 'front_office_features';
        $this->tabs = [
            'class_name' => 'AdminEmployeesStore',
            'visible' => true,
            'name' => 'Manage Employees',
            'parent_class_name' => 'AdminCatalog',
        ];

        parent::__construct();

        $this->displayName = $this->trans('Physical Store Module', [], 'Modules.Physicalstore.Admin');
        $this->description = $this->trans('Module developed for Presta Academy.', [], 'Modules.Physicalstore.Admin');
        $this->ps_versions_compliancy = ['min' => '1.7.7.0', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        include dirname(__FILE__) . '/sql/install.php';

        return parent::install() and $this->registerHook('displayBackOfficeHeader');
        //return parent::install() && $this->registerHook('AdminStatsModules');
    }

    public function hookdisplayBackOfficeHeader()
    {
        return 'Hello World';
    }

    public function getContent()
    {
        if (((bool)Tools::isSubmit('submitPhysicalstoreModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign(
        [
            'author' => $this->author,
        ]
        );


        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
        //return Tools::redirect($this->context->link->getAdminLink('AdminEmployeesStore'));

        return $output . $this->renderForm();
    }

    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPhysicalstoreModule';
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$this->getConfigForm()]);
    }

    protected function getConfigForm()
    {
        return [
            'form' => [
                'legend' => [
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'PHYSICALSTORE_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => [
                            [
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled'),
                            ],
                            [
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled'),
                            ],
                        ],
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'PHYSICALSTORE_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ],
                    [
                        'type' => 'password',
                        'name' => 'PHYSICALSTORE_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Save'),
                ],
            ],
        ];
    }

    protected function getConfigFormValues()
    {
        return array(
            'PHYSICALSTORE_LIVE_MODE' => Configuration::get('PHYSICALSTORE_LIVE_MODE', true),
            'PHYSICALSTORE_ACCOUNT_EMAIL' => Configuration::get('PHYSICALSTORE_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'PHYSICALSTORE_ACCOUNT_PASSWORD' => Configuration::get('PHYSICALSTORE_ACCOUNT_PASSWORD', null),
        );
    }

    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    public function uninstall()
    {
        //include (dirname(__FILE__).'/sql/uninstall.php');
        return parent::uninstall();
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }
}
