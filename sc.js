function gen() {
    if($('#Title').val() == "") return alert("Title is required");
    $.ajax({
        url: `gen.php?st=${$('#SmallTitle').val()}&t=${$('#Title').val()}&d=${$('#Description').val()}&i=${$('#Image').val()}`,
        context: document.body,
        success: function(data) {
            prompt("Your embed link:", data);
        }
    });
}

$('#SmallTitle').on('propertychange input', function (e) {
    var valueChanged = false;
    if (e.type=='propertychange') {
        valueChanged = e.originalEvent.propertyName=='value';
    } else {
        valueChanged = true;
    }

    if (valueChanged) {
        $('#st').html($('#SmallTitle').val());
    }
});

$('#Title').on('propertychange input', function (e) {
    var valueChanged = false;
    if (e.type=='propertychange') {
        valueChanged = e.originalEvent.propertyName=='value';
    } else {
        valueChanged = true;
    }

    if (valueChanged) {
        $('#t').html($('#Title').val());
    }
});

$('#Description').on('propertychange input', function (e) {
    var valueChanged = false;
    if (e.type=='propertychange') {
        valueChanged = e.originalEvent.propertyName=='value';
    } else {
        valueChanged = true;
    }

    if (valueChanged) {
        $('#d').html($('#Description').val());
    }
});