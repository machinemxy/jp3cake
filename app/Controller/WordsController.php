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

			$this->Word->create();
			if($this->Word->save($this->request->data)){
				$this->Session->setFlash(__("新增成功"));
			}else{
				$this->Session->setFlash(__("新增失败"));	
			}
			$this->redirect('management?lesson='.$lesson.'&part='.$part);
		}

		public function modify(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$this->set('word',$word);
		}

		public function doModify(){
			$lesson=$this->request->data['Word']['lesson'];
			$part=$this->request->data['Word']['part'];
			
			$this->Word->id=$this->request->data['Word']['Id'];
			if($this->Word->save($this->request->data)){
				$this->Session->setFlash(__("修改成功"));
			}else{
				$this->Session->setFlash(__("修改失败"));
			}
			$this->redirect('management?lesson='.$lesson.'&part='.$part);

		}
		
		public function delete(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$lesson=$word['Word']['lesson'];
			$part=$word['Word']['part'];
			
			if($this->Word->delete($Id)){
				$this->Session->setFlash(__("删除成功"));
			}else{
				$this->Session->setFlash(__("删除失败"));
			}
			$this->redirect('management?lesson='.$lesson.'&part='.$part);
		}
		
		public function mistaken(){
			$words=$this->Word->query("select * from words as Word where wrongtimes>0 order by lesson,part,Id");
			$this->set('words',$words);
		}
		
		public function remember(){
			$Id=$this->request->query['Id'];
			$word=$this->Word->findById($Id);
			$word['Word']['wrongtimes']=0;
			$this->Word->id=$Id;
			if($this->Word->save($word)){
				$this->Session->setFlash(__("该词已从错词一览移除"));
			}else{
				$this->Session->setFlash(__("该词移除失败"));
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
			$this->set('lesson',$lesson);
			$this->set('part',$part);
			$this->set('words',$words);
		}
	}
	?>