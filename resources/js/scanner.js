
import {Html5QrcodeScanner} from "html5-qrcode";



import {Html5Qrcode} from "html5-qrcode";
import Swal from 'sweetalert2';

const onScanSuccess = async (decodedText, decodedResult) => {
    // handle the scanned code as you like, for example:
    try {
      if(decodedText){
        html5QrcodeScanner.pause(true, false);
        const csrf = document.querySelector('[name=csrf-token]').content
        // console.log(csrf)
        const url = `/ingreso`
        const body = new FormData();
        const headers = new Headers() 
        headers.append('X-CSRF-TOKEN', csrf)
        body.append('token', decodedText);
        const config = {
          method : 'POST',
          headers,
          body
        }
  
        const response = await fetch(url, config);
        const data = await response.json()
        
        
        const {mensaje, codigo, usuario} = data
        
        console.log(usuario)
        if(mensaje){
          let icon = 'info'
          let html = ''
  
          if(codigo == 1){
            icon = 'success'
            html = `
              <p><span class='fw-bold'>NOMBRE: </span> ${usuario.name}</p>
              <p><span class='fw-bold'>DPI: </span> ${usuario.dpi}</p>
            `
          }else if(codigo == 2){
            icon = 'warning'
            html = `
              <p><span class='fw-bold'>NOMBRE: </span> ${usuario.name}</p>
              <p><span class='fw-bold'>DPI: </span> ${usuario.dpi}</p>
            `
          }else{
            icon = 'error'
          }
          Swal.fire({
            icon : icon,
            title : mensaje,
            html : html,
            confirmButtonColor: '#3085d6',
            confirmButtonText : "Entendido"
          }).then(() => {
            html5QrcodeScanner.resume()
  
          }
  
          )
        }
      } 
    } catch (error) {
      console.log(error) 
    }
   
      


}
  
  function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
    // console.warn(`Code scan error = ${error}`);
  }
  
  let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);