<?php

namespace app\controllers;

use app\models\AddBookForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\AddWorkerForm;
use app\models\AddClientForm;
use app\models\Books;
use app\models\Clients;
use app\models\IssuedBooks;
use app\models\ReturnedBooks;
use app\models\SearchBookForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (Yii::$app->user->isGuest) Yii::$app->response->redirect(['site/login']);

        $issue_id = new Books();
        $return_id = new Books();
        if ($issue_id->load(Yii::$app->request->post()) && Books::getBookById($issue_id->id)->availability==1) Yii::$app->response->redirect(['site/issuancebook', 'id' => $issue_id->id]);
        if ($return_id->load(Yii::$app->request->post()) && Books::getBookById($return_id->id)->availability==0) Yii::$app->response->redirect(['site/returnbook', 'id' => $return_id->id]);

        $model = new SearchBookForm();
        $model->load(Yii::$app->request->post());
        if ($model->title && $model->availability) {
            return $this->render('index', [
                'books' => Books::find()->where(['like', 'title', $model->title])->andWhere(['availability' => '1'])->all(),
                'model' => $model,
                'return_id' => $return_id,
                'issue_id' => $issue_id,
            ]);
        }
        if ($model->title) {
            return $this->render('index', [
                'books' => Books::find()->where(['like', 'title', $model->title])->all(),
                'model' => $model,
                'return_id' => $return_id,
                'issue_id' => $issue_id,
            ]);
        }
        if ($model->availability) {
            return $this->render('index', [
                'books' => Books::find()->where(['availability' => '1'])->all(),
                'model' => $model,
                'return_id' => $return_id,
                'issue_id' => $issue_id,
            ]);
        } else
            return $this->render('index', [
                'model' => $model,
                'books' => Books::find()->all(),
                'return_id' => $return_id,
                'issue_id' => $issue_id,
            ]);
    }

    public function actionIssuancebook()
    {
        $book = Books::getBookById(Yii::$app->getRequest()->getQueryParam('id'));
        $searchClient = new Clients();
        $searchClient->load(Yii::$app->request->post());
        $issueBook = new IssuedBooks();

        if ($issueBook->load(Yii::$app->request->post()) && $issueBook->subject && $book->availability) {
            $issueBook->object = $book->id;
            $issueBook->staff_id = Yii::$app->user->id;
            $issueBook->date_of_issue = date('Y-m-d');
            $issueBook->save();

            $book->availability = 0;
            $book->save();
            return Yii::$app->response->redirect(['site/index', [
                'model' => new SearchBookForm(),
                'books' => Books::find()->all(),
                'issue_id' => new Books(),
            ]]);
        }

        if ($searchClient->document_number) {
            return $this->render('issuancebook', [
                'book' => $book,
                'clients' => Clients::find()->where(['like', 'document_number', $searchClient->document_number])->all(),
                'searchClient' => $searchClient,
                'issueBook' => $issueBook,
            ]);
        }


        return $this->render('issuancebook', [
            'book' => $book,
            'clients' => Clients::find()->all(),
            'searchClient' => $searchClient,
            'issueBook' => $issueBook,
        ]);
    }
    public function actionReturnbook()
    {
        $book = Books::getBookById(Yii::$app->getRequest()->getQueryParam('id'));
        $issued = IssuedBooks::findOne(['object' => $book->id]);
        $client = Clients::findOne(['id' => $issued->subject]);
        $returnedBook = new ReturnedBooks();
        if ($returnedBook->load(Yii::$app->request->post()) && $returnedBook->book_condition) {
            $returnedBook->return_date = date('Y-m-d');
            $returnedBook->client_id = $client->id;
            $returnedBook->book_id = $book->id;
            $returnedBook->staff_id = Yii::$app->user->id;
            $returnedBook->save();
            $book->availability = 1;
            $book->book_condition = $returnedBook->book_condition;
            $book->save();
            $issued->delete();
            return Yii::$app->response->redirect(['site/index', [
                'model' => new SearchBookForm(),
                'books' => Books::find()->all(),
                'issue_id' => new Books(),
            ]]);
        }

        return $this->render('returnbook', [
            'model' => $book,
            'client' => $client,
            'returnedBook' => $returnedBook
        ]);
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }




    public function actionAddworker()
    {
        if (Yii::$app->user->isGuest) Yii::$app->response->redirect(['site/login']);;
        $model = new AddWorkerForm();

        if ($model->load(Yii::$app->request->post()) && $model->addWorker()) {
            Yii::$app->session->setFlash('success', 'Вы успешно добавили сотрудника - ' . $model->name . '.');
            $model = new AddWorkerForm();
        }

        return $this->render('addworker', [
            'model' => $model,
        ]);
    }
    public function actionAddclient()
    {
        if (Yii::$app->user->isGuest) Yii::$app->response->redirect(['site/login']);;
        $model = new AddClientForm();

        if ($model->load(Yii::$app->request->post()) && $model->addClient()) {
            Yii::$app->session->setFlash('success', 'Вы успешно добавили клиента - ' . $model->name . '.');
            $model = new AddClientForm();
        }

        return $this->render('addclient', [
            'model' => $model,
        ]);
    }
    public function actionAddbook()
    {
        if (Yii::$app->user->isGuest) Yii::$app->response->redirect(['site/login']);;
        $model = new AddBookForm();

        if ($model->load(Yii::$app->request->post()) && $model->addBook()) {
            Yii::$app->session->setFlash('success', 'Вы успешно добавили книгу - \"' . $model->title . '\".');
            $model = new AddBookForm();
        }

        return $this->render('addbook', [
            'model' => $model,
        ]);
    }
    public function actionSearch()
    {
        if (Yii::$app->user->isGuest) Yii::$app->response->redirect(['site/login']);;
        $model = new SearchBookForm();
        $model->load(Yii::$app->request->post());
        return $this->render('search', [
            'model' => $model,
        ]);
    }
}
