function search() {
    var input, filter, a;
    input = document.getElementsByClassName('resultado_personas');
    filter = document.getElementById('search');
    filter = filter.value.toUpperCase();
    filter = remove_accents(filter);
    for (var i = 0; i < input.length; i++) {
        a = input[i].innerHTML;
        a = remove_accents(a);
        if (a.toUpperCase()
            .indexOf(filter) > -1) input[i].parentElement.parentElement.parentElement.style.display = '';
        else input[i].parentElement.parentElement.parentElement.style.display = 'none';
    }
}

function remove_accents(strAccents) {
    var strAccents = strAccents.split('');
    var strAccentsOut = new Array();
    var strAccentsLen = strAccents.length;
    var accents = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
    var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
    for (var y = 0; y < strAccentsLen; y++) {
        if (accents.indexOf(strAccents[y]) != -1) {
            strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
        } else
            strAccentsOut[y] = strAccents[y];
    }
    strAccentsOut = strAccentsOut.join('');
    return strAccentsOut;
}