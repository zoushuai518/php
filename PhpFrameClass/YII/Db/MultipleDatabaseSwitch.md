#YII 多数据库切换 方式:
方式1：
{
	Yii中同时连接多个数据库:
	1>、在主配置文件 （main.php） 中：
	{
		'db'=>array(
				'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		'db2'=>array(
				'class'            => 'CDbConnection' ,
				'connectionString' => 'mysql:host=localhost;dbname=test',
				'emulatePrepare' => true,
				'username' => 'test',
				'password' => 'test',
				'charset' => 'utf8',
		),
		注意，第二个以后的db数组中一定要写上class参数，让Yii 知道你在定义一个数据库连接对象，不然会报错。
		一旦我们这样定义以后，就可以通过Yii::app()->db2 来指向第二个数据库了

	}
	2>、重载 GetDbConnection() 方法:
	{
		因为每个Model都是（直接或者间接地）继承自基类CActiveRecord的，因此，都包含GetDbConnection()这个方法，GetDbConnection()返回一个数据库连接对象的句柄。我们需要在模型（model）里面通过重载这个方法来返回我们需要的数据库对象。
		然后，假设我们新建了一文件 ： protected/components/MyActiveRecord.php ，然后在你的所有要用db2这个数据库的model里extend MyActiveRecord 而不是 CActiveRecord 。
		这里我们是通过扩展Yii通用类来定义一个新的类，而不是在每个模型里面都重载 getDbConnection 方法，这样做的好处是更大程度上的代码重用，节省时间。
		{
			// protected/components/MyActiveRecord.php
			class MyActiveRecord extends CActiveRecord {
				protected $dbString = 'gzx';
				public function getDbConnection()
				{
					if(self::$db!==null)
						return self::$db;
					else
					{
						//这里就是我们要修改的
						//self::$db=Yii::app()->getComponent('db2');

						$dbString = $this->dbString;
						self::$db=Yii::app()->$dbString;
						if(self::$db instanceof CDbConnection)
							return self::$db;
						else
							throw new CDbException(Yii::t('yii','Active Record requires a "db2" CDbConnection application component.'));
					}
				}
			}
			//end

		}
	}
	3>、在模型中使用:
	{
		// protected/models/Ad.php
		class Ad extends MyActiveRecord {
			#...
		}
		//end
	}

}

方式2：
{
	b5m BI DB con | main.php:
	{
		{
			'gzx'=>array(
					'class'              => 'CDbConnection' ,
					'connectionString'   => 'mysql:host=172.16.11.218;dbname=price_war',
					'emulatePrepare'     => true,
					'tablePrefix'        =>'cms_',
					'username'           => 'root',
					'password'           => 'izene123',
					'charset'            => 'utf8',
					'enableProfiling'    =>true,
					'enableParamLogging' => true,
					),
		}	
	}
	直接修改 对应的  module 即可 |来自b5m 电商排行 demo：
	{

		//BrandTop module
		class BrandTop extends CActiveRecord
		{
			// public function __construct()
			// {
			//	CActiveRecord::$db = Yii::app()->gzx;
			// }
			/**
			 * @return string the associated database table name
			 */
			public function tableName()
			{
				// return '{{brand_top}}';
				return 'cms_brand_top';
			}

			/**
			 * @return CDbConnection the database connection used for this class
			 */
			public function getDbConnection() {
				return Yii::app()->gzx;
			}

		}
	
	}
}

