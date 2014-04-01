在YII中实现 restful接口:

{
	首先做一下接口的 URL 规划，假设我们要面对的资源是 item ，现在我们暴露5个接口供其他应用调用，分别是：
	{
		对于所有 item 列表调用： GET /rest/item
		对于某个 item 信息调用： GET /rest/item/(\d+)
		创建一个 item： POST /rest/item
		更新一个 item： PUT /rest/item/(\d+)
		删除一个 item： DELETE /rest/item/(\d+)
	}

	然后根据规划在主配置里注册路由:
	{
		'urlManager'=>array(
				'urlFormat'=>'path',
				'rules'=>array(
					// REST routers
					array('rest/list', 'pattern'=>'rest/item', 'verb'=>'GET'),
					array('rest/view', 'pattern'=>'rest/item/', 'verb'=>'GET'),
					array('rest/create', 'pattern'=>'rest/item', 'verb'=>'POST'),
					array('rest/update', 'pattern'=>'rest/item/', 'verb'=>'PUT'),
					array('rest/delete', 'pattern'=>'rest/item/', 'verb'=>'DELETE'),
					),
				),
	}

	然后开始编写 REST 的 Controller，安装 yii 框架的约定，我们建立 protected/controllers/RestController.php ，文件内容结构如下：
	// Restful Controller file
	{
		// Restful Controller
		class RestController extends Controller
		{
			// Actions
			public function actionList()
			{
			}

			public function actionView()
			{
			}

			public function actionCreate()
			{
			}

			public function actionUpdate()
			{
			}

			public function actionDelete()
			{
			}

			// Assistant Functions
			private function _sendResponse()
			{
			}

			private function _getStatusCodeMessage()
			{
			}

		}

	}

	// Restful action file
	{

		获取 item 列表的方法：
		{
			public function actionList()
			{
				$items = Item::model()->findAll();
				if(empty($items)) 
				{
					$this->_sendResponse(200, 'No items');
				}
				else
				{
					$rows = array();
					foreach($items as $item)
						$rows[] = $item->attributes;
					$this->_sendResponse(200, CJSON::encode($rows));
				}
			}

		}

		获取某一 item 的方法：
		{
			public function actionView()
			{
				if(!isset($_GET['id']))
					$this->_sendResponse(500, 'Item ID is missing' );
				$item = Item::model()->findByPk($_GET['id']);
				if(is_null($item))
					$this->_sendResponse(404, 'No Item found');
				else
					$this->_sendResponse(200, CJSON::encode($item));
			}

		}

		新建一个 Item 的方法：
		{
			public function actionCreate()
			{
				$item = new Item;  
				foreach($_POST as $var=>$value) 
				{
					if($item->hasAttribute($var))
						$item->$var = $value;
					else
						$this->_sendResponse(500, 'Parameter Error');
				}
				if($item->save())
					$this->_sendResponse(200, CJSON::encode($item));
				else 
					$this->_sendResponse(500, 'Could not Create Item');
			}

		}

		更新一个 item 的方法：
		{
			public function actionUpdate()
			{
				//获取 put 方法所带来的 json 数据
				$json = file_get_contents('php://input');
				$put_vars = CJSON::decode($json,true);

				$item = Item::model()->findByPk($_GET['id']); 

				if(is_null($item))
					$this->_sendResponse(400, 'No Item found');

				foreach($put_vars as $var=>$value) 
				{
					if($item->hasAttribute($var))
						$item->$var = $value;
					else 
						$this->_sendResponse(500, 'Parameter Error');
				}

				if($item->save())
					$this->_sendResponse(200, CJSON::encode($item));
				else
					$this->_sendResponse(500, 'Could not Update Item');
			}

		}

		删除某一 item 的方法：
		{
			public function actionDelete()
			{
				$item = Item::model()->findByPk($_GET['id']);
				if(is_null)
					$this->_sendResponse(400, 'No Item found');
				if($item->delete())
					$this->_sendResponse(200, 'Delete Success');
				else
					$this->_sendResponse(500, 'Could not Delete Item');
			}

		}

	}

	返回响应的方法：
	{
		private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
		{
			$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
			header($status_header);
			header('Content-type: ' . $content_type);
			echo $body;
			Yii::app()->end();
		}

	}

	获取 http 状态码的方法：
	{
		private function _getStatusCodeMessage($status)
		{
			$codes = Array(
					200 => 'OK',
					400 => 'Bad Request',
					401 => 'Unauthorized',
					402 => 'Payment Required',
					403 => 'Forbidden',
					404 => 'Not Found',
					500 => 'Internal Server Error',
					501 => 'Not Implemented',
					);
			return (isset($codes[$status])) ? $codes[$status] : '';
		}

	}

}
