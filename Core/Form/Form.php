<?php


namespace App\Core\Form;


use App\Core\Model;

class Form
{
    /**
     * @param string $action
     * @param string $method
     */
    public static function begin(string $action, string $method)
    {
        echo sprintf('<form action="%s" method="%s">',$action,$method);
        return new Form();
    }

    public static function end()
    {
        echo "</form>";
    }

    public function field(Model $model, $attribute): Field
    {
        return new Field($model,$attribute);
    }
}