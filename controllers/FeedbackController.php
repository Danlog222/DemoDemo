<?php

namespace app\controllers;

use app\models\Feedback;
use Yii;
use yii\web\UploadedFile;

class FeedbackController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Feedback();
    
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Отзвы успешно отправлен!');
                    return $this->goHome();
                }
            }
        }
    
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
