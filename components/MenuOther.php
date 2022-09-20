<?php namespace IceCollection\MenuManager\Components;

use Cms\Classes\ComponentBase;
use IceCollection\MenuManager\Models\Menu as menuModel;
use Request;
use App;
use DB;

class MenuOther extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Меню',
            'description' => 'Блок меню для страниц сайтов'
        ];
    }

    /**
     * @return array
     * @todo Change start to parentNode to match my naming
     */
    public function defineProperties()
    {
        return [
            'start'            => [
                'description' => 'Выбор меню из списка',
                'title'       => 'Меню',
                'default'     => 1,
                'type'        => 'dropdown'
            ],
            'position'       => [
                'description' => 'Расположение меню',
                'title'       => 'Расположение',
                'default'     => '1',
                'type'        => 'dropdown',
                'options'     => [
                    1 => 'Верхнее',
                    2 => 'Нижнее'
                ]
            ],
            'numberOfLevels'   => [
                'description' => 'Сколько уровней меню выводить',
                'title'       => 'Уровни',
                'default'     => '3', // This is the array key, not the value itself
                'type'        => 'dropdown',
                'options'     => [
                    1 => '1',
                    2 => '2',
                    3 => '3'
                ]
            ]
        ];

    }

    /**
     * Returns the list of menu items I can select
     * @return array
     */
    public function getStartOptions()
    {
        $menuModel = new menuModel();
        return $menuModel->getSelectList();
    }

    /**
     * Build all my parameters for the view
     * @todo Pull as much as possible into the model, including the column names
     */
    public function onRender()
    {
        // Set the parentNode for the component output
        $topNode                  = menuModel::find($this->getIdFromProperty($this->property('start')));
        $this->page['parentNode'] = $topNode;


        // How deep do we want to go?
        $this->page['numberOfLevels'] = (int)$this->property('numberOfLevels');

        $this->page['position'] = (int)$this->property('position');

    }

    /**
     * Gets the id from the passed property
     *  Due to the component inspector re-ordering the array on keys, and me using the key as the menu model id,
     *  I've been forced to add a string to the key. This method removes it and returns the raw id.
     *
     * @param $value
     *
     * @return bool|string
     */
    protected function getIdFromProperty($value)
    {
        if (!strlen($value) > 3) {
            return false;
        }
        return substr($value, 3);
    }

}
