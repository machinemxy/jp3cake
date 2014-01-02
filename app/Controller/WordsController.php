<?php
	class WordsController extends AppController{
		
		public $helper=array('Html','Form','Session');
		public $components=array('Session');
		public $uses = array('Word', 'Config');
		
		public function index(){
			//获得总课程数和部分数
			$config=$this->Config->find('first');
			$this->set('lessonCount',$config['Config']['lesson']);
			$this->set('partCount',$config['Config']['part']);
			
			//获得选中课程号
			if(!isset($this->request->query['lesson'])){
				$this->set('lesson',0);
			}else{
				$this->set('lesson',$this->request->query['lesson']);
			}
			
			//获得选中部分号
			if(!isset($this->request->query['part'])){
				$this->set('part',0);
			}else{
				$this->set('part',$this->request->query['part']);
			}
		}
		
		public function management(){
			$lesson=$this->request->query['lesson'];
			$part=$this->request->query['part'];
			$words=$this->Word->findAllByLessonAndPart($lesson,$part);
			$this->set('lesson',$lesson);
			$this->set('part',$part);
			$this->set('words',$words);
		}
		
		public function insert(){
			$lesson=$this->request->query['lesson'];
			$part=$this->request->query['part'];
			$this->set('lesson',$lesson);
			$this->set('part',$part);
		}

		public function doInsert(){
			$lesson=$this->request->data['Word']['lesson'];
			$part=$this->request->data['Word']['part'];
			$kana=$this->request->data['Word']['kana'];

			$this->Word->create();
			if($this->Word->save($this->request->data)){
				$this->Session->setFlash("「".$kana."」新增成功",'default',array('class'=>'success'));
			}else{
				$this->Session->setFlash(__("「".$kana."」新增失败"));	
			}
			$this->redirect('insert?lesson='.$lesson.'&part='.$part);
		}

		public function modify(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$this->set('word',$word);
		}

		public function doModify(){
			$lesson=$this->request->data['Word']['lesson'];
			$part=$this->request->data['Word']['part'];
			$kana=$this->request->data['Word']['kana'];
			
			$this->Word->id=$this->request->data['Word']['Id'];
			if($this->Word->save($this->request->data)){
				$this->Session->setFlash("「".$kana."」修改成功",'default',array('class'=>'success'));
			}else{
				$this->Session->setFlash(__("「".$kana."」修改失败"));
			}
			$this->redirect('management?lesson='.$lesson.'&part='.$part);

		}
		
		public function delete(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$lesson=$word['Word']['lesson'];
			$part=$word['Word']['part'];
			$kana=$word['Word']['kana'];
			
			if($this->Word->delete($Id)){
				$this->Session->setFlash("「".$kana."」删除成功",'default',array('class'=>'success'));
			}else{
				$this->Session->setFlash(__("「".$kana."」删除失败"));
			}
			$this->redirect('management?lesson='.$lesson.'&part='.$part);
		}
		
		public function mistaken(){
			$words=$this->Word->find('all',array('conditions'=>array('wrongtimes >'=>0),'order'=>array('lesson','part','Id')));
			$this->set('words',$words);
		}
		
		public function remember(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$kana=$word['Word']['kana'];
			$word['Word']['wrongtimes']=0;
			$this->Word->id=$Id;
			if($this->Word->save($word)){
				$this->Session->setFlash("「".$kana."」已从错词一览移除",'default',array('class'=>'success'));
			}else{
				$this->Session->setFlash(__("「".$kana."」移除失败"));
			}
			$this->redirect('mistaken');
		}
		
		public function procedure(){
			$procedures=$this->Word->query("select lesson,part,max(times) maxtimes,min(times) mintimes,max(masterdate) maxdate from words group by lesson,part order by lesson,part");
			$this->set('procedures',$procedures);
		}
		
		public function test(){
			$lesson=$this->request->query['lesson'];
			$part=$this->request->query['part'];
			$count=$this->Word->find('count',array('conditions'=>array('lesson'=>$lesson,'part'=>$part)));
			if($count<4){
				$message="";
				if($count==0){
					$message="本部分还没有单词,请先至[词库管理]添加单词";
				}else{
					$message="本部分单词数不足4个,请先至[词库管理]添加单词";
				}
				$this->set('lesson',$lesson);
				$this->set('part',$part);
				$this->Session->setFlash(__($message));
			}else{
				$count=$this->Word->find('count',array('conditions'=>array('lesson'=>$lesson,'part'=>$part,'times <'=>3)));
				if($count>0){
					$order=rand(0,$count-1);
					$word=$this->Word->find('first',array('conditions'=>array('lesson'=>$lesson,'part'=>$part,'times <'=>3),'offset'=>$order,'limit'=>1));

					$times=$word['Word']['times'];
					$Id=$word['Word']['Id'];
					if($times==0){
						$this->redirect('test1?Id='.$Id);
					}else if($times==1){
						$this->redirect('test2?Id='.$Id);
					}else if($times==2){
						$this->redirect('test3?Id='.$Id);
					}
				}else{
					$this->set('lesson',$lesson);
					$this->set('part',$part);
					$this->Session->setFlash("恭喜!您已完成本课所有单词",'default',array('class'=>'success'));
				}
			}
		}

		public function test1(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$lesson=$word['Word']['lesson'];
			$part=$word['Word']['part'];

			$confusions=$this->Word->query("select * from words as Word where Id!=".$Id." and lesson=".$lesson." and part=".$part." order by rand() limit 0,3");
			for($i=0;$i<3;$i++){
				$selections[$i]=$confusions[$i]['Word']['kanji']."|".$confusions[$i]['Word']['meaning'];
			}
			$correct=$word['Word']['kanji']."|".$word['Word']['meaning'];
			$selections[3]=$correct;
			shuffle($selections);

			$this->set('Id',$Id);
			$this->set('kana',$word['Word']['kana']);
			$this->set('lesson',$lesson);
			$this->set('part',$part);
			$this->set('selections',$selections);
			$this->set('correct',$correct);
		}

		public function test2(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$lesson=$word['Word']['lesson'];
			$part=$word['Word']['part'];

			$confusions=$this->Word->query("select * from words as Word where Id!=".$Id." and lesson=".$lesson." and part=".$part." order by rand() limit 0,3");
			for($i=0;$i<3;$i++){
				$selections[$i]=$confusions[$i]['Word']['kana'];
			}
			$correct=$word['Word']['kana'];
			$selections[3]=$correct;
			shuffle($selections);

			$this->set('Id',$Id);
			$this->set('description',$word['Word']['kanji']."|".$word['Word']['meaning']);
			$this->set('lesson',$lesson);
			$this->set('part',$part);
			$this->set('selections',$selections);
			$this->set('correct',$correct);
		}

		public function test3(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$lesson=$word['Word']['lesson'];
			$part=$word['Word']['part'];

			$this->set('Id',$Id);
			$this->set('description',$word['Word']['kanji']."|".$word['Word']['meaning']);
			$this->set('lesson',$lesson);
			$this->set('part',$part);
			$this->set('correct',$word['Word']['kana']);
		}

		public function check(){
			$Id=$this->request->data['Id'];
			$lesson=$this->request->data['lesson'];
			$part=$this->request->data['part'];
			$selection=$this->request->data['selection'];
			$correct=$this->request->data['correct'];
			
			$word=$this->Word->findById($Id);
			if($selection==$correct){
				$word['Word']['times']+=1;
				if($word['Word']['times']==3){
					date_default_timezone_set("Asia/Shanghai");
					$word['Word']['masterdate']=date('Y-m-d H:i:s',time());
				}
				$this->Word->id=$Id;
				$this->Word->save($word);
				$this->Session->setFlash("正确",'default',array('class'=>'success'));
				$this->redirect('test?lesson='.$lesson.'&part='.$part);
			}else{
				$word['Word']['times']=0;
				$word['Word']['wrongtimes']+=1;
				$this->Word->id=$Id;
				$this->Word->save($word);
				$this->Session->setFlash(__('错误'));
				$this->set('word',$word);
				$this->set('lesson',$lesson);
				$this->set('part',$part);
			}
		}
	}
?>