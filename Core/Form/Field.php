<?php


namespace App\Core\Form;


use App\Core\Model;

class Field
{
    /**
     * Field constructor.
     * @param string $attribute
     * @param Model $model
     */
    public function __construct(
        public Model $model,
        public string $attribute
    )
    {
    }

    public function __toString(): string
    {
        return sprintf('
        <div class="form-group mb-3 ">
        <label>%s</label>
        <input type="text" name="%s" value="%s" class="form-control%s">
        <div class="invalid-feedback">%s</div>
        </div>
        ',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }
}