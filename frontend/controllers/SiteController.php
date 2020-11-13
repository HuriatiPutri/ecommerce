<?php

namespace frontend\controllers;

use common\models\entity\ExamInstitution;
use common\models\entity\Participant;
use common\models\entity\User;
use common\models\entity\Product;
use common\models\entity\Slider;
use common\models\entity\DetailFoto;
use common\models\entity\InfoDetail;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\PasswordForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\entity\Wishlist;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /* 'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'captcha', 'request-password-reset', 'reset-password'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'change-password', 'verify-certificate', 'download'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ], */
            // 'verbs' => [
            //     'class'   => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
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
     * @return mixed
     */


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);
        $slider = Slider::find()->where(['status' => 1])->all();

        return $this->render('index', [
            'slider' => $slider,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        $foto = DetailFoto::find()->where(['product_id' => $id])->all();

        $info = InfoDetail::find()->where(['product_id' => $id])->all();

        return $this->render('view', [
            'model' => Product::findOne($id),
            'foto' => $foto,
            'info' => $info,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewByCategory($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['category_id' => $id]),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);

        $slider = Slider::find()->where(['status' => 1])->all();

        return $this->render('index', [
            'slider' => $slider,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDownload($id, $field)
    {
        $model = Product::findOne($id);
        if (!$model->downloadFile($field)) throw new NotFoundHttpException('The requested file does not exist.');
    }
    public function actionSlider($id, $field)
    {
        $model = Slider::findOne($id);
        if (!$model->downloadFile($field)) throw new NotFoundHttpException('The requested file does not exist.');
    }
    public function actionDownloadDetail($id, $field)
    {
        $model = DetailFoto::findOne($id);
        if (!$model->downloadFile($field)) throw new NotFoundHttpException('The requested file does not exist.');
    }
    public function actionDashboard()
    {
        // $this->layout = 'guest/main';
        $this->layout = 'guest/main';
        return $this->render('welcome');
    }



    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        // $this->layout = 'guest/main';
        // if (!Yii::$app->user->isGuest) {
        //     return $this->redirect('login');
        // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // if (!Yii::$app->user->can('lembaga_uji')) {
            //     Yii::$app->user->logout();
            //     Yii::$app->session->addFlash('error', 'Anda tidak mempunyai hak akses ke sistem ini.');
            // }
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        // $this->layout = "guest/main";
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            // Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            Yii::$app->session->setFlash('success', 'Pendaftaran berhasil. Silahkan login untuk melanjutkan.');
            return $this->redirect('login');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionChangePassword()
    {
        $model     = new PasswordForm;
        $modelUser = User::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                try {
                    $password = $_POST['PasswordForm']['newpass'];
                    $modelUser->setPassword($password);
                    $modelUser->generateAuthKey();

                    if ($modelUser->save(false)) {
                        Yii::$app->getSession()->setFlash('success', 'Password changed.');
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Password not changed.');
                    }
                } catch (\Exception $e) {
                    Yii::$app->getSession()->setFlash('error', "{$e->getMessage()}");
                }
            }
        }
        return $this->render('change-password', ['model' => $model]);
    }
    public function actionWishlist($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('login');
        } else {
            $model = WishList::findOne(['product_id' => $id, 'user_id' => Yii::$app->user->identity->id]);
            if ($model == null) {
                $wishlist = new WishList();
                $wishlist->product_id = $id;
                $wishlist->user_id = Yii::$app->user->identity->id;
                $wishlist->save();
                $this->redirect('index');
            } else {
                $model->delete();
                $this->redirect('index');
            }
        }
    }
}
