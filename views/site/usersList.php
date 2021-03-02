<?php   
use yii\helpers\Html;
use yii\widgets\ActiveForm;

        if(in_array(Yii::$app->user->id, $adminList)){ ?>
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