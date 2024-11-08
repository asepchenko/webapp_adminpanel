function decimalFormat(number){
    number = number.replace(/\./g,''); //remove .
    number = number.replace(/\,/g,'.'); //replace , to . (decimal)
    return number;
}   

function decimalNormalize(number){
    number = number.replaceAll(".", "");
    return number;
}   

function decimalCalc(number){
    number = number.replaceAll(",", ".");
    return number;
}  

function replaceWithComma(number){
    number = number.toString();
    number = number.replaceAll(".", ",");
    return number;
}  

function alertError(status, exception, responseText){
    console.log(responseText);
    var obj = JSON.parse(responseText);

    if (status === 0) {
        alert('Not connect.\n Verify Network.');
    } else if (status == 404) {
        alert('Requested page not found. [404]');
    } else if (status == 500) {
        alert('Internal Server Error [500].<br>'+responseText);
    } else if (exception === 'parsererror') {
        alert('Requested JSON parse failed.');
    } else if (exception === 'timeout') {
        alert('Time out error.');
    } else if (exception === 'abort') {
        alert('Ajax request aborted.');
    } else if (status === '400') {
        alert(obj.meta.message);
    } else {
        alert(obj.meta.message);
    }
}

//get today YYYY-MM-DD
function getTodayDate() {
    var today = new Date();
    /*var year = today.getFullYear();
    var month = today.getMonth() + 1;
    var day = 1;
    var firstDateOfMonth = year + "-" + month + "-" + day;*/
    return moment(today.toISOString()).format("YYYY-MM-DD"); 
}


//get first date of month YYYY-MM-DD
function getFirstDateOfMonth() {
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth() + 1;
    var day = 1;
    var firstDateOfMonth = year + "-" + month + "-" + day;
    return moment(new Date(firstDateOfMonth).toISOString()).format("YYYY-MM-DD"); 
}

//get last date of month YYYY-MM-DD
function getLastDateOfMonth() {
    var d = new Date();
    d.setDate(1);
    d.setMonth(d.getMonth() + 1);
    d.setDate(d.getDate() - 1);
    var lastDateOfMonth = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    return moment(new Date(lastDateOfMonth).toISOString()).format("YYYY-MM-DD"); 
}