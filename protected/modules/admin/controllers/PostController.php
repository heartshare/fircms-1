<?php

/**
 * @author   poctsy  <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 * @version   PostController.php  10:53 2013年09月11日
 */
class PostController extends FAdminController {

    public $layout='application.modules.admin.views.layouts.column2';

    public function filters() {
        return array(
            array('auth.filters.AuthFilter'),
        );
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */

    public function actionCreate() {
        $model = new Post;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        
        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];

            $thumbUpload = CUploadedFile::getInstance($model,'thumb_file');
            if(!empty($thumbUpload))
            {
                $model->thumb = Fircms::createFile($thumbUpload,'thumb','create','',array(
                    Yii::app()->config->get('thumbWidth'),Yii::app()->config->get('thumbHeight')
                ));
            }


            $fileUpload = CUploadedFile::getInstance($model,'soft_file');
            if(!empty($fileUpload))
            {
                $model->soft = Fircms::createFile($fileUpload,'file','create');
            }

                if ($model->save())
                    $this->redirect(array('admin'));

        }
        $this->render('create', array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Post']) ) {

            $model->attributes = $_POST['Post'];

            $thumbUpload = CUploadedFile::getInstance($model,'thumb_file');

            if(!empty($thumbUpload))
            {
                $model->thumb = Fircms::createFile($thumbUpload,'thumb','update',$model->thumb,array(
                    Yii::app()->config->get('thumbWidth'),Yii::app()->config->get('thumbHeight')
                ));
            }

            $fileUpload = CUploadedFile::getInstance($model,'soft_file');
            if(!empty($fileUpload))
            {
                $model->soft = Fircms::createFile($fileUpload,'file','update',$model->soft);
            }

            if ($model->save() )
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Post('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Post']))
            $model->attributes = $_GET['Post'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Post::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }


    /**
     * Performs the AJAX validation.
     * @param Post $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }



}
