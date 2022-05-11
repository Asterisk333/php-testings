    <?php include './utility/header.php'; ?>

    <main>
        <h1>Test Page</h1>
        <!--alerts-->
        <section>

        </section>
        <!--end of alerts-->
        <!--contact form-->
        <section class="container" id="contactForm">
            <form>
                <div class="card">
                    <div class="card-header">Kontakt</div>
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
                                <input type="text" name="subject" id="subject" placeholder="Betreff" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-2 col-form-label" for="message">Nachricht:</label>
                        <div>
                            <textarea id="message" class="form-control" rows="3"></textarea>
                        </div>
                        </div>
                    </div>
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

