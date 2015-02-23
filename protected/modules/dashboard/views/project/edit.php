<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $folders Folder[] */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $model->name
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $model->name; ?></h1>
        <?php echo TbHtml::tabs(array(
            array('label' => 'Manage project', 'url' => array('/dashboard/project/'.$model->id)),
            array('label' => 'Project information', 'url' => array('/dashboard/project/'.$model->id.'/edit'), 'active' => true)
        )); ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php
        $this->widget('bootstrap.widgets.TbAlert');
        if ($model->hasErrors()) {
            echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
        }
        ?>

        <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
        <fieldset>
            <legend>Project Information</legend>
            <?php
            echo TbHtml::activeTextFieldControlGroup($model, 'name');
            echo TbHtml::activeTextAreaControlGroup($model, 'description', array('rows'=>5));
            ?>
            <div id="folderSelection" class="active">
                <?php $this->renderPartial('_selectFolder', array('model'=>$model,'folders'=>$folders)) ?>
            </div>
            <div id="folderCreation">
                <?php $this->renderPartial('_createFolder', array('model'=>$model)) ?>
            </div>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(
            TbHtml::submitButton('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Discard changes', array(
                'url' => array('/dashboard/project/'.$model->id)
            ))
        ));
        echo TbHtml::endForm();
        ?>
        <script>
            function showCreateFolder() {
                $('#folderSelection').removeClass('active');
                $('#folderCreation').addClass('active');
                $('input[name=createFolder]').val('1');
            }
            function showSelectFolder() {
                $('#folderSelection').addClass('active');
                $('#folderCreation').removeClass('active');
                $('input[name=newFolder]').val('');
                $('input[name=createFolder]').val('0');
            }
        </script>
    </div>
</div>