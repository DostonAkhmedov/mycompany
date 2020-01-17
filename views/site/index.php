<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">

        <h1>List of companies of Russia</h1>

        <? if (Yii::$app->user->isGuest): ?>
            <p class="lead">
                <?php echo Html::a('Register', ['site/signup'], ['class' => 'btn btn-link']); ?>
                or
                <?php echo Html::a('Login', ['site/login'], ['class' => 'btn btn-link']); ?>
                to start
            </p>
        <? else: ?>
            <p class="lead">
                <?php echo Html::a('List of companies', ['company/index'], ['class' => 'btn btn-info']); ?>
            </p>
        <? endif; ?>
    </div>

    <div class="body-content">
        <p class="text-justify">
            Russia has an upper-middle income mixed economy with state ownership in strategic areas of the economy.
            Market reforms in the 1990s privatized much of Russian industry and agriculture, with notable exceptions to
            this privatization occurring in the energy and defense-related sectors.

            Russia's vast geography is an important determinant of its economic activity, with some sources estimating
            that Russia contains over 30 percent of the world's natural resources. The World Bank estimates the
            total value of Russia's natural resources at $75 trillion US dollars. Russia relies on energy revenues
            to drive most of its growth. Russia has an abundance of petroleum, natural gas and precious metals, which
            make up a major share of Russia's exports. As of 2012 the oil-and-gas sector accounted for 16% of the GDP,
            52% of federal budget revenues and over 70% of total exports.
        </p>
    </div>
</div>
