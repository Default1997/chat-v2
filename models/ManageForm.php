<?php
namespace app\models;
 
use yii\base\Model;
 
 
class ManageForm extends Model
{
	public $user_id;

	public function rules()
	{
	    return [
	        [['user_id'], 'required']
	    ];
	} 	
}