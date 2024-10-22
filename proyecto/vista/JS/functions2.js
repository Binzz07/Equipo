$(document).ready(function() {
    let id;
    $("#codigo").hide();
    getAll();
    
    function getAll() {
        $.ajax({
            url: '../modelo/obtenertodo2.php',
            type: 'POST',
            data: {
                res: 1
            },
            dataType: 'json',
            success: function(response) {
                let usuario = response;
                let ret = '';
                
                usuario.forEach(res => {
                    ret += `
                        <tr>
                            <td>${res.hora_inicio}</td>
                            <td>${res.hora_fin}</td>
                            <td>${res.fecha}</td>
                            <td>${res.detalles}</td>
                            <td>${res.comida}</td>
                            <td>${res.sala}</td> 
                        </tr>
                    `;
                });

                $('#data1').html(ret);
            }
        });
    }
});
