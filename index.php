<?php
    include './utility/header.php';
    $formOptions = [
            'help'=>['title'=>'Benötige allgemeine Hilfe','selected'=>false],
            'feedback'=>['title'=>'Benötige feedback zum script','selected'=>false],
            'bug'=>['title'=>'Fehler entdeckt','selected'=>false],
            'business'=>['title'=>'Geschäftsanfrage','selected'=>false],
            'others'=>['title'=>'Sonstiges','selected'=>false],
    ];
    $isPostRequest =$_SERVER['REQUEST_METHOD'] == 'POST';
    $errors = [];
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
            <div class="alert alert-danger" role="alert">
                Ein Fehler ist aufgetreten
            </div>
        </section>
        <?php endif;?>
        <!--end of alerts-->
        <!--contact form-->
        <section class="container" id="contactForm">
            <form method="post">
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

