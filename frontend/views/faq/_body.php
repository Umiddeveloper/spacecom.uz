<section class="faq-area pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="faq-accordion">
                    <div class="accrodion-grp animated wow fadeInLeft faq-accrodion animated" data-wow-duration="1500ms" data-wow-delay="0ms" data-grp-name="faq-accrodion" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                        <?php use yii\helpers\Html;
                        use yii\widgets\ActiveForm;

                        foreach ($faqs as $faq) : ?>
                            <div class="accrodion">
                                <div class="accrodion-inner">
                                    <div class="accrodion-title">
                                        <h4><?=$faq->question?></h4>
                                    </div>
                                    <div class="accrodion-content" style="">
                                        <div class="inner">
                                            <p>
                                                <?=$faq->answer?>
                                            </p>
                                        </div><!-- /.inner -->
                                    </div>
                                </div><!-- /.accrodion-inner -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="faq-request-quote">
                    <span><?=Yii::t('app','Request a free Quote')?></span>
                    <?php $form = ActiveForm::begin(['id' => 'create-faq-form','action' => 'create-faq']); ?>
                    <div class="input-box">
                        <?= $form->field($model, 'message')->textarea(['placeholder' => Yii::t('app','Faq Message'), 'rows' => 10, 'cols' => 30])->label(false) ?>
                    </div>
                    <br>
                    <br>
                    <div class="form-group input-box">
                        <?= Html::submitButton(Yii::t('app','Get a free quote'), ['class' => 'main-btn']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>