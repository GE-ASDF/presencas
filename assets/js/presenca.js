const frequencyForm = document.querySelector("#frequency-form");
const mensagem = document.querySelector(".mensagem");
const CodigoContrato = document.querySelector("[name='CodigoContrato'");


window.onload = function(e){

    frequencyForm.onsubmit = function(ev){
        ev.preventDefault();

        const inputHora = Array.from(document.querySelectorAll(".form-check-input:checked"));
            let Hora = '';
            let qtdHoras = inputHora.length;
            if(inputHora.length > 1){
                inputHora.forEach(i=>{
                    Hora += i.value + " ";
                })
            }else if(inputHora.length === 1){
                Hora = inputHora[0].value
            }else{
                ev.preventDefault();
                return alert("É necessário marcar o(s) horário(s) da presença")
            }
            if(CodigoContrato.value){

                let resposta = confirm("Deseja salvar os dados abaixo?\nCódigo do contrato: " + CodigoContrato.value + "\nData da presença: " + DataPresenca.value+"\nDia da semana: " + DiaSemana.value + "\nHora da presença: " + Hora +"\nQtd. hora(s) de aula: "+qtdHoras+"h\nSe não tiver certeza peça para seu educador(a) confirmar.")
                
                if(!resposta){
                    ev.preventDefault();
                    return;
                }

            }else{
                ev.preventDefault();
                return alert("O campo de USUÁRIO é obrigatório.");
            }

        let dados = new FormData(frequencyForm);
    
        xmlHttpPost("controllers/ControllerMarcarPresenca.php", function(){
            beforeSend(function(){
                mensagem.innerHTML = `<span class="d-flex flex-column alert alert-primary"> Aguarde... </span>`
            })
            success(function(){
                const inputHora = Array.from(document.querySelectorAll(".form-check-input:checked"));
                let response = xhttp.responseText;
                if(response == 1){
      
                    mensagem.innerHTML = `<span class='alert w-100 justify-content-between d-flex alert-success'>
                    <span id='text-message'>Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.</span>
                        <span style='cursor: pointer;' class='btn-close d-block'>
                        </span>
                </span>`
                    document.getElementById("CodigoContrato").value = '';
                    document.getElementById("CodigoContrato").focus();
                    inputHora.forEach(i =>{
                        i.checked = false;
                    })
                }
                if(response == 2){
                    
                    mensagem.innerHTML = `<span class='alert w-100 justify-content-between d-flex alert-danger'>
                    <span id='text-message'>Falha! Houve erros na hora de marcar a sua presença. Verifique os seguintes parêmetros:
                            <ul class=''>
                            <li> Se você digitou o usuário corretamente; </li>
                            <li> Se você marcou os horários nas caixinhas abaixo do usuário. </li>
                            </ul></span>
                        <span style='cursor: pointer;' class='btn-close d-block'>
                        </span>
                </span>`
                    document.getElementById("CodigoContrato").focus();
                    inputHora.forEach(i =>{
                        i.checked = false;
                    })
                }
                if(response == 3){
                    
                    mensagem.innerHTML = `
                    <span class='alert w-100 justify-content-between d-flex alert-primary'>
                        <span id='text-message'>A sua presença já foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.</span>
                        <span style='cursor: pointer;' class='btn-close d-block'>
                        </span>
                    </span>`
                    document.getElementById("CodigoContrato").value = '';
                    document.getElementById("CodigoContrato").focus();
                    inputHora.forEach(i =>{
                        i.checked = false;
                    })
                }
                
            })
            const btnsClose = Array.from(document.getElementsByClassName("btn-close"));

            btnsClose.forEach(btnClose =>{
                btnClose.addEventListener("click", ev => {
                ev.target.parentNode.remove();
            })
            })
            
        }, dados)
    }
}