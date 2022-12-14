<?php include_once "partials/cabecalho.php"; ?>
<?php include_once "helpers/dd.php" ?>
<?php include_once "helpers/sessions.php" ?>

<div class="container">
            <main id="main-index" class="">
                <div class="principal">
                    <section class="">
                        <div id="card-form" class="card bg-white border-0 shadow-none">
                            <div class="mensagem m-3 d-flex">
                                <?php echo getMessage("message") ?>
                            </div>
                            <div class="card-header bg-white border-0 shadow-none">
                                <h1 class="title fw-bold an-title">Dê sua presença</h1>
                            </div>
                            <div class="card-body">
                                <form id="frequency-form" method="POST">
                                    <div class="form-group">
                                        <label class="title fs-2 fw-bold an-title" for="CodigoContrato">
                                            Usuário:
                                        </label>
                                        <input id="CodigoContrato" autofocus type="text" name="CodigoContrato" placeholder="Ex.: 423366, lucask" class="form-control an-input">
                                        <?php echo getMessage("CodigoContrato") ?>
                                        <input readonly name="DataPresenca" type="hidden" class="m-2 form-control p-2 fs-5" id="DataPresenca" aria-describedby="DataPresenca">
                                        <input readonly name="DiaSemana" type="hidden" class="m-2 form-control p-2 fs-5" id="DiaSemana" aria-describedby="DiaSemana">
                                        <input readonly name="Computador" value="<?php echo gethostbyaddr($_SERVER["REMOTE_ADDR"]) ?>" type="hidden" class="m-2 form-control p-2 fs-5" id="Computador" aria-describedby="Computador">
                                        <input readonly name="IpComputador" value="<?php echo $_SERVER["REMOTE_ADDR"] ?>" type="hidden" class="m-2 form-control p-2 fs-5" id="IpComputador" aria-describedby="IpComputador">
                                    </div>
                                    <div class="card mt-4">
                                        <div class="card-header an-card-header text-center">
                                            <span class="fw-bold fs-5">Marque seus horários</span>    
                                        </div>
                                        <div class="card-body p-0">
                                            <div id="instrucoes" class="p-3">
                                                <h2 class="title fw-bold text-white text-uppercase">Instruções</h2>
                                                <?php echo getMessage("HoraPresenca") ?>
                                                <div class="content mt-3">
                                                    <p class="text text-white fw-bold">
                                                        se você tem 2h de aula, então marque dois horários, por exemplo: se você fica de 08h às 10h, então marque os horários de 08:00 às 09:00 e de 09:00 às 10:00.
                                                    </p>
                                                    <p class="text text-white fw-bold">
                                                        se você tem 1h de aula, então marque apenas um horário, por exemplo: se você fica de 08h às 9h, então marque o horário de 08:00 às 09:00.
                                                    </p>
                                                </div>
                                                <div id="checkboxes" class="d-grid text-white fs-6">
                                                    <div class="row">
                                                    <div class="col-3">
                                                        <label for="oito">
                                                            <input value="08:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="oito">
                                                            De 08:00 às 09:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="nove">
                                                            <input value="09:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="nove">
                                                            De 09:00 às 10:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="dez">
                                                            <input value="10:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="dez">
                                                            De 10:00 às 11:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="onze">
                                                            <input value="11:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="onze">
                                                            De 11:00 às 12:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="doze">
                                                            <input value="12:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="doze">
                                                            De 12:00 às 13:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="treze">
                                                            <input value="13:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="treze">
                                                            De 13:00 às 14:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="catorze">
                                                            <input value="14:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="catorze">
                                                            De 14:00 às 15:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="quinze">
                                                            <input value="15:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="quinze">
                                                            De 15:00 às 16:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="dezesseis">
                                                            <input value="16:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="dezesseis">
                                                            De 16:00 às 17:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="dezessete">
                                                            <input value="17:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="dezessete">
                                                            De 17:00 às 18:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="dezoito">
                                                            <input value="18:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="dezoito">
                                                            De 18:00 às 19:00
                                                        </label>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="dezenove">
                                                            <input value="19:00" type="checkbox" class="form-check-input" name="HoraPresenca[]" id="dezenove">
                                                            De 19:00 às 20:00
                                                        </label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="card-footer an-card-header text-center">
                                            <span class="fw-bold fs-5">Se ainda estiver com dúvidas chame seu educador(a).</span>    
                                        </div> 
                                        <div class="p-2 d-flex mt-4">
                                            <button class="btn btn-primary an-btn fw-bold text-uppercase">registrar</button>                                    
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    <section class="an-detalhe">
                        <figure class="h-100 w-100 d-flex justify-content-center align-items-center">
                            <img src="./assets/img/logo.webp" alt="" class="img">
                        </figure>
                    </section>
                </div>
            </main>
        </div>


<?php include "partials/rodape.php";?>