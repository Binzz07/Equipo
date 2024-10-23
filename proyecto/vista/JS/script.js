const { jsPDF } = window.jspdf;

function generatePDF() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    const doc = new jsPDF();
    doc.text('Nombre: ' + name, 10, 10);
    doc.text('Correo Electrónico: ' + email, 10, 20);
    doc.text('Mensaje: ' + message, 10, 30);
    doc.save('formulario.pdf');
}
