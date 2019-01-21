<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--
    <p>
        <?= Html::a('Create Address', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
//		'filterModel' => $searchModel,
		'columns' => [
//			['class' => 'yii\grid\SerialColumn'],

//			'id',
//			'bot_id',
			[
				'attribute' => 'bot_id',
				'label' => 'Название бота',
				'value' => 'bot.name'
			],
            'ip',
            'create_date',

//			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
