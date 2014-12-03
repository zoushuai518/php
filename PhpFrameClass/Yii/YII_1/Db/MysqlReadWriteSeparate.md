YII 实现MySql读写分离：
[
	#demo url: http://www.yiibase.com/yii/view/484.html
	{
		Yii 实现MySQL多库和读写分离
		前段时间为SNS产品做了架构设计，在程序框架方面做了不少相关的压力测试，最终选定了YiiFramework，至于为什么没选用公司内部的PHP框架，其实理由很充分，公司的框架虽然是“前辈”们辛苦的积累，但毕竟不够成熟，没有大型项目的历练，犹如一个涉世未深的年轻小伙。Yii作为一个颇有名气开源产品，必定有很多人在使用，意味着有一批人在维护，而且在这之前，我也使用Yii开发过大型项目，Yii的设计模式和它的易扩展特性足以堪当重任。

		SNS同一般的社交产品不同的就是它最终要承受大并发和大数据量的考验，架构设计时就要考虑这些问题， web分布式、负载均衡、分布式文件存储、MySQL分布式或读写分离、NoSQL以及各种缓存，这些都是必不可少的应用方案，本文所讲的就是MySQL分库和主从读写分离在Yii的配置和使用。

		Yii默认是不支持读写分离的，我们可以利用Yii的事件驱动模式来实现MySQL的读写分离。

		Yii提供了一个强大的CActiveRecord数据库操作类，通过重写getDbConnection方法来实现数据库的切换，然后通过事件 beforeSave、beforeDelete、beforeFind 来实现读写服务器的切换，还需要两个配置文件dbconfig和modelconfig分别配置数据库主从服务器和model所对应的数据库名称

		以下是实现代码

		这是我写好的类，放在components文件夹里，然后所有的Model都继承ActiveRecord类就可以实现多库和主从读写分离了


		DBConfig.php
		{
			return array(
					'passport' => array(
						'write' => array(
							’class’ => ‘CDbConnection’,
							’connectionString’ => ‘mysql:host=10.1.39.2;dbname=db1′,
							’emulatePrepare’ => true,
							//’enableParamLogging’ => true,
							’enableProfiling’ => true,
							’username’ => ‘root’,
							’password’ => ”,
							’charset’ => ‘utf8′,
							‘schemaCachingDuration’=>3600,
							),
						’read’ => array(
							array(
								’class’ => ‘CDbConnection’,
								’connectionString’ => ‘mysql:host=10.1.39.3;dbname=db1,
								’emulatePrepare’ => true,
								//’enableParamLogging’ => true,
								’enableProfiling’ => true,
								’username’ => ‘root’,
								’password’ => ”,
								’charset’ => ‘utf8′,
								‘schemaCachingDuration’=>3600,
								),
							array(
								’class’ => ‘CDbConnection’,
								’connectionString’ => ‘mysql:host=10.1.39.4;dbname=db3′,
								’emulatePrepare’ => true,
								//’enableParamLogging’ => true,
								’enableProfiling’ => true,
								’username’ => ‘root’,
								’password’ => ”,
								’charset’ => ‘utf8′,
								‘schemaCachingDuration’=>3600,
								),
							),
						),
					);
		}

		ModelConfig.php
		{
			return array(
					//key为数据库名称，value为Model
					’passport’ => array(‘User’,'Post’),

					‘microblog’ => array(‘…’),

					);
		}

		ActiveRecord.php
		{
			/**
			* 基于CActiveRecord类的封装，实现多库和主从读写分离
			* 所有Model都必须继承些类.
			*
			* @author atao<lnbalife@126.com>
			*/
			class ActiveRecord extends CActiveRecord
			{
				//model配置
				public $modelConfig = ”;

				//数据库配置
				public $dbConfig = ”;

				//定义一个多数据库集合
				static $dataBase = array();

				//当前数据库名称
				public $dbName = ”;

				//定义库类型（读或写）
				public $dbType = ‘read’; //’read’ or ‘write’

				/**
				 * 在原有基础上添加了一个dbname参数
				 * @param string $scenario Model的应用场景
				 * @param string $dbname 数据库名称
				 */
				public function __construct($scenario=’insert’, $dbname = ”)
				{
					if (!empty($dbname))
						$this->dbName = $dbname;

					parent::__construct($scenario);
				}

				/**
				 * 重写父类的getDbConnection方法
				 * 多库和主从都在这里切换
				 */
				public function getDbConnection()
				{
					//如果指定的数据库对象存在则直接返回
					if (self::$dataBase[$this->dbName]!==null)
						return self::$dataBase[$this->dbName];

					if ($this->dbName == ‘db’){
						self::$dataBase[$this->dbName] = Yii::app()->getDb();
					}else{
						$this->changeConn($this->dbType);
					}

					if(self::$dataBase[$this->dbName] instanceof CDbConnection){
						self::$dataBase[$this->dbName]->setActive(true);
						return self::$dataBase[$this->dbName];
					} else
						throw new CDbException(Yii::t(‘yii’,'Model requires a “db” CDbConnection application component.’));

				}

				/**
				 * 获取配置文件
				 * @param unknown_type $type
				 * @param unknown_type $key
				 */
				private function getConfig($type=”modelConfig”,$key=”){
					$config = Yii::app()->params[$type];
					if($key)
						$config = $config[$key];
					return $config;
				}

				/**
				 * 获取数据库名称
				 */
				private function getDbName(){
					if($this->dbName)
						return $this->dbName;
					$modelName = get_class($this->model());
					$this->modelConfig = $this->getConfig(‘modelConfig’);
					//获取model所对应的数据库名
					if($this->modelConfig)foreach($this->modelConfig as $key=>$val){
						if(in_array($modelName,$val)){
							$dbName = $key;
							break;
						}
					}
					return $dbName;
				}

				/**
				 * 切换数据库连接
				 * @param unknown_type $dbtype
				 */
				protected function changeConn($dbtype = ‘read’){

					if($this->dbType == $dbtype && self::$dataBase[$this->dbName] !== null)
						return self::$dataBase[$this->dbName];

					$this->dbName = $this->getDbName();

					if(Yii::app()->getComponent($this->dbName.’_’.$dbtype) !== null){
						self::$dataBase[$this->dbName] = Yii::app()->getComponent($this->dbName.’_’.$dbtype);
						return self::$dataBase[$this->dbName];
					}

					$this->dbConfig = $this->getConfig(‘dbConfig’,$this->dbName);

					//跟据类型取对应的配置（从库是随机值）
					if($dbtype == ‘write’){
						$config = $this->dbConfig[$dbtype];
					}else{
						$slavekey = array_rand($this->dbConfig[$dbtype]);
						$config = $this->dbConfig[$dbtype][$slavekey];
					}

					//将数据库配置加到component中
					if($dbComponent = Yii::createComponent($config)){
						Yii::app()->setComponent($this->dbName.’_’.$dbtype,$dbComponent);
						self::$dataBase[$this->dbName] = Yii::app()->getComponent($this->dbName.’_’.$dbtype);
						$this->dbType = $dbtype;
						return self::$dataBase[$this->dbName];
					} else
						throw new CDbException(Yii::t(‘yii’,'Model requires a “changeConn” CDbConnection application component.’));
				}

				/**
				 * 保存数据前选择 主 数据库
				 */
				protected function beforeSave(){
					parent::beforeSave();
					$this->changeConn(‘write’);
					return true;
				}

				/**
				 * 删除数据前选择 主 数据库
				 */
				protected function beforeDelete(){
					parent::beforeDelete();
					$this->changeConn(‘write’);
					return true;
				}

				/**
				 * 读取数据选择 从 数据库
				 */
				protected function beforeFind(){
					parent::beforeFind();
					$this->changeConn(‘read’);
					return true;
				}

				/**
				 * 获取master库对象
				 */
				public function dbWrite(){
					return $this->changeConn(‘write’);
				}

				/**
				 * 获取slave库对象
				 */
				public function dbRead(){
					return $this->changeConn(‘read’);
				}
			}
			//end
		}
	}
]
