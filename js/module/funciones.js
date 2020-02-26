export let data=(server,datos=null)=>{
    let datas='';
    $.ajax({
        async:false,
        type:'POST',
        dataType:'json',
        url: server,
        data: datos,
        cache:false,
        processData:false,
        contentType:false,
        error:(error, status, request)=>{
            datas = error;
        },
        success:(respuesta)=>{
            datas=respuesta;
        }
    });
    return datas;
}
export let permisos=(opc)=>{
    let botones='';
    if(parseInt(opc.editar)==1){
        botones += "<button type='button' class='btn btn-sm rounded-circle btn-success m-1 editar'><i class='fa fa-pencil'></i></button>";
    }
    if(parseInt(opc.eliminar)==1){
        botones += "<button type='button' class='btn btn-sm rounded-circle btn-danger m-1 eliminar'><i class='fa fa-trash-o'></i></button>";
    }
    if(parseInt(opc.visual)==1){
        botones += "<button type='button' class='btn btn-sm rounded-circle btn-info m-1 visual'><i class='fa fa-eye'></i></button>";
    }
    return botones
}

export let fotosImg=(div)=>{
    const llenarOptionSelect=()=>{
        navigator.mediaDevices.enumerateDevices().then((option_dispositivo)=>{
            const video_dispositivo = [];
            option_dispositivo.forEach((option_dispositivo)=>{
                if(option_dispositivo.kind === "videoinput"){
                    video_dispositivo.push(option_dispositivo);
                }
            });
            if(video_dispositivo.length>0){
                video_dispositivo.forEach((option_dispositivo)=>{
                    const option = document.createElement("option");
                    option.value = option_dispositivo.deviceId;
                    option.text = option_dispositivo.label;
                    div.option_value.appendChild(option);
                });
            }
        });
    }
    const iniciar=(()=>{
        if(
            !(
                !!(
                    navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices) || navigator.webkitGetUserMedia || navigator.msGetUserMedia
                )
            )
        ){
            alert("Lo siento. Tu navegador no soporta esta característica.");
            return;
        }
        let stream;
        navigator.mediaDevices.enumerateDevices().then((dispo)=>{
            const dispositivos_video = [];
            dispo.forEach((dispo)=>{
                if(dispo.kind === "videoinput"){
                    dispositivos_video.push(div);
                }
            });
            if(dispositivos_video.length>0){
                videoStrean(dispositivos_video[0].deviceId);
            }
        });
        const videoStrean=(id_dispositivo)=>{
            getUserMedia({ video: {deviceId : id_dispositivo } },(streamObj)=>{
                llenarOptionSelect();
                div.option_value.change=()=>{
                    if(stream){
                        stream.getTracks().forEach((track)=>{
                            track.stop();
                        });
                    }
                    videoStrean(div.option_value.value);
                }
                stream=streamObj;
                div.video.srcObject=stream;
                div.video.play();
                div.button_cap_img.addEventListener("click",()=>{
                    div.video.pause();
                    let context=div.canvas_img.getContext("2d");
                    div.canvas_img.width=div.video.videoWidth;
                    div.canvas_img.height=div.video.videoHeight;
                    context.drawImage(div.video,0,0,div.canvas_img.width,div.canvas_img.height);
                    let img_lienzo = new Image();
                    img_lienzo.src=div.canvas_img.toDataURL('image/jpeg',1.0);
                    div.lienzo_img.setAttribute("src",img_lienzo.src);
                    div.lienzo_img.className="img-fluid imgUsuarios w-100 rounded";
                    div.video.play();
                    stream.getTracks().forEach((track)=>{
                        track.stop();
                    });
                    div.foto_usuario=(div.foto_usuario.className="d-none"?div.foto_usuario.className="imgUsuario mt-3":"");
                    div.foto_sistema=(div.foto_sistema.className="d-none"?div.foto_sistema.className="tomarFoto d-none mt-2":"");
                });
            },(error)=>{
                console.log("Permiso denagado o error: => ",error);
            });
        }
    });
    iniciar();
    function getUserMedia(){
        return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator,arguments);
    }
}

export let fotoImg=e=>{
    const controlador = {video:{width:e.video.width,height:e.video.height}};
    navigator.mediaDevices.getUserMedia(controlador).then(stream=>{
        window.stream = stream;
        e.video.srcObject = stream;
        e.video.play();
        let context = e.canvas.getContext('2d');
        e.capturar.addEventListener('click',()=>{
            context.drawImage(e.video,0,0,e.video.width,e.video.height);
            // stream.getTracks().forEach((track)=>{
            //     track.stop();
            // });
            let img = new Image();
            img.src = e.canvas.toDataURL("image/jpeg");
            console.log(img);
        });
    });
    console.log(e.canvas);

}

export let cedulaCoorecta=(dni)=>{
    let cdl =dni[0].value;
    if(typeof(cdl)=="string" && cdl.length==10 && /^\d+$/.test(cdl)){
        let digitos_dni = cdl.split("").map(Number),
        digito_verificador = digitos_dni.pop(),
        provincia_extranjero = digitos_dni[0] * 10 + digitos_dni[1];
        if(
            provincia_extranjero >= 1 && ( provincia_extranjero <= 24 || provincia_extranjero == 30 )
        ){
            let suma_digitos = 0;
            for(let i in digitos_dni){
                if((i%2)==0){                    
                    let aux = digitos_dni[i] * 2;
                    if(aux > 9){
                        aux -= 9;
                    }
                    suma_digitos+=parseInt(aux);
                }else{
                    suma_digitos+=parseInt(digitos_dni[i]);
                }
            }
            if(
                (suma_digitos%10?10-suma_digitos%10:0) === digito_verificador
            ){
                return true;
            }else{
                alert(`La cedula ingresada ${dni[0].value} es incorrecta`);
                return document.getElementById(dni[0].id).style.border="1px solid red";
            }
        }
    }else{
        return document.getElementById(dni[0].id).style.border="1px solid red";
    }
}

export let correoCorrecto=(email)=>{
    if(typeof(email[0].value)=="string"){
        let expre_regular=/[\w]+([.][\w]+)*@[\w]+([.][\w]+)*[.][a-zA-Z]{3}/;
        if(expre_regular.test(email[0].value)){
            document.getElementById(email[0].id).style.border="1px solid green";
            return true;
        }else{
            alert(`EL correo ingresado '${email[0].value}' es incorrecta`);
            return document.getElementById(email[0].id).style.border="1px solid red";
        }
    }
}