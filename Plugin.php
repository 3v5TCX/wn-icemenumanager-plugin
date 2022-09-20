<?php namespace IceCollection\MenuManager;

use Backend;
use Controller;
use System\Classes\PluginBase;

/**
 * MenuManager Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'icecollection.menumanager::lang.plugin.name',
            'description' => 'icecollection.menumanager::lang.plugin.description',
            'author'      => 'icecollection.menumanager::lang.plugin.author',
            'icon'        => 'icon-list-alt'
        ];
    }

    /**
     * Create the register permissions for this plugin
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'icecollection.menumanager.access_edit'        => ['tab' => 'icecollection.menumanager::lang.permissions.tab', 'label' => 'icecollection.menumanager::lang.permissions.access_edit'],
            'icecollection.menumanager.access_reorder'     => ['tab' => 'icecollection.menumanager::lang.permissions.tab', 'label' => 'icecollection.menumanager::lang.permissions.access_reorder']
        ];
    }

    /**
     * Create the navigation items for this plugin
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'menumanager' => [
                'label'    => 'icecollection.menumanager::lang.plugin.menumanager',
                'url'      => Backend::url('icecollection/menumanager/menus'),
                'icon'     => 'icon-list-alt',
                'permissions' => ['icecollection.menumanager.*'],
                'order'    => 50,
                'sideMenu' => [
                    'edit'    => [
                        'label' => 'icecollection.menumanager::lang.plugin.edit',
                        'icon'  => 'icon-list-alt',
                        'url'   => Backend::url('icecollection/menumanager/menus'),
                        'permissions' => ['icecollection.menumanager.access_edit']
                    ],
                    'reorder' => [
                        'label' => 'icecollection.menumanager::lang.plugin.reorder',
                        'icon'  => 'icon-exchange',
                        'url'   => Backend::url('icecollection/menumanager/menus/reorder'),
                        'permissions' => ['icecollection.menumanager.access_reorder'],
                    ]
                ]
            ]
        ];
    }

    /**
     * Register the front end component
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            '\IceCollection\MenuManager\Components\Menu'      => 'menu',
            '\IceCollection\MenuManager\Components\MenuOther' => 'menu_other',
            '\IceCollection\MenuManager\Components\SideMenu'  => 'menu_side',
            '\IceCollection\MenuManager\Components\MainMenu'  => 'menu_main',
            '\IceCollection\MenuManager\Components\SiteMap'  => 'sitemap',
        ];
    }

}
