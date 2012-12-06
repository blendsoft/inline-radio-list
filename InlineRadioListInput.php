<?php
/**
 * @desc
 *
 * @author Dariusz Męcinski <kontakt@blendsoft.pl>
 * @version 0.0.1
 * @license BSD
 *
 * @link http://www.blendsoft.pl/
 * @copyright Copyright &copy; 2012 Blendsoft.pl
 * @desc
 * @example
 **/
class InlineRadioListInput extends CInputWidget
{
    public $data;
    public $htmlOptions = array('size' => 5);

    function init()
    {
        //$assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets', false, -1, YII_DEBUG ? 1 : 0);
        // Yii::app()->getClientScript()->registerScriptFile($assets . '/js/inline_radio_list.js');
        // Yii::app()->getClientScript()->registerCssFile($assets . '/css/inline_radio_list.css');


        $id = CHtml::getIdByName(CHtml::resolveName($this->model,  $this->attribute));
        Yii::app()->getClientScript()->registerCss($id, '.inline-radio-list-container span {margin-right: 5px; cursor: pointer;} #'.$id.'{display: none;}');

        Yii::app()->getClientScript()->registerScript($id, '
            var $inline = $("#'.$id.'").next(".inline-radio-list-container");
            $("#'.$id.' option").each(function () {
                var $this = $(this);
                $inline.append("<span data-id=\""+$this.attr("value")+"\">"+$this.text()+"</span>");
            });

            $inline.children("span").on("click", function(){
                var $this = $(this);

                $inline.children("span").css("font-weight", "normal");
                $this.css("font-weight", "bold");

                $("#'.$id.' option").filter("[value=\"" + $this.data("id") + "\"]").prop("selected", true);
            });
        ');
    }

    function run()
    {

        $model = $this->model;
        $attribute = $this->attribute;

        echo CHtml::activeDropDownList($model, $attribute, $this->data, $this->htmlOptions);
        echo Chtml::tag('div', array('class'=>'inline-radio-list-container'));

    }
}
