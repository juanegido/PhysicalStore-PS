<?php

class AdminEmployeesStoreController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'physicalstore_employee';
        $this->className = 'EmployeeStore';
        $this->lang = false;


        parent::__construct();

        $this->fields_list = [
            'id_physicalstore_employee' => [
                'title' => $this->trans('ID', [], 'Admin.Global'),
            ],
            'name' => [
                'title' => $this->trans('Name', [], 'Admin.Global'),
            ],
            'nif' => [
                'title' => $this->trans('Nif', [], 'Admin.Global'),
            ],
            'salary' => [
                'title' => $this->trans('Salary', [], 'Admin.Global'),
            ],
        ];

        $this->bulk_actions = [
            'delete' => [
                'text' => $this->trans('Delete selected', [], 'Admin.Actions'),
                'confirm' => $this->trans('Delete selected items?', [], 'Admin.Notifications.Warning'),
                'icon' => 'icon-trash',
            ],
        ];
    }

    public function renderList()
    {
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        return parent::renderList();
    }

    public function renderForm()
    {
        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Employee Store', [], 'Admin.International.Feature'),
                'icon' => 'icon-tag',
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->trans('Name', [], 'Admin.Global'),
                    'name' => 'name',
                    'required' => true,
                    'hint' => $this->trans('Employee Name', [], 'Admins.International.Help'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Nif', [], 'Admin.Global'),
                    'name' => 'nif',
                    'required' => false,
                    'hint' => $this->trans('Employee nif', [], 'Admins.International.Help'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('Salary', [], 'Admin.Global'),
                    'name' => 'salary',
                    'required' => true,
                    'hint' => $this->trans('Employee salary', [], 'Admins.International.Help'),
                ],
            ],
        ];
        $this->fields_form['submit'] = [
            'title' => $this->trans('Save', [], 'Admin.Actions'),
        ];

        return parent::renderForm();
    }
}
