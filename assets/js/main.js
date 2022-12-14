const $ = (selector)=>document.querySelector(selector);
const diasSemana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];
const DataPresenca = $("[name='DataPresenca']")
const DiaSemana = $("[name='DiaSemana']")

let objectDate = new Date();

function createDate(){
    let now = objectDate.toLocaleDateString('pt-BR');
    return now;
}

function getWeekDayName(){
    let dayWeekNumber = objectDate.getDay();
    return diasSemana[dayWeekNumber];
}

function toString(){
    DataPresenca.value = createDate();
    DiaSemana.value = getWeekDayName();
}

toString();
function refresh() {
    window.location.reload();
}