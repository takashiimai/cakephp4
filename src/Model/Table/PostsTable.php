<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostsTable extends Table
{
    public function initialize(array $config) : void
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ],
            ]
        ]);
    }

    /**
     * defaultバリデーション
     */
    public function validationDefault(Validator $validator): Validator 
    {
        $validator->notEmpty('title','タイトルは必須です');
        $validator->notEmpty('description','内容は必須です');

        return $validator;
    }
}