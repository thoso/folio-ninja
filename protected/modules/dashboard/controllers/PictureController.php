<?php

class PictureController extends Controller
{
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all logged to perform these actions
                'actions' => array('add', 'edit', 'delete'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Add a picture to a particular project.
     * @param integer $id the ID of the project
     */
    public function actionAdd($id)
    {
        $model = new PicturesPerProject;
        $project = Project::model()->findByPk($id);

        if (isset($_POST['PicturesPerProject'])) {
            $model->attributes = $_POST['PicturesPerProject'];
            $model->project_id = $id;
            if (($model->validate()) && ($uploaded = CUploadedFile::getInstance($model,'pictureUpload'))) {
                $picture = new Picture;
                $picture->instance = $uploaded;
                $picture->scenario = 'portfolio';
                if ($picture->save()) {
                    $model->picture_id = $picture->id;
                    if ($model->save()) {
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Picture added sucessfully.');
                        $this->redirect(array('/dashboard/project/' . $project->id));
                    }
                }
            }
        }

        $this->render('add',array(
            'model'=>$model,
            'project'=>$project
        ));
    }

    /**
     * Edit a particular project picture.
     * @param integer $id the ID of the picture to be edited
     */
    public function actionEdit($id)
    {
        $model = PicturesPerProject::model()->findByPk($id);

        if(isset($_POST['PicturesPerProject']))
        {
            $model->attributes = $_POST['PicturesPerProject'];
            if ($model->save()) {
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Picture updated sucessfully.');
                $this->redirect(array('/dashboard/project/' . $model->project->id));
            }
        }

        $this->render('edit',array(
            'model'=>$model
        ));
    }

    /**
     * Prompts and deletes a particular project picture.
     * @param integer $id the ID of the picture to be deleted
     */
    public function actionDelete($id)
    {
        $model = PicturesPerProject::model()->findByPk($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['remove']))
        {
            if ($model->delete()) {
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS, '<h4>All right!</h4> Picture removed sucessfully.');
                $this->redirect(array('/dashboard/project/' . $model->project->id));
            }
        }

        $this->render('delete',array(
            'model'=>$model
        ));
    }
}