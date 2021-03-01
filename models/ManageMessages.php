<?php
namespace app\models;
 
use yii\base\Model;
 
 
class ManageMessages extends Model
{
	public $id_message;

	public function rules()
	{
	    return [
	        [['id_message'], 'required']
	    ];
	} 	
}