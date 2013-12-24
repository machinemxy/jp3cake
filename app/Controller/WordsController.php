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
		
	}
	?>