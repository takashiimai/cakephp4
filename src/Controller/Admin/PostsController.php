<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\AppController;

use App\Consts\PostStatus;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PostsController extends AppController
{
	public $paginate = [
		'limit' => 10,
        'order' => [
            'updated_at' => 'desc'
        ]
	];

    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('admin/default');
        $this->loadComponent('Paginator');
    }

    public function index()
    {
//        $items = $this->Paginator->paginate($this->Posts->find());
        $items = $this->paginate($this->Posts);
        $this->set(compact('items'));
    }

    public function add()
    {
        $item = $this->Posts->newEmptyEntity();
        $session = $this->getRequest()->getSession();

        // セッションに入力情報があったら読み込む
        if ($session->check('inputs')) {
            $inputData = $session->consume('inputs');
 
            $item = $this->Posts->patchEntity(
                $item, $inputData
            );
        }

        $postStatus = PostStatus::toArray();

        $this->set(compact('item', 'postStatus'));
    }

    public function create()
    {
        $this->request->allowMethod(['post']);

        return $this->toTable();
    }

    public function edit($id)
    {
        $item = $this->Posts->get($id);
        $session = $this->getRequest()->getSession();

        // セッションに入力情報があったら読み込む
        if ($session->check('inputs')) {
            $inputData = $session->consume('inputs');
 
            $item = $this->Posts->patchEntity(
                $item, $inputData
            );
        }

        $postStatus = PostStatus::toArray();

        $this->set(compact('item', 'postStatus'));
    }

    public function update()
    {
        $this->request->allowMethod(['post']);

        return $this->toTable();
    }

    protected function toTable()
    {
        $inputData = $this->request->getData();
        unset($inputData['file']);

        $session = $this->getRequest()->getSession();
        $session->write('inputs', $inputData);

        if (isset($inputData['id']) && $inputData['id'] > 0) {
            $item = $this->Posts->patchEntity($this->Posts->get($inputData['id']), $inputData);
            $succsss = '更新しました。';
        } else {
            $item = $this->Posts->newEntity($inputData);
            $succsss = '新規登録しました。';
        }
 
        // バリデーションエラーの場合はセッションに入れて戻る
        if ($item->hasErrors()) {
            $this->Flash->set('バリデーションエラーです。', ['key' => 'error']);
            $json = json_encode($item->getErrors(), JSON_UNESCAPED_UNICODE);
            //echo $json; var_dump(json_decode($json, true));exit;
            $this->Flash->set($json, ['key' => 'validate']);

            if ($item->id > 0) {
                return $this->redirect(['controller' => 'Posts', 'action' => 'edit', 'id' => $item->id]);
            } else {
                return $this->redirect(['action' => 'add']);
            }
        }

        $file = $this->request->getData('file');
        if (!$file->getError()) {
            if (preg_match("/(.*)\.(.*)/", $file->getClientFilename(), $matches)) {
                $fname  = $matches[1];                  // ファイル名部分
                $fext   = '.' . $matches[2];            // 拡張子部分
            } else {
                $fname  = $file->getClientFilename();   // ファイル名部分
                $fext   = '';                           // 拡張子部分
            }
            $path = 'uploads' . DS . hash("sha256", $fname) . $fext;
            $file->moveTo(WWW_ROOT . $path);
            $item->image = $path;
        }

        $this->Posts->save($item);

        $session->delete("inputs");

        $this->Flash->set($succsss, ['key' => 'message']);
        return $this->redirect(['action' => 'index']);
    }

}
