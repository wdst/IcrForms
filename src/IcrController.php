<?php



Class IcrController {
    
    
    public function registration()
    {
        $post = isset($_POST['EntryForm']) ? $_POST['EntryForm'] : $_POST;

        $step = !empty($post['step']) ? (int)$post['step'] : 1;
        $max = !empty($post['maxstep']) ? (int)$post['maxstep'] : 1;
        $back = !empty($post['back']) ? (int)$post['back'] : 0;
        $last = $step == $max;

        $code = 'participant_reg_member';

        $guid = $this->getGuid();

        if($step > $max){
            return $this->render('entry-confirm', ['model' => null ]);
        }

        if($back){
            $step = $step - 1;
        }

        $mainmodel = new MainModel($code);
        $model = $mainmodel->initModel(new EntryForm(), $step, ['guid' => $guid, 'code' => $code, 'step' => $step]);
        $maxStep = $model->getCountStep();
        
        if($back){
            return $this->renderForm('back', [
                'model' => $model,
                'step' => $step,
                'maxstep' => $maxStep,
                'debug' => [
                    'step' => $step,
                    'guid' => $guid,
                ],
                'errors' => $model->getErrors()
            ]);
        }
        
        if (!$model->load(Yii::$app->request->post()) || empty($post)) {

            return $this->renderForm('Load first', [
                'model' => $model,
                'step' => $step,
                'maxstep' => $maxStep,
                'debug' => [
                    'step' => $step,
                    'guid' => $guid,
                ],
                'errors' => $model->getErrors()
            ]);
        }

        if(!$model->validate(null, true)){
            return $this->renderForm('Not valid', [
                'model' => $model,
                'step' => $step,
                'maxstep' => $maxStep,
                'debug' => [
                    'step' => $step,
                    'guid' => $guid,
                ],
                'errors' => $model->getErrors()
            ]);
        }

        $json = new JsonRPCClient('http://api.json/index.php');
        $value = [];

        foreach($post as $key => $val) {
            if(in_array($key, $model->fieldList)){
                $value[] = [
                    'guid' => $guid,
                    'code' => $code,
                    'step' => $step,
                    'key'  => $key,
                    'val'  => $val,
                    'obj'  => @$mainmodel->form->fields[$key]->obj
                ];
            }
        }

        $test = $json->setSaveStepsForm($value, 1);

        if(!$test['success']){
            return $this->renderForm('Not success', [
                'model' => $model,
                'step' => $step + 1,
                'maxstep' => $maxStep,
                'debug' => [
                    'step' => $step,
                    'guid' => $guid,
                ],
                'errors' => $model->getErrors()
            ]);
        }

        if($last){
            $result = $this->saveForm($guid, $code);
            
            return $this->render('entry-confirm');
        }

        unset($mainmodel);unset($model);

        $step = $step + 1;
        
        $mainmodel = new MainModel($code);
        $model = $mainmodel->initModel(new EntryForm(), $step, ['guid' => $guid, 'code' => $code, 'step' => $step]);
        $maxStep = $model->getCountStep();

        return $this->renderForm('Next form', [
            'model' => $model,
            'step' => $step,
            'maxstep' => $maxStep,
            'debug' => [
                'step' => $step,
                'guid' => $guid,
            ],
            'errors' => $model->getErrors()
        ]);
    }
    
    
    
}

