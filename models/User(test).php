<?php

namespace app\models;
 
use Yii;
use yii\db\ActiveRecord;
 
 
class User extends ActiveRecord
{
	public static function tableName()
    {
        return 'user';
    }

	public function getAdminList()
    {
        $info = User::find()->select('id, username')->where('type = "administrator" ')->all();

        $adminList = array();

        foreach ($info as $key => $user) {

        	array_push($adminList, $user->id);
        }

        //var_dump($adminList);
        return $adminList;
    }

    public function getUsersList(){
    	$userList = User::find()->select('id, username, type')->All();
    	
    	return $userList;
    }

    public function changeUserType(ManageForm $form_model)
    {	
    	$currentUser = User::find()->where(['id' => $form_model->user_id])->one();
    	
    	if ($currentUser->type == 'administrator') {
    		$currentUser->type = 'simpleUser';
			$currentUser->save();	
    	}else{
    		$currentUser->type = 'administrator';
			$currentUser->save();
    	}
    }


    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['author_id' => 'id']);
    }
}
