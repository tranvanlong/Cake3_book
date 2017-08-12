<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[] paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    //public $helpers = array('Session');

    public function index()
    {
        // $this->paginate = [
        //     'contain' => ['Categories']
        // ];
        // $books = $this->paginate($this->Books);

        //$this->set(compact('books'));
        // $this->set('_serialize', ['books']);

        
        $books = $this->Books->find('all',[
            'fields' => ['id','title','image','sale_price','slug'],
            'order' => ['created' =>'desc'],
            'limit' => 9,
            'conditions' => ['published'=>1],
            'paramType' =>'querystring',
            'contain' => ['Writers']
            ]);
        $this->set('books',$books);
        
    }

    /**
     * latest_book method: hien thi 10 quyen sach moi nhat
     *
     * @return \Cake\Http\Response|void
     */
    public function latest() {
        $this->paginate = [
            'fields' => ['id','title','image','sale_price','slug'],
            'order' => ['created' =>'desc'],
            'limit' => 3,
            'conditions' => ['published'=>1],
            'contain' => ['Writers']
            ];
        $books = $this->paginate();
        $this->set('books',$books);
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $book = $this->Books->find('all', [
            'contain' => ['Categories', 'Writers', 'Comments'],
            'conditions' => ['Books.slug'=>$slug]
        ])->first();

        if (empty($book)) {
            throw new NotFoundException(__('Không tìm thấy quyển sách này'));
        }    

        $this->set('book', $book);

        //hien thi comments
        $this->loadModel('Comments');
        $comments = $this->Comments->find('all',[
            'conditions'=> ['book_id'=>$book['Book']['id']],
            'order'=>['Comments.created'=>'asc'],
            'contain'=>['Users']]
            );
        $this->set('comments',$comments);

        //hien thi danh sach lien quan
        $related_books = $this->Books->find('all', [
            'fields'=>['title','image','sale_price','slug'],
            'conditions'=>[
                'category_id'=>$book['Book']['category_id'],
                'Book.id <>'=> $book['Book']['id'],
                'published'=>1],
            'limit'=>5,
            //'order'=>'rand()',
            'contain'=>['Writers']
            ]);
        //pr($related_books);die;
        //pr($book);die;
        $this->set('related_books',$related_books);

        /*if ($this->request->session()->check('comment_error')) {
            # code...
            $errors=$this->request->session()->read('comment_error');
            $this->set('error',$error);
            $this->request->session()->delete('comment_error');
        }*/
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $book = $this->Books->newEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $categories = $this->Books->Categories->find('list', ['limit' => 200]);
        $writers = $this->Books->Writers->find('list', ['limit' => 200]);
        $this->set(compact('book', 'categories', 'writers'));
        $this->set('_serialize', ['book']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['Writers']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $categories = $this->Books->Categories->find('list', ['limit' => 200]);
        $writers = $this->Books->Writers->find('list', ['limit' => 200]);
        $this->set(compact('book', 'categories', 'writers'));
        $this->set('_serialize', ['book']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
