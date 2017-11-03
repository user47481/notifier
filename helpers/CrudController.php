<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 12:02 PM
 */

namespace notifier\helpers;


use yii\web\Controller;
use yii\base\Exception;
use yii\web\HttpException;
use Yii;
use yii\helpers\Url;

class CrudController extends Controller
{
    public $labelMany = 'Переопредели меня';
    public $labelOne = 'Переопредели меня';
    public $create = true;
    public $export = false;
    public $proccessCreate = false;
    public $multilang = true;
    public $formButtonOne = false;
    public $formButtonOneLabel = 'Добавить';
    public $formButtonOneUrl = '#';
    public $formButtonTwo = false;
    public $formButtonTwoLabel = 'Добавить';
    public $formButtonTwoUrl = '#';
    public $formButtonThree = false;
    public $formButtonThreeLabel = 'Добавить';
    public $formButtonThreeUrl = '#';
    public $formButtonFour = false;
    public $formButtonFourLabel = 'Добавить';
    public $formButtonFourUrl = '#';
    public $indexTemplate = 'index';
    public $createTemplate = 'create';
    public $updateTemplate = 'update';

    public function getActions(){
        return [
            'Управление видимостью'=>[
                'Снять с публикации'=>Url::toRoute('unpublish'),
                'Опубликовать'=>Url::toRoute('publish')
            ]
        ];
    }

    public function actions(){
        return [
            'unpublish'=>[
                'class'=>'bulk\actions\UnpublishAction'
            ],
            'publish'=>[
                'class'=>'bulk\actions\PublishAction'
            ]
        ];
    }
    /**
     * Lists all KeyStorageItem models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new $this->modelSearchClass();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder'=>['id'=>SORT_DESC]
        ];
        $model = new $this->modelClass;
        if(isset($_GET['export'])){
            $this->export();
        }
        if (Yii::$app->request->post('hasEditable'))
        {
            // instantiate your book model for saving
            $id = Yii::$app->request->post('editableKey');
            $model = $this->findModel($id);
            $model->detachBehaviors();

            // store a default json response as desired by editable
            $out = Json::encode(['output' => '', 'message' => '']);

            // fetch the first entry in posted data (there should only be one entry
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST[\yii\helpers\StringHelper::basename(get_class($model))]);
            $post = [\yii\helpers\StringHelper::basename(get_class($model)) => $posted];

            // load model like any single model validation
            if ($model->load($post))
            {
                // can save model or do something before saving model
                $model->save();

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                /* if(strpos(Yii::$app->request->post('editableAttribute'),'_id')){
                  $find = User::findOne($model->{Yii::$app->request->post('editableAttribute')});
                  $output = $find->username;
                  }else{ */
                $output = '';

                /* } */

                /* // specific use case where you need to validate a specific
                  // editable column posted when you have more than one
                  // EditableColumn in the grid view. We evaluate here a
                  // check to see if buy_amount was posted for the Book model
                  if (isset($posted['buy_amount'])) {
                  $output = Yii::$app->formatter->asDecimal($model->buy_amount, 2);
                  } */

                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }
        return $this->render($this->indexTemplate, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }

    /**
     * Creates a new KeyStorageItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new $this->modelClass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update','id'=>$model->id]);
        } else {
            return $this->render($this->createTemplate, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KeyStorageItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Изменения сохранены');
            $this->refresh();
            return false;
        } else {
            return $this->render($this->updateTemplate, [
                'model' => $model,
            ]);
        }
    }

    public function actionRemoveLang($id,$lang)
    {
        $model = $this->findModel($id);
        if ($model->getTranslation($lang)->one()->delete()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('//templates/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KeyStorageItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('//templates/view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KeyStorageItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
     * Подготовка модели
     * Определяется в наследнике
     * Определяется в родителе
     * @param $model Модель для подготовки
     */
    public function prepare($model)
    {

    }
    /**
     * @param integer $id ID модели
     * @param bool $class Класс модели
     * @param bool $prepare Подготовка модели (мультиязык, прочий модификации перед выводом)
     *
     * @return mixed
     * @throws Exception
     * @throws HttpException
     */
    public function findModel($id, $class = false, $prepare = true)
    {

        if ($class === false)
        {
            $class = $this->getModelClass();
        }
        $finder = new $class;

        $model = $finder->find()->where(['id' => $id]);
        /*
         * Проверяем наличие поведения multiLang
         * */
        if ($finder->getBehavior('multiLang'))
        {
            $model->multilingual();
        }

        /*
         * Если модель не найдена
         * */
        if ($model === null)
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }

        /*
         * Если $prepare true
         * Подготавливаем модель
         * */
        if ($prepare)
        {
            $this->prepare($model);
        }

        return $model->one();
    }

    /**
     * Return class of the model
     *
     * @throws Exception
     * @return string
     */
    public function getModelClass()
    {
        throw new Exception('Добавь в контроллер getModelClass с классом модели!!!');
    }

    /**
     * Return class of the model
     *
     * @throws Exception
     * @return string
     */
    public function getModelSearchClass()
    {
        throw new Exception('Добавь в контроллер getModelClass с классом модели!!!');
    }

    public function export($query){
        $model = new $this->getModelClass();

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'Users' => [
                    'class' => 'codemix\excelexport\ActiveExcelSheet',
                    'query' => $model->find(),
                ]
            ]
        ]);
        return $file->send('data.xlsx');
    }
}