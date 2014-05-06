
COutputCache
{
	CCacheDependency
	CChainedCacheDependency
	CDbCacheDependency
	CDirectoryCacheDependency
	CExpressionDependency
	CFileCacheDependency
	CGlobalStateCacheDependency
}

{
#zs demo
	以下方法在 Controller 中
	//CDbCacheDependency
	public function filters() {
	//	$cache_time = Yii::app()->cache->get('zdm_article_key');
		return array(
		    array(
				'COutputCache + Index,Wanwei,Shihui,Tansuo',
				'duration' => 1800,
				),
			'dependency'=>array(
				'class'=>'CDbCacheDependency',
				'sql'=>'SELECT MAX(date_time) FROM cms_zdm_article',	//根据 date_time 字段的改变来决定依赖 [如果 date_time的最大值发生改变,则重新生成依赖;date_time为最后更新时间{用户添加,修改记录此字段都会被更新}]
			),
			'varyByParam' => array('page','pid','aid'),
		    ),
		);
		
	}


	//CExpressionDependency
	public function filters() {
		return array(
			array(
				'COutputCache+Index,Wanwei,Shihui,Tansuo',
				'duration' => 1800,
				'dependency'=>array(
					'class'=>'CExpressionDependency',
					'expression'=>'Yii::app()->cache->get("zdm_article_key")',
					'reuseDependentData'=>true,
				),
				'varyByParam' => array('page','pid','aid'),
				'cacheID' => 'cache',
			),
		);

	}

}