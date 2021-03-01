<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Пиратская бухта';
?>

<script type="text/javascript">
    window.onload=function(){
        document.getElementById("chat").scrollTo(0,document.getElementById("chat").scrollHeight);
    }
</script>

<?php   if(in_array(Yii::$app->user->id, $adminList)){ ?>
            <div id="users_list">
                <table class="table">
<?php               foreach ($usersList as $key => $user) { ?>
                        <tr class="row align-middle">
                            <td class="col align-middle">
                                <?php echo $user->id; ?>
                            </td>
                            <td>
                                <?php echo $user->username; ?>
                            </td>
                            <td>
                                <?php echo $user->type; ?>
                            </td>
                            <td>
                                <?php $form = ActiveForm::begin() ?>
                                <?= Html::activeHiddenInput($form_manage, 'user_id', ['value' => $user->id]) ?>
                                <?= Html::submitButton('Повысить/Понизить', ['class' => 'btn', 'value' => $user->id]) ?>
                                <?php ActiveForm::end() ?>
                            </td>
                        </tr>
<?php               } ?>
                </table>
            </div>
<?php   } ?>

<?php   if(in_array(Yii::$app->user->id, $adminList)){ ?>
            <div id="bannedMessagesList">
                <table class="table">
<?php               foreach ($allMessages as $key => $msg) { ?>
<?php                   if ($msg['status_message'] == 'notDisplayed') { ?>
                            <tr>
                                <td>
                                    <?php echo $msg['username'] ?>
                                </td>
                                <td>
                                    <?php echo $msg['message'] ?>
                                </td>
                                <td>
                                    <?php echo $msg['time_of_writing'] ?>
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

    <div class="row" id="chat">
        <?php 
            foreach ($allMessages as $msg): 
                if ($msg['status_message'] == 'displayed') {
                    if (in_array($msg['author_id'], $adminList)){
                        echo '<div class="col bg-warning">';
                    }else{
                        echo '<div class="col bg-info">';
                    }
                        echo '<h4> <p>' . $msg['username'] . '</<p> </h4>' . ' ' ;
                        echo '<h3> <p>' . $msg['message']. '</p> </h3>' . ' ';
                        echo '<p>' . $msg['time_of_writing']. ' ' . $msg['status_message'] . '</p>' ;

                        //управление сообщениями для админов
                        if (in_array(Yii::$app->user->id, $adminList) && !Yii::$app->user->isGuest){ ?>
                            <div class="col" id="manageMessagesButton">
                                <?php $form = ActiveForm::begin() ?>
                                <?= $form->field($manage_messages, 'id_message')->hiddenInput(['value' => $msg['id']])->label(false); ?>
                                <?= Html::submitButton('Убрать/Вернуть сообщение', ['class' => 'btn', 'style' => 'width: 100%']) ?>
                                <?php ActiveForm::end() ?>
                            </div>
                    <?php } echo "</div>";
                            
                            
                       

                    }elseif ($msg['status_message'] == 'notDisplayed' && in_array(Yii::$app->user->id, $adminList)) {

                        //echo "string";
                        echo '<div class="col bg-danger p">';

                            echo '<h4> <p>' . $msg['username'] . '</<p> </h4>';
                            echo '<h3> <p>' . $msg['message']. '</p> </h3>';
                            echo '
                            <p>' . $msg['time_of_writing']. ' ' . $msg['status_message'] . '</p>' ;
                            
                            //управление сообщениями для админов
                            if (in_array(Yii::$app->user->id, $adminList) && !Yii::$app->user->isGuest){ ?>

                                <div class="" id="manageMessagesButton">
                                    <?php $form = ActiveForm::begin() ?>
                                    
                                    <?= $form->field($manage_messages, 'id_message')->hiddenInput(['value' => $msg['id']])->label(false); ?>
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
    <?php } ?>
<!-- </div> -->