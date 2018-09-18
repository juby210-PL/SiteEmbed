function gen() {
    if($('#Title').val() == "") return alert("Title is required");
    $.ajax({
        url: `gen.php?st=${$('#SmallTitle').val()}&t=${$('#Title').val()}&d=${$('#Description').val()}&i=${$('#Image').val()}&c=${$('#Color').val()}`,
        context: document.body,
        success: function(data) {
            if(data.startsWith("Error")) {
                alert(data);
            } else {
                prompt("Your embed link:", data);
            }
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
        if($('#SmallTitle').val() == "") {
            $('#st').html("Small Title");
        } else {
            $('#st').html($('#SmallTitle').val());
        }
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
        if($('#Title').val() == "") {
            $('#t').html("Title");
            $('#mt').html("Title");
        } else {
            $('#t').html($('#Title').val());
            $('#mt').html($('#Title').val());
        }
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
        if($('#Description').val() == "") {
            $('#d').html("Description");
            $('#md').html("Description");
        } else {
            $('#d').html($('#Description').val());
            $('#md').html($('#Description').val());
        }
    }
});