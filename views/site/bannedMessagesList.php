<?php   
use yii\helpers\Html;
use yii\widgets\ActiveForm;

        if(in_array(Yii::$app->user->id, $adminList)){ ?>
            <div id="bannedMessagesList">
                <table class="table">
<?php               foreach ($allMessages as $key => $msg) { ?>
<?php                   if (!$msg['status_message']) { ?>
                            <tr>
                                <td>
                                    <?php echo $msg->user->username ?>
                                </td>
                                <td>
                                    <?php echo $msg->message ?>
                                </td>
                                <td>
                                    <?php echo $msg->time_of_writing ?>
                                </td>
                                <td>
                                    <?php $form = ActiveForm::begin() ?>
                                    <?= Html::activeHiddenInput($manage_messages, 'id_message', ['value' => $msg['id']]) ?>
                                    <?= Html::submitButton('Вернуть', ['class' => 'btn', 'style' => 'width: 100%', 'style' => 'height: 100%']) ?>
                                    <?php ActiveForm::end() ?>
                                </td>
                            </tr>
<?php                   } ?>                         
<?php               } ?>                    
                </table>
            </div>
<?php   } ?>