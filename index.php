<?php
    //includes
    include './utility/header.php';

    //eingabe
    $formOptions = [
            'help'=>['title'=>'Benötige allgemeine Hilfe','selected'=>false],
            'feedback'=>['title'=>'Benötige feedback zum script','selected'=>false],
            'bug'=>['title'=>'Fehler entdeckt','selected'=>false],
            'business'=>['title'=>'Geschäftsanfrage','selected'=>false],
            'others'=>['title'=>'Sonstiges','selected'=>false],
    ];
    $isPostRequest = $_SERVER['REQUEST_METHOD'] == 'POST';
    $errors = [];
    $name = '';
    $message = '';
    $subject = '';
    $mrsIsSelected = false;
    $mrIsSelected = false;

    //Verarbeitung
if($isPostRequest){
    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);

    $mrsIsSelected = filter_input(INPUT_POST, 'salutation') === 'mrs';
    $mrIsSelected = filter_input(INPUT_POST, 'salutation') === 'mr';
    $isRobot = filter_input(INPUT_POST, 'robot') === 'on';

    if(isset($options[$subject])){
        $options[$subject]['selected'] = true;
    }

    if(!$name){
        $errors[] = 'Name ist leer';
    }
    if (!$mrIsSelected && !$mrsIsSelected) {
        $errors[] = 'Anrede auswählen';
    }
    if (!$message) {
        $errors[] = 'Bitte eine Nachricht hinterlassen';
    }
    if (!isset($options[$subject])) {
        $errors[] = 'Bitte betreff auswählen';
    }
    if(!$isRobot && count($errors) === 0){
        $salutation = 'Mrs';
        if ($mrIsSelected) {
            $salutation = 'Mr';
        }
        $data = [
            'salutation' => $salutation,
            'name' => $name,
            'subject'=>$options[$subject]['title'],
            'message'=>$message
        ];
        file_put_contents('datei.txt', serialize($data) . ';;;', FILE_APPEND);

        $_POST = [];
        $mrIsSelected = false;
        $mrsIsSelected = false;
        $options[$subject]['selected'] = false;
        $subject = null;
        $isRobot = false;
        $name = '';
        $message = '';
    }
}

    //ausgabe

?>

    <main>
        <h1>Test Page</h1>
        <!--alerts-->
        <?php if($isPostRequest):?>
        <section class="container" id="alerts">
            <?php if(count($errors) == 0):?>
            <div class="alert alert-success" role="alert">
                Anfrage Versendet
            </div>
            <?php endif;?>
            <?php if(count($errors)>0):?>
            <div class="alert alert-danger" role="alert">
                Ein Fehler ist aufgetreten
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php foreach($errors as $errorMessage):?>
                    <p><?= $errorMessage ?></p>
                <?php endforeach;?>
            </div>
            <?php endif;?>
        </section>
        <?php endif;?>
        <!--end of alerts-->
        <!--contact form-->
        <section class="container" id="contactForm">
            <form>
                <div class="card">
                    <div class="card-header">Kontakt</div>
                    <!--form content-->
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-2">
                            Anrede:
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input name="salutation" type="radio" id="salutationMrs"  value="mrs">
                                    <label for="salutationMrs">Frau</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="salutation" type="radio" id="salutationMr" value="mr" >
                                    <label for="salutationMr">Herr</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div>
                                <label class="col-2 col-form-label" for="name">Name:</label>
                            </div>
                            <div class="col">
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div>
                                <label class="col-2 col-form-label" for="subject">Betreff:</label>
                            </div>
                            <div class="col">
                                <select id="subject" name="subject" class="form-control">
                                    <option>Bitte wählen</option>
                                    <?php
                                        foreach ($formOptions as $value=>$item):
                                        $selectString = '';
                                        if($item['selected'])
                                            $selectString = ' selected';
                                    ?>
                                    <option value="<?= $value?>"<?= $selectString?>><?= $item['title']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-2 col-form-label" for="message">Nachricht:</label>
                        <div>
                            <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                        </div>
                        </div>
                    </div>
                    <!--end form content-->
                    <div class="card-footer">
                        <button class="btn btn-primary">Anfrage senden</button>
                        <!--<a href="/" class="btn btn-danger">Abbrechen</a>-->
                    </div>
                </div>
            </form>
        </section>
        <!--end of contact form-->
    </main>

    <?php include './utility/footer.php'; ?>

