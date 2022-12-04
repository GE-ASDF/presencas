<?php include_once "partials/cabecalho.php"; ?>
<?php include_once "helpers/dd.php" ?>
<?php include_once "helpers/sessions.php" ?>

<main id="indexMain" class="container bg-secondary bg-gradient p-2 d-flex flex-column">
     
    <?php ?>
        <div class="alertas m-2">
            <?php echo getMessage("verboerrado"); ?>
            <?php echo getMessage("verbocerto"); ?>
        </div> 
    <?php ?> 
    <div class="form-frequency d-flex justify-content-center align-items-center flex-column">
        <h1 class="title text-light">Confirme a sua presença</h1>
        <form method="POST" action="controllers/ControllerMarcarPresenca.php" class="d-flex flex-column justify-content-center align-items-center">

            <div class="form-group d-flex flex-column justify-content-center align-items-center col-5">
                <div class="d-flex justify-content-center align-items-center">
                    <label for="CodigoContrato" class="m-2 fs-2 text-white">Usuário:</label>
                    <input name="CodigoContrato" autofocus type="text" class="form-control p-2 fs-5" id="CodigoContrato" aria-describedby="CodigoContrato" placeholder="Digite seu usuário, ex: 493314, luang">
                </div>
                <?php echo getMessage("CodigoContrato") ?>
                <small class="text-white d-flex justify-content-center">
                    O usuário é o 'papelzinho' que você recebe no primeiro dia de aula.
                </small>
            </div>
            <div class="d-flex p-2 w-75 card mt-2 bg-dark text-white text-center">
                <div class="card-header">
                    Marque seus horários
                </div>
                <?php echo getMessage("HoraPresenca") ?>
                <div class="card-body">
                    <h5 class="card-title">Instruções</h5>
                    <p class="card-text">Se você tem 2h de aula você deverá marcar dois horários, por exemplo: 
                        se você fica de 08h às 10h, você deverá marcar os horários de <strong>08:00 às 09:00</strong> e
                        <strong>09:00 às 10:00</strong>
                    </p>
                    <p class="card-text">Se você tem 1h de aula você deverá marcar apenas 1(um) horário, por exemplo: 
                        se você fica de 08h às 09h, você deverá marcar somente o horário de <strong>08:00 às 09:00</strong>.
                    </p>
                </div>
                <div id="checkboxes" class="fs-5">
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="oito" name="HoraPresenca[]" value="08:00">
                        <label class="form-check-label m-1" for="oito">08:00 às 09:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="nove" name="HoraPresenca[]" value="09:00">
                        <label class="form-check-label m-1" for="nove">09:00 às 10:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="dez" name="HoraPresenca[]" value="10:00">
                        <label class="form-check-label m-1" for="dez">10:00 às 11:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="onze" name="HoraPresenca[]" value="11:00">
                        <label class="form-check-label m-1" for="onze">11:00 às 12:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="doze" name="HoraPresenca[]" value="12:00">
                        <label class="form-check-label m-1" for="doze">12:00 às 13:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="treze" name="HoraPresenca[]" value="13:00">
                        <label class="form-check-label m-1" for="treze">13:00 às 14:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="catorze" name="HoraPresenca[]" value="14:00">
                        <label class="form-check-label m-1" for="catorze">14:00 às 15:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="quinze" name="HoraPresenca[]" value="15:00">
                        <label class="form-check-label m-1" for="quinze">15:00 às 16:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="dezesseis" name="HoraPresenca[]" value="16:00">
                        <label class="form-check-label m-1" for="dezesseis">16:00 às 17:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="dezessete" name="HoraPresenca[]" value="17:00">
                        <label class="form-check-label m-1" for="dezessete">17:00 às 18:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="dezoito" name="HoraPresenca[]" value="18:00">
                        <label class="form-check-label m-1" for="dezoito">18:00 às 19:00</label>
                    </div>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input type="checkbox" class="form-check-input" id="dezenove" name="HoraPresenca[]" value="19:00">
                        <label class="form-check-label m-1" for="dezenove">19:00 às 20:00</label>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Se ainda estiver com dúvidas chame o educador(a).
                </div>
            </div>
            <div class="w-75">
                <div class="card bg-dark">
                    <div class="d-flex">
                        <input name="DataPresenca" readonly autofocus type="hidden" class="m-2 form-control p-2 fs-5" id="DataPresenca" aria-describedby="DataPresenca">
                        <input name="DiaSemana" readonly autofocus type="hidden" class="m-2 form-control p-2 fs-5" id="DiaSemana" aria-describedby="DiaSemana">
                    </div>
                    <div class="d-flex">
                        <input name="Computador" readonly value="<?php echo gethostbyaddr($_SERVER["REMOTE_ADDR"]); ?>" autofocus type="hidden" class="m-2 form-control p-2 fs-5" id="Computador" aria-describedby="Computador">
                        <input name="IpComputador" value="<?php echo $_SERVER["REMOTE_ADDR"]; ?>" autofocus type="hidden" class="m-2 form-control p-2 fs-5" id="IpComputador" aria-describedby="IpComputador">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark mt-3 align-self-start">Registrar</button>
            </div>
        </form>

    </div>
    
</main>

<?php include "partials/rodape.php";?>