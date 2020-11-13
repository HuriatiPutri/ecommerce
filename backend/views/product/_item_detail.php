<?php

use yii\helpers\Html;
use kartik\widgets\FileInput;

?>

<td>
	<?= $form->field($model, '[$key]foto', ['template' => "{input}\n{error}{hint}"])->widget(FileInput::className(), [
                // 'options' => ['accept' => 'image/*, application/pdf'],
                'pluginOptions' => [
                    'showPreview'           => false,
                    'showUpload'            => false,
                    // 'allowedFileExtensions' => ['pdf', 'png', 'jpg', 'jpeg'],
                    // 'elErrorContainer'      => '#error-media_file_physical-file',
                ]
            ]) ?>
</td>