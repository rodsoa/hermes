$('#campaign-add-form #campaign-type').change( function ( event ) {
    var html;

    if( this.value == 'TXT' ) {
        html = "";
        html += "<div class='form-group'>"
        html += "<label for='campaign-text'>Mensagem</label>"
        html += "<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>"
        html += "</div>";
    }

    if( this.value == 'ITXT' ) {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>"
        html += "<label for='campaign-file-name'>Nome da Imagem</label>"
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>"
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>Imagem</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";

        // texto
        html += "<div class='form-group'>"
        html += "<label for='campaign-text'>Mensagem</label>"
        html += "<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>"
        html += "</div>";
    }

    if( this.value == 'VTXT' ) {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>"
        html += "<label for='campaign-file-name'>Nome do Vídeo</label>"
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>"
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>Video</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";

        // Texto
        html += "<div class='form-group'>"
        html += "<label for='campaign-text'>Mensagem</label>"
        html += "<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>"
        html += "</div>";
    }

    if( this.value == 'PDF' ) {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>"
        html += "<label for='campaign-file-name'>Nome do PDF</label>"
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>"
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>PDF</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";
    }

    if( this.value == 'AUDIO' ) {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>"
        html += "<label for='campaign-file-name'>Nome do Audio</label>"
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>"
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>AUDIO</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";
    }

    $('#campaign-add-form #type-content').html( html );
});

$('#campaign-add-form #campaign-lauching-date').change( function ( event ) {
    var self = this;
    $.getJSON('/api/blacklist', function( response ) {
        if( $.inArray(self.value, response) != -1) {
            alert('Data bloqueada pela administração');
            self.value = "";
        }
    });
});