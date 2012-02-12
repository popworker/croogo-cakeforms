<?php
class CformsController extends CformsAppController {

	var $name = 'Cforms';
	var $components = array('RequestHandler');
	var $helpers = array('Html', 'Form');

	function admin_edit($id = null) {
	
	
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Cform', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Cform->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The Form has been saved', true));
			} else {
				$this->Session->setFlash(__('The Cform could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Cform->read(null, $id);
		}

		if(empty($this->request->data['Cform']['recipient'])){
			$this->request->data['Cform']['recipient'] = Configure::read('Site.email');
		}

		if(empty($this->request->data['Cform']['from'])){
			$this->request->data['Cform']['from'] = Configure::read('Site.email');
		}

		$nexts = $this->Cform->Next->find('list');
		$types = $this->Cform->FormField->types;
		$multiTypes = $this->Cform->FormField->multiTypes;;
		$this->set(compact('nexts', 'types', 'multiTypes'));
	}


	function admin_index() {
	
	
	
		$this->Cform->recursive = 0;
		$this->set('cforms', $this->paginate());
	}

	function admin_add() {
	
		if (!empty($this->request->data)) {
			$this->Cform->create();
			if ($this->Cform->save($this->request->data)) {
				$this->Session->setFlash(__('The Form has been created', true));
				$this->redirect(array('action' => 'edit', $this->Cform->id));
			} else {
				$this->Session->setFlash(__('The From could not be created. Please, try again.', true));
			}
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Form', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Cform->del($id)) {
			$this->Session->setFlash(__('Form deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Form could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_list_cforms(){
		//$this->layout = 'tinymce';
		
		$this->set('cforms', $this->Cform->find('list'));
	}

}
?>