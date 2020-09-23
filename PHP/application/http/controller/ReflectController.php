<?php
namespace Application\services\controllers;

class ReflectController extends sf\Web\Controller{


	public function actionSample(){
		$reflector = new \ReflectionClass(new app\models\Car(new app\models\Engine));
		echo "价格：<br>";
		var_dump($reflector->getProperty('price'));
		echo "默认属性值：<br>";
		var_dump($reflector->getProperties);

		echo "静态属性：<br>";
		var_dump($reflector->getStaticPropertyValue('model'));
		echo "所有静态属性：<br>";
		var_dump($reflector->getStaticProperties());

		if ($reflector->hasConstant('HEIGHT')) {
			echo "HEIGHT属性：" . $reflector->getConstant('HEIGHT');
		}
		if ($reflector->hasMethod('drive')) {
			echo "方法：<br>";
			var_dump($reflector->getMethod('dirve'));
		}

		echo 'FileName:'. $reflector->getFileName() . '<br>';
		echo 'FileName With namespace:'. $reflector->getName() . '<br>';
		echo 'Short FileName :'. $reflector->getShortName() . '<br>';
		echo 'Is Enbale Instance :'. $reflector->isInstantiable() . '<br>';
		echo 'Construtcor :'. $reflector->getConstructor() . '<br>';
		echo 'Method Document :'. $reflector->getMethod('dirve')->getDocComment() . '<br>';
		echo 'Parameters :<br>';
		$parameters = $reflector->getConstructor->getParameters();
		 var_dump( $parameters) ;
		 var_dump($parameters[0]->getClass());


		die;
	}
}
