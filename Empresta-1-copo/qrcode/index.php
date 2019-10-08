<html>
  <head>
    <title>QRCode</title>
    
  </head>

  <body>
    <div id="qrcode"></div>
    <script src="qrcode.min.js"></script>
    <script>
      new QRCode(document.getElementById('qrcode'), {
        text: 'Funcionando!',
        width: 300,
        height: 300,
        colorDark: '#ff0000',
        colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.H
      })
    </script>
  </body>
</html>