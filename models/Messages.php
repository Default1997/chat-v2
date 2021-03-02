<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use DateTime;



class Messages extends ActiveRecord
{
    const MESSAGE_DISPLAYED = 1;
    const MESSAGE_NOT_DISPLAYED = 0;

    public static function tableName()
    {
        return 'messages';
    }

    
    public function getAllMessages()
    {
        $allMessages = Messages::find()->with('user')->All();

        return $allMessages;
    }

    public function changeMessageStatus(ManageMessages $manage_messages)
    {
        $currentMessage = Messages::find()->where(['id' => $manage_messages->id_message])->one();
        
        if ($currentMessage->status_message == self::MESSAGE_DISPLAYED) {
            $currentMessage->status_message = self::MESSAGE_NOT_DISPLAYED;
            $currentMessage->save();   
        }else{
            $currentMessage->status_message = self::MESSAGE_DISPLAYED;
            $currentMessage->save();
        }   
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }



    public function writeMessageToDB(ChatForm $form_model, $user_model)
    {

        $message = new Messages();
        
        $message->author_id = $user_model->id;
        $message->message = $form_model->message;
        $message->time_of_writing = date(DATE_ATOM);
        $message->status_message = self::MESSAGE_DISPLAYED;

        $message->save();
    }
}