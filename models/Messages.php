<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;



class Messages extends ActiveRecord
{
    public static function tableName()
    {
        return 'messages';
    }

    public function getAllMessages()
    {
        //return Messages::find()->all();
        $query = new Messages();

        $allMessages = Messages::find()
            ->select(['`message`, `username`, `time_of_writing`, `author_id`, `status_message`, `messages`.`id`'])
            ->leftJoin('user', '`user`.`id` = `messages`.`author_id`')
            ->with('user')
            ->asArray()
            ->all();
            //var_dump($allMessages);
        return $allMessages;
    }

    public function changeMessageStatus(ManageMessages $manage_messages)
    {
        $currentMessage = Messages::find()->where(['id' => $manage_messages->id_message])->one();
        
        if ($currentMessage->status_message == 'displayed') {
            $currentMessage->status_message = 'notDisplayed';
            $currentMessage->save();   
        }else{
            $currentMessage->status_message = 'displayed';
            $currentMessage->save();
        }   
    }

    public function getUser()
    {
        return $this->hasMany(User::className(), ['id' => 'author_id']);
    }

    public function writeCommentToDB(ChatForm $form_model)
    {

        $message = new Messages();

        $message->author_id = Yii::$app->user->identity->id;
        $message->message = $form_model->message;
        $message->time_of_writing = date('Y-m-d H:i:s');
        $message->status_message = 'displayed';

        //
        $message->save();
    }
}