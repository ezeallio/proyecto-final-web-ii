const nombresMeses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre",
    "Diciembre"
];

const nombresDias = ["D", "L", "M", "M", "J", "V", "S"];

const regexEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
const regexSoloLetras = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
const regexLetrasYNumeros = /^[0-9a-zA-Z]+$/;
const regexSoloNumeros = /^[0-9]+$/;
const regexLetrasYEspacio = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;