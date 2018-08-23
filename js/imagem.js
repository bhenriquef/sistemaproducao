function exibirImagem(nome) {
   imgsrc = document.getElementById(nome).src;
   document.getElementById('imageModal').src = imgsrc;
}