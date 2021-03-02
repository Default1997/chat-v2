<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Чат';

require 'usersList.php';
require 'bannedMessagesList.php';
?>

    <div class="row" id="chat">
        <?php 
            foreach ($allMessages as $msg): 
                if ($msg['status_message']) {
                    if (in_array($msg['author_id'], $adminList)){
                        echo '<div class="col bg-warning">';
                    }else{
                        echo '<div class="col bg-info">';
                    }
                        echo '<h4> <p>' . $msg->user->username . '</<p> </h4>' . ' ' ;
                        echo '<h3> <p>' . $msg->message . '</p> </h3>' . ' ';
                        echo '<p>' . $msg->time_of_writing. ' ' . $msg->status_message . '</p>' ;

                        //управление сообщениями для админов
                        if (in_array(Yii::$app->user->id, $adminList) && !Yii::$app->user->isGuest){ ?>
                            <div class="col" id="manageMessagesButton">
                                <?php $form = ActiveForm::begin() ?>
                                <?= $form->field($manage_messages, 'id_message')->hiddenInput(['value' => $msg->id])->label(false); ?>
                                <?= Html::submitButton('Убрать/Вернуть сообщение', ['class' => 'btn', 'style' => 'width: 100%']) ?>
                                <?php ActiveForm::end() ?>
                            </div>
                    <?php } echo "</div>";
                            
                            
                       

                    }elseif (!$msg->status_message && in_array(Yii::$app->user->id, $adminList)) {
                        echo '<div class="col bg-danger p">';

                            echo '<h4> <p>' . $msg->user->username . '</<p> </h4>';
                            echo '<h3> <p>' . $msg->message . '</p> </h3>';
                            echo '
                            <p>' . $msg->time_of_writing . ' ' . $msg->status_message . '</p>' ;
                            
                            //управление сообщениями для админов
                            if (in_array(Yii::$app->user->id, $adminList) && !Yii::$app->user->isGuest){ ?>

                                <div class="" id="manageMessagesButton">
                                    <?php $form = ActiveForm::begin() ?>
                                    
                                    <?= $form->field($manage_messages, 'id_message')->hiddenInput(['value' => $msg->id])->label(false); ?>
                                    <?php echo '</div>' ?>
                                    <?= Html::submitButton('Убрать/Вернуть сообщение', ['class' => 'btn', 'style' => 'width: 100%']) ?>
                                    <?php ActiveForm::end() ?>
                                </div>
                        
                 <?php } } ?>
                <br>
            <?php endforeach; ?>
    </div>

<?php 
    if(Yii::$app->user->isGuest) { 
        echo "<code>Авторизуйтесь, чтобы писать сообщения</code>";
    }else{ ?>
        <div class="row" id="chat_form">
            <?php $form = ActiveForm::begin();?>
            <?= $form->field($form_model, 'message')->label(false)->textInput(['style' => 'width: 100%']);?>
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success', 'style' => 'width: 100%']);?>
            <?php ActiveForm::end() ?>
        </div>
<?php   } ?>