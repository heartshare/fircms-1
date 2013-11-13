<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_INLINE,
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php echo $form->textAreaControlGroup($model, 'content'); ?>


    <?php echo TbHtml::formActions(array(
        TbHtml::submitButton( '搜索'),
    )); ?>

<?php $this->endWidget(); ?>

