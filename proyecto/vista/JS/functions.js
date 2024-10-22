$(document).ready(function(){
	let id;
	$("#codigo").hide();
	getAll();
	function getAll(){
		$.ajax({
			url: '../modelo/obtenertdodo.php',
			type: 'POST',
			data: {
				res: 1
			},
            dataType: 'json',
			success: function(response){
				let usuario = response;
				let ret = '';
				console.log(usuario);
                usuario.forEach(res => {
                    ret += `
                        <tr>
                            <td>${res.cedula}</td>
                            <td>${res.nombre}</td>
                            <td>${res.contrasena}</td>
                        </tr>
                    `;

                    $('#data').html(ret);

                });
			}
		})
	}
});