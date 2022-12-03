
const date = new Date();
const weekdays = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];

    function printDate(){
        let now = date.toLocaleDateString('pt-Br')
        return now;
    }
    
    function weekDayName(){
        let weekDayName = weekdays[date.getDay()];
        return weekDayName;
    }

    try{
        const DataPresenca = document.querySelector("#DataPresenca");
        const DiaSemana = document.querySelector("#DiaSemana");
        DataPresenca.value = printDate();
        DiaSemana.value = weekDayName();
    }catch(err){
        console.log(err);
    }